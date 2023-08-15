<?php

namespace App\Http\Controllers;
use DB;
use App\User;
use App\PatientCheckin;
use App\PatientCheckout;
use Illuminate\Http\Request;

class PatientCheckoutController extends Controller
{
    public function index($id)
    {
        $user = User::where('id', $id)->first();
        $checkouts = DB::table('patient_checkouts')
                        ->leftJoin('patients', 'patients.id', '=', 'patient_checkouts.patient_id')
                        ->where(['patient_checkouts.facility_id' => $user->facility_id])
                        ->orderBy('patient_checkouts.created_at', 'desc')
                        ->select('patients.name', 'patient_checkouts.*')
                        ->get();
        return response()->json($checkouts);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'patient' => 'required',
            'self' => 'required'
        ]);
        $user = User::where('id', $request->id)->first();
        $checkin = PatientCheckin::where(['patient_id' => $request->patient['patient_id'], 'active' => false ])->first();

        if(count(DB::table('patient_invoices')->where(['key' => $checkin->key, 'status' => false])->get()) == 0){
            PatientCheckout::create([
                'patient_id' => $request->patient['patient_id'],
                'self' => $request->self,
                'pickup_name' => $request->pickup_name,
                'pickup_phone' => $request->pickup_phone,
                'relationship' => $request->relationship,
                'staff_id' => $user->id,
                'staff_name' => $user->name,
                'key' => $request->patient['key'],
                'facility_id' => $user->facility_id
            ]);
            PatientCheckin::where('patient_id', $request->patient['patient_id'])->update([
                'active' => false
            ]);
        }else{
            return response()->json(['error' => 'Patient Invoice has to be paid before patient can checkout.'], 401);
        }

    }
}
