<?php

namespace App\Http\Controllers;
use DB;
use Str;
use App\Prenatal;
use App\User;
use App\Patient;
use App\PatientCheckin;
use Illuminate\Http\Request;

class PatientCheckinController extends Controller
{
    public function index($id)
    {
        $user = User::where('id', $id)->first();
        $checkins = DB::table('patient_checkins')
                        ->leftJoin('patients', 'patients.id', '=', 'patient_checkins.patient_id')
                        ->where(['patient_checkins.facility_id' => $user->facility_id, 'patient_checkins.active' => true])
                        ->orderBy('patient_checkins.created_at', 'desc')
                        ->select('patients.name', 'patient_checkins.*')
                        ->get();
        return response()->json($checkins);
    }
    public function patients()
    {
        return response()->json(Patient::all());
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'self' => 'required'
        ]);
        $user = User::where('id', $request->id)->first();
        $checkins = PatientCheckin::where(['patient_id' => $request->patient['id'], 'active' => true])->get();
        if (count($checkins) == 0) {
            PatientCheckin::create([
                'patient_id' => $request->patient['id'],
                'self' => $request->self,
                'key' => Str::random(50),
                'staff_id' => $user->id,
                'facility_id' => $user->facility_id,
                'brought_name' => $request->brought_name,
                'brought_phone' => $request->brought_phone,
                'relationship' =>  $request->relationship,
                'active' => true
            ]);
        } else {
            return response()->json(['error' => 'Patient is already checked-in to a facility'], 401);
        }
    }
    public function patientCheckin($key)
    {
        $checkin = DB::table('patient_checkins')
                        ->leftJoin('patients', 'patients.id', '=', 'patient_checkins.patient_id')
                        ->leftJoin('kin', 'kin.patient_id', '=', 'patient_checkins.patient_id')
                        ->where(['patient_checkins.key' => $key, 'patient_checkins.active' => true])
                        ->select('patients.name', 'patients.email', 'patient_checkins.*', 'kin.name as contact_name', 'kin.mobile_phone')
                        ->first();
        return response()->json($checkin);
    }
    public function verifyPatientCheckin($key)
    {
        $prenatal = Prenatal::where('key', $key)->first();
        $checkin = DB::table('patient_checkins')
                        ->where(['patient_id' => $prenatal->patient_id, 'active' => true])
                        ->get();
        return response()->json(count($checkin));
    }
    public function patientCheckinArchive($id)
    {
        $user = User::where('id', $id)->first();
        $patients = DB::table('patient_checkins')
                        ->leftJoin('patient_checkouts', 'patient_checkins.key', '=', 'patient_checkouts.key')
                        ->leftJoin('patients', 'patients.id', '=', 'patient_checkins.patient_id')
                        ->where(['patient_checkins.active' => false, 'patient_checkins.facility_id' => $user->facility_id])
                        ->orderBy('patient_checkins.id', 'desc')
                        ->select('patients.name', 'patient_checkins.*', 'patient_checkouts.pickup_name', 'patient_checkouts.pickup_phone', 'patient_checkouts.relationship as my_relationship', 'patient_checkouts.self as myself')
                        ->get();
        return response()->json($patients);

    }
    public function patientCheckinArchiveByDate($date, $id)
    {
        $user = User::where('id', $id)->first();
        $patients = DB::table('patient_checkins')
                        ->leftJoin('patient_checkouts', 'patient_checkins.key', '=', 'patient_checkouts.key')
                        ->leftJoin('patients', 'patients.id', '=', 'patient_checkins.patient_id')
                        ->where([
                            ['patient_checkins.active', false],
                            ['patient_checkins.facility_id', $user->facility_id],
                            ['patient_checkins.created_at', 'like', '%' . $date . '%']
                        ])
                        ->orderBy('patient_checkins.id', 'desc')
                        ->select('patients.name', 'patient_checkins.*', 'patient_checkouts.pickup_name', 'patient_checkouts.pickup_phone', 'patient_checkouts.relationship as my_relationship', 'patient_checkouts.self as myself')
                        ->get();
        return response()->json($patients);
    }


}
