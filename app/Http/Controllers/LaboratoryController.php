<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LaboratoryMedicalTest;
use DB;
use Mail;
use Image;
use App\POS;
use App\User;
use App\Customer;
use App\LaboratorySale;
use App\PatientMedicalLaboratoryTest;
use App\PrenatalMedicalLaboratoryTest;
use App\Mail\MedicalDiagnosticAndLaboratoryTestInvoiceMail;
use App\Mail\MedicalDiagnosticAndLaboratoryTestMail;
class LaboratoryController extends Controller
{
    public function laboratoryMedicalTest($id)
   {
       $user = DB::table('users')->where('id', $id)->first();
       if ($user->role == "Facility Manager") {
           $facility_id = $id;
       }else{
           $facility_id = $user->facility_id;
       }
       $tests = DB::table('laboratory_medical_tests')
                    ->leftJoin('medical_laboratory_tests', 'medical_laboratory_tests.id', '=', 'laboratory_medical_tests.test_id' )
                    ->where('laboratory_medical_tests.facility_id', $facility_id)
                    ->select('medical_laboratory_tests.*', 'laboratory_medical_tests.price')
                    ->get();
        return response()->json($tests);
   }
   public function medicalLaboratoryTests()
   {
       return response()->json(DB::table('medical_laboratory_tests')->get());
   }
   public function storeLaboratoryTest($id, $test_id, $price)
   {
       $user = DB::table('users')->where('id', $id)->first();
       $tests = DB::table('laboratory_medical_tests')->where(['facility_id' => $user->facility_id, 'test_id' => $test_id])->get();
       if ($price === 'NaN') {
        return response()->json(['error' => 'Price of Medical Diagnostic & Laboratory Tests was not added. Price must be a number. Do not use a letter or symbol'], 401);
       }
       if(count($tests) == 0){
        LaboratoryMedicalTest::create([
            'facility_id' => $user->facility_id,
            'test_id' => $test_id,
            'price' => $price
        ]);
       }else{
        return response()->json(['error' => 'That Medical Diagnostic & Laboratory Tests has already been added.'], 401);
       }
   }
   public function processLabOrder(Request $request, $id)
    {
        $this->validate($request, [
            'pay_by' => 'required|string'
        ]);

        $user = DB::table('users')->where('id', $id)->first();
        $facility_id = $user->facility_id;
        if ($request->customer) {
            $customer = Customer::where(['facility_id' => $facility_id, 'id' => $request->customer['id']])->first();
        } else {
            $customer = Customer::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'facility_id' => $facility_id
            ]);
        }
        // pick all from cart

        $carts = POS::where(['facility_id'=> $facility_id, 'user_id' => $user->id])->get();
        if (($request->medical_investigation && $request->medical_investigation == 'Yes') && $request->patient)  {
            $key = $request->patient['key'];
        }elseif($request->prenatal && $request->prenatal == 'Yes'){
            $key = $request->key;
        } else {
            $key = null;
        }


        // get last sale
        $last_sale = LaboratorySale::where('facility_id', $facility_id)->orderBy('id', 'desc')->first();
        if (empty($last_sale)) {
            $last_invoice = '00000';
        } else {
            $last_invoice = $last_sale->invoice_number;
        }
        $number = substr($last_invoice, 2, 8);
        $invoice_no = sprintf("%010d", (1 + $number));
        $description = array();
        foreach($carts as $cart){
            // add to patient medical laboratory test
            PatientMedicalLaboratoryTest::create([
                'customer_id' => $customer->id,
                'test_name' => $cart->product_name,
                'phone' => $request->phone,
                'facility_id' => $facility_id,
                'key' => $key,
                'staff_id' => $user->id,
                'staff_name' => $user->name
            ]);
            $description[] = $cart->product_name;
        }
         // add to laboratory sales
        LaboratorySale::create([
            'invoice_number' => $invoice_no,
            'description' => implode(', ', $description),
            'price' => $request->amount,
            'pay_by' => $request->pay_by,
            'customer_id' => $customer->id,
            'facility_id' => $facility_id,
            'staff_id' => $user->id,
            'staff_name' => $user->name
        ]);
    }
    public function getCustomerSale($id)
    {
        $user = User::where('id', $id)->first();
        $sale = DB::table('laboratory_sales')
                    ->leftJoin('customers', 'customers.id', '=', 'laboratory_sales.customer_id')
                    ->where(['laboratory_sales.facility_id' => $user->facility_id, 'laboratory_sales.status' => false])
                    ->select('laboratory_sales.*', 'customers.name', 'customers.email', 'customers.phone')
                    ->first();
        return response()->json($sale);
    }
    public function confirmPayment($id)
    {
        $user = User::where('id', $id)->first();

        LaboratorySale::where(['facility_id' => $user->facility_id, 'staff_id' => $user->id])->update([
            'status' => true
        ]);

        $sale = LaboratorySale::where(['facility_id' => $user->facility_id, 'staff_id' => $user->id])->first();
        $carts = POS::where(['facility_id'=> $user->facility_id, 'user_id' => $user->id])->get();
        $customer = Customer::where('id', $sale->customer_id)->first();
        $facility = DB::table('facility_signatures')->where('facility_id', $user->facility_id)->first();
        $data = [
            'name' => $customer->name,
            'email' => $customer->email,
            'phone' => $customer->phone,
            'carts' => $carts,
            'registered_facility_name' => $facility->registered_facility_name,
            'physical_location' => $facility->physical_location,
            'postal_code' => $facility->postal_code,
            'total' => $sale->price,
            'invoice_number' => $sale->invoice_number,
            'date' => $sale->created_at
        ];
        Mail::to($customer->email)->send(new MedicalDiagnosticAndLaboratoryTestInvoiceMail($data));
        POS::where(['facility_id'=> $user->facility_id, 'user_id' => $user->id])->delete();
    }
    public function patientMedicalLaboratoryTests($id)
    {
        $user = User::where('id', $id)->first();
        $patients = DB::table('patient_medical_laboratory_tests')
                        ->leftJoin('customers', 'customers.id', '=', 'patient_medical_laboratory_tests.customer_id')
                        ->select('customers.name', 'customers.email', 'customers.phone', 'patient_medical_laboratory_tests.*')
                        ->where([
                                ['patient_medical_laboratory_tests.facility_id', '=', $user->facility_id],
                                ['patient_medical_laboratory_tests.test_result', '!=', null]
                            ])
                        ->orderBy('patient_medical_laboratory_tests.id', 'desc')
                        ->get();
        return response()->json($patients);
    }
    public function patientMedicalLaboratoryTestsDate($date, $id)
    {
        $user = User::where('id', $id)->first();
        $patients = DB::table('patient_medical_laboratory_tests')
                        ->leftJoin('customers', 'customers.id', '=', 'patient_medical_laboratory_tests.customer_id')
                        ->select('customers.name', 'customers.email', 'customers.phone', 'patient_medical_laboratory_tests.*')
                        ->where([
                                ['patient_medical_laboratory_tests.facility_id', '=', $user->facility_id],
                                ['patient_medical_laboratory_tests.test_result', '!=', null],
                                ['patient_medical_laboratory_tests.updated_at', 'like', '%' . $date . '%']
                            ])
                        ->orderBy('patient_medical_laboratory_tests.id', 'desc')
                        ->get();
        return response()->json($patients);
    }
    public function patientOrderMedicalLaboratoryTests($id)
    {
        $user = User::where('id', $id)->first();
        $patients = DB::table('patient_medical_laboratory_tests')
                        ->leftJoin('customers', 'customers.id', '=', 'patient_medical_laboratory_tests.customer_id')
                        ->select('customers.name', 'customers.email', 'customers.phone', 'patient_medical_laboratory_tests.*')
                        ->where(['patient_medical_laboratory_tests.facility_id' => $user->facility_id, 'patient_medical_laboratory_tests.test_result' => null])
                        ->get();
        return response()->json($patients);
    }
    public function patientOrderMedicalLaboratoryTest($id)
    {
        $patient = DB::table('patient_medical_laboratory_tests')
                        ->leftJoin('customers', 'customers.id', '=', 'patient_medical_laboratory_tests.customer_id')
                        ->select('customers.name', 'customers.email', 'customers.phone', 'patient_medical_laboratory_tests.*')
                        ->where(['patient_medical_laboratory_tests.id' => $id])
                        ->first();
        $images = explode(',', $patient->images);
        return response()->json(['patient' => $patient, 'images' => $images]);
    }
    public function updateMedicalLaboratoryTest(Request $request, $id)
    {
        $this->validate($request, [
            'test_result' => 'required|string'
        ]);
        $images = [];
        if (isset($request->images)) {
            foreach ($request->images as $image) {
                $position = strpos($image, ';');
                $sub = substr($image, 0, $position);
                $ext = explode('/', $sub)[1];

                $image_name = time() . "." . $ext;
                $img = Image::make($image)->resize(1920,1280);
                $upload_path = 'dist/images/lab_tests/';
                $image_url = $upload_path . $image_name;
                $img->save($image_url);
                $images[] = $image_url;
            }
           PatientMedicalLaboratoryTest::where('id', $id)->update([
               'test_result' => $request->test_result,
               'images' => implode(',', $images)
           ]);
        }else{
            PatientMedicalLaboratoryTest::where('id', $id)->update([
                'test_result' => $request->test_result
            ]);
        }
        $test = PatientMedicalLaboratoryTest::where('id', $id)->first();
        $prenatal_tests = PrenatalMedicalLaboratoryTest::where(['key' => $test->key, 'test_name' => $test->test_name, 'status' => false])->get();
        if(count($prenatal_tests) != 0){
            PrenatalMedicalLaboratoryTest::where(['key' => $test->key, 'test_name' => $test->test_name, 'status' => false])->update([
                'status' => true,
                'test_id' => $id,
                'facility_id' => $test->facility_id,
                'staff_name' => $test->staff_name,
                'staff_id' => $test->staff_id
            ]);
        }

        // send test mail
        // $user = DB::table('users')->where('id', $test->user_id)->first();
        $facility = DB::table('facility_signatures')
                        ->leftJoin('users', 'users.facility_id', '=', 'facility_signatures.facility_id')
                        ->where('facility_signatures.facility_id', $test->facility_id)
                        ->select('users.email', 'facility_signatures.physical_location', 'facility_signatures.phone_number', 'facility_signatures.postal_code', 'facility_signatures.registered_facility_name')
                        ->first();
        $customer = DB::table('customers')->where('id', $test->customer_id)->first();
        $images = explode(',', $test->images);
        $data = [
            'registered_facility_name' => $facility->registered_facility_name,
            'customer_name' => $customer->name,
            'customer_email' => $customer->email,
            'customer_phone' => $customer->phone,
            'delivered_by' => $test->staff_name,
            'delivered_date' => $test->updated_at,
            'test_name' => $test->test_name,
            'test_result' => $test->test_result,
            'images' => $images,
            'facility_email' => $facility->email,
            'facility_phone' => $facility->phone_number,
            'facility_location' => $facility->physical_location,
            'postal_code' => $facility->postal_code
        ];
        Mail::to($customer->email)->send(new MedicalDiagnosticAndLaboratoryTestMail($data));
    }
    public function getCustomers($id)
    {
        $user = User::where('id', $id)->first();
        $customers = DB::table('customers')->where('facility_id', $user->facility_id)->get();
        return response()->json($customers);
    }
    public function getHospitalMedicalInvestigation()
    {
        $investigations = DB::table('medical_investigations')
                    ->leftJoin('patients', 'medical_investigations.patient_id', '=', 'patients.id')
                    ->leftJoin('facility_signatures', 'facility_signatures.facility_id', '=', 'medical_investigations.facility_id')
                    ->where('medical_investigations.completed', false)
                    ->select('patients.name', 'patients.email', 'facility_signatures.registered_facility_name', 'medical_investigations.*')
                    ->get();
        return response()->json($investigations);

    }

}
