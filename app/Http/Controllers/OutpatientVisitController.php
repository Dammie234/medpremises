<?php

namespace App\Http\Controllers;
use DB;
use App\User;
use App\VitalSign;
use App\OutpatientVisit;
use Illuminate\Http\Request;

class OutpatientVisitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($key)
    {
        return response()->json(OutpatientVisit::where('key', $key)->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        $consultation = DB::table('medical_consultations')->where('key', $request->key)->first();
        $facility = DB::table('facility_signatures')->where('facility_id', $user->facility_id)->first();
        for ($i = 0; $i < count($request->date_for_visit); $i++) {
            OutpatientVisit::create([
                'patient_id' => $consultation->patient_id,
                'key' => $request->key,
                'date_for_visit' => $request->date_for_visit[$i],
                'purpose_of_visit' => $request->purpose_of_visit[$i],
                'staff_id' => $user->id,
                'staff_name' => $user->name,
                'facility_id' => $user->facility_id,
                'registered_facility_name' => $facility->registered_facility_name
            ]);
        }
        VitalSign::where('key', $request->key)->update([
            'outpatient_visit' => true
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(OutpatientVisit::where('id', $id)->first());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        OutpatientVisit::where('id', $id)->update([
            'patient_visit' => true,
            'improvement_of_patient' => $request->improvement_of_patient
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        OutpatientVisit::where('id', $id)->delete();
    }
}
