<?php

namespace App\Http\Controllers;
use DB;
use App\User;
use App\VitalSign;
use Illuminate\Http\Request;

class VitalSignController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'patient' => 'required',
            'temperature' => 'required|string',
            'temperature_measurement' => 'required',
            'heart_rate' => 'required|string',
            'breathe_rate' => 'required|string',
            'blood_pressure' => 'required'
        ]);
        $user = User::where('id', $request->id)->first();
        $vitals = VitalSign::where('key', $request->patient['key'])->get();
        if (count($vitals) == 0) {
            VitalSign::create([
                'patient_id' => $request->patient['patient_id'],
                'key' => $request->patient['key'],
                'temperature' => $request->temperature,
                'temperature_measurement' => $request->temperature_measurement,
                'heart_rate' => $request->heart_rate,
                'breathe_rate' => $request->breathe_rate,
                'blood_pressure' => $request->blood_pressure,
                'weight' => $request->weight,
                'staff_id' => $user->id,
                'staff_name' => $user->name,
                'facility_id' => $user->facility_id
            ]);
        }

    }
    public function index($id)
    {
        $user = User::where('id', $id)->first();
        $vital_signs = DB::table('vital_signs')
                            ->leftJoin('patients', 'patients.id', '=', 'vital_signs.patient_id')
                            ->leftJoin('patient_checkins', 'patient_checkins.key', '=', 'vital_signs.key')
                            ->where(['vital_signs.facility_id' => $user->facility_id, 'patient_checkins.active' => true])
                            ->orderBy('vital_signs.created_at', 'desc')
                            ->select('patients.name', 'vital_signs.*')
                            ->get();
        return response()->json($vital_signs);
    }
}
