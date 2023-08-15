<?php

namespace App\Http\Controllers;
use DB;
use Mail;
use App\User;
use App\VitalSign;
use App\Customer;
use App\AdmissionFacility;
use App\PatientDeposit;
use App\PatientCheckin;
use App\HospitalSale;
use App\PatientInvoice;
use App\PaidPatientDeposit;
use App\PatientMedicalService;
use App\Mail\HospitalInvoiceMail;
use App\MedicalConsultation;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function patientUnpaidInvoices($id)
    {
        $user = User::where('id', $id)->first();
        $patients = DB::table('patient_checkins')
                        ->leftJoin('patients', 'patients.id', '=', 'patient_checkins.patient_id')
                        ->leftJoin('patient_invoices', 'patient_invoices.patient_id', '=', 'patient_checkins.patient_id')
                        ->where(['patient_invoices.status' => false, 'patient_checkins.facility_id' => $user->facility_id])
                        ->select('patients.name', 'patient_invoices.*')
                        ->get();
        return response()->json($patients);
    }
    public function patientInvoices($key)
    {
        $vital_sign = VitalSign::where('key', $key)->first();
        if(isset($vital_sign) && $vital_sign->admission){
            $admission = AdmissionFacility::where(['key' => $key, 'active' => true])->first();
            $facility_id = $admission->facility_id;
            $admitted_date = $admission->admitted_date;
            $today = date('Y-m-d');
            $diff = abs(strtotime($today) - strtotime($admitted_date));
            $days = $diff / 3600 / 24;
            $shared_room = PatientInvoice::where(['key' => $key, 'description' => 'Shared Bed Charge'])->first();
            if (isset($shared_room)){
                $medical_service = DB::table('medical_services')->where(['name' => 'Shared Bed Charge', 'facility_id' => $facility_id])->first();
                PatientMedicalService::where(['key' => $key, 'medical_service_id' => $medical_service->id])->update([
                    'fee' => ($medical_service->price * $days)
                ]);
                PatientInvoice::where(['key' => $key, 'description' => 'Shared Bed Charge'])->update([
                    'quantity' => $days,
                    'amount' => $medical_service->price
                ]);
            }
            $private_room = PatientInvoice::where(['key' => $key, 'description' => 'Private Bed Charge'])->first();
                if (isset($private_room)) {
                    $medical_service = DB::table('medical_services')->where(['name' => 'Private Bed Charge', 'facility_id' => $facility_id])->first();
                    PatientMedicalService::where(['key' => $key, 'medical_service_id' => $medical_service->id])->update([
                        'fee' => ($medical_service->price * $days)
                    ]);
                    PatientInvoice::where(['key' => $key, 'description' => 'Private Bed Charge'])->update([
                        'quantity' => $days,
                        'amount' => $medical_service->price
                    ]);
                }
            $invoices = PatientInvoice::where('key', $key)->get();
            $deposit = PatientDeposit::where('key', $key)->first();
            $admission = true;
        }else{
            $invoices = PatientInvoice::where('key', $key)->get();
            $deposit = null;
            $admission = false;
        }
        return response()->json(['invoices' => $invoices, 'deposit' => $deposit, 'admission' => $admission]);
    }
    public function updatePatientDeposit(Request $request, $id)
    {
        $this->validate($request, [
            'amount' => 'required|numeric'
        ]);
        $deposit = PatientDeposit::where('key', $request->key)->first();
        PatientDeposit::where('key', $request->key)->update([
            'amount' => ($deposit->amount + $request->amount)
        ]);
    }
    public function processOrder(Request $request, $id)
    {
        $this->validate($request, [
            'amount' => 'required|integer',
        ]);

        $user = User::where('id', $id)->first();

        if (isset($request->name) && isset($request->email) && isset($request->phone)) {
            if (count(Customer::where(['facility_id' => $user->facility_id, 'email' => $request->email, 'name' => $request->name])->get()) == 0) {
                $customer = Customer::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'facility_id' => $user->facility_id
                ]);
            }else{
                $customer = Customer::where(['facility_id' => $user->facility_id, 'email' => $request->email, 'name' => $request->name])->first();
            }
        }else{
            $customer = Customer::where(['facility_id' => $user->facility_id, 'email' => $request->customer['email'], 'name' => $request->customer['name']])->first();
        }

        $patient_invoices = PatientInvoice::where(['key' => $request->key, 'facility_id' => $user->facility_id])->get();
        $description = [];
        $amount = 0;
        $cost = [];
        foreach ($patient_invoices as $invoice) {
            $description[] = $invoice->description;
        }


        $checkin =  DB::table('patient_checkins')->where('key', $request->key)->first();
        // get last sale
        $last_sale = HospitalSale::where('facility_id', $user->facility_id)->orderBy('id', 'desc')->first();
        if (empty($last_sale)) {
            $last_invoice = '00000';
        } else {
            $last_invoice = $last_sale->invoice_number;
        }
        $number = substr($last_invoice, 2, 8);
        $invoice_no = sprintf("%010d", (1 + $number));

        HospitalSale::create([
            'patient_id' => $checkin->patient_id,
            'name' => $customer->name,
            'email' => $customer->email,
            'phone' => $customer->phone,
            'key' => $request->key,
            'invoice_number' => $invoice_no,
            'description' => implode(', ', $description),
            'amount' => $request->amount,
            'pay_by' => $request->pay_by,
            'deposit' => $request->deposit,
            'staff_name' => $user->name,
            'staff_id' => $user->id,
            'facility_id' => $user->facility_id,
            'customer_id' => $customer->id
        ]);
    }
    public function getHospitalSale($key)
    {
        return response()->json(HospitalSale::where('key', $key)->first());
    }
    public function confirmPayment($key)
    {
        $sale = HospitalSale::where('key', $key)->orderBy('id', 'desc')->first();
        $facility = DB::table('facility_signatures')->where('facility_id', $sale->facility_id)->first();
        $invoices = PatientInvoice::where(['key' => $key, 'facility_id' => $sale->facility_id])->get();
        if($sale->deposit == true){
            $data = [
                'name' => $sale->name,
                'email' => $sale->email,
                'phone' => $sale->phone,
                'invoices' => $invoices,
                'registered_facility_name' => $facility->registered_facility_name,
                'physical_location' => $facility->physical_location,
                'postal_code' => $facility->postal_code,
                'total' => $sale->amount,
                'invoice_number' => $sale->invoice_number,
                'deposit' => true,
                'date' => $sale->created_at
            ];
            $deposit = PatientDeposit::where('key', $key)->first();
            PatientDeposit::where('key', $key)->update([
                'paid_amount' => ($deposit->paid_amount + $sale->amount)
            ]);
            PaidPatientDeposit::create([
                'patient_id' => $deposit->patient_id,
                'key' => $key,
                'diagnosis' => $deposit->diagnosis,
                'amount' => $sale->amount,
                'staff_id' => $deposit->staff_id,
                'staff_name' => $deposit->staff_name,
                'facility_id' => $deposit->facility_id
            ]);
        }else{
            // expected fee
            $costs = [];
            $expected_fee = 0;
            $amount_paid = 0;
            foreach ($invoices as $invoice) {
                $costs[] = $invoice->amount * $invoice->quantity;
            }
            foreach($costs as $value){
                $expected_fee += $value;
            }
            // amount paid
            $sales = HospitalSale::where('key', $key)->get();
            foreach ($sales as $sale) {
                $amount_paid += $sale->amount;
            }
            if ($expected_fee == $amount_paid) {
                // completed fee
                HospitalSale::where('key', $key)->update([
                    'status' => true
                ]);

                //delete all patient invoice
                PatientInvoice::where('key', $key)->delete();
                if(count(VitalSign::where('key', $key)->get()) == 1){
                    //update vital sign
                    VitalSign::where('key', $key)->update([
                        'payment' => true
                    ]);
                    PatientMedicalService::where('key', $key)->delete();
                }else{
                    PatientMedicalService::where('key', $key)->delete();
                }
                PatientCheckin::where('key', $key)->update([
                    'paid' => true
                ]);
                $deposit = PatientDeposit::where('key', $key)->first();
                if (isset($deposit)) {
                    if ($deposit->amount < $expected_fee) {
                        PatientDeposit::where('key', $key)->update([
                            'patient_balance' => ($expected_fee - $deposit->amount)
                        ]);
                    } else {
                        PatientDeposit::where('key', $key)->update([
                            'facility_balance' => ($deposit->amount - $expected_fee)
                        ]);
                    }
                }

            }

            $data = [
                'name' => $sale->name,
                'email' => $sale->email,
                'phone' => $sale->phone,
                'invoices' => $invoices,
                'registered_facility_name' => $facility->registered_facility_name,
                'physical_location' => $facility->physical_location,
                'postal_code' => $facility->postal_code,
                'total' => $sale->amount,
                'invoice_number' => $sale->invoice_number,
                'date' => $sale->created_at,
                'deposit' => false
            ];


        }
        Mail::to($sale->email)->send(new HospitalInvoiceMail($data));

    }
}
