<?php

namespace App\Http\Controllers;
use DB;
use App\User;
use App\PatientCheckin;
use App\Visitor;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'phone' => 'required|string',
            'patient' => 'required',
            'relationship' => 'required'
        ]);
        $user = User::where('id', $request->id)->first();
        $checkin = PatientCheckin::where(['patient_id' => $request->patient['patient_id'], 'active' => true])->first();

        Visitor::create([
            'patient_id' => $request->patient['patient_id'],
            'key' => $checkin->key,
            'name' => $request->name,
            'phone' => $request->phone,
            'relationship' => $request->relationship,
            'time_in' => date('H:i:s'),
            'staff_id' => $user->id,
            'staff_name' => $user->name,
            'facility_id' => $user->facility_id
        ]);
    }
    public function index($id)
    {
        $user = User::where('id', $id)->first();
        return response()->json(DB::table('visitors')
                        ->leftJoin('patients', 'patients.id', '=', 'visitors.patient_id')
                        ->where(['visitors.facility_id' => $user->facility_id, 'visitors.time_out' => null])
                        ->select('visitors.*', 'patients.name as patient_name')
                        ->get());
    }
    public function checkoutVisitor($id)
    {
        Visitor::where('id', $id)->update([
            'time_out' => date('H:i:s')
        ]);
    }
    public function patientVisits($key)
    {
        return response()->json(DB::table('visitors')
                        ->where('key', $key)
                        ->get());
    }
    public function visitorArchive($id)
    {
        $user = User::where('id', $id)->first();
        return response()->json(DB::table('visitors')
                        ->leftJoin('patients', 'patients.id', '=', 'visitors.patient_id')
                        ->where([
                                ['visitors.facility_id', '=', $user->facility_id],
                                ['visitors.time_out', '!=', null]
                            ])
                        ->select('visitors.*', 'patients.name as patient_name')
                        ->get());
    }
    public function visitorArchiveByDate($date, $id)
    {
        $user = User::where('id', $id)->first();
        return response()->json(DB::table('visitors')
                        ->leftJoin('patients', 'patients.id', '=', 'visitors.patient_id')
                        ->where([
                            ['visitors.facility_id', $user->facility_id],
                            ['visitors.created_at', 'like', '%' . $date . '%'],
                            ['visitors.time_out', '!=', null]
                        ])
                        ->select('visitors.*', 'patients.name as patient_name')
                        ->get());
    }
}
