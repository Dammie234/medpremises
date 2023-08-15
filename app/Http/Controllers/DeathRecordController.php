<?php

namespace App\Http\Controllers;
use DB;
use Str;
use App\User;
use App\Patient;
use App\DeathRecord;
use Illuminate\Http\Request;

class DeathRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $user = User::where('id', $id)->first();
        return response()->json(DeathRecord::where('facility_id', $user->facility_id)->orderBy('id', 'desc')->get());
    }

    public function getPatients()
    {
        return response()->json(User::where('role', 'Patient')->get());
    }

    public function getPatientDetails($patient_id)
    {

        $patient = DB::table('patients')
                    ->leftJoin('biodatas', 'biodatas.patient_id', '=', 'patients.id')
                    ->where('patients.id', $patient_id)
                    ->select('biodatas.*', 'patients.name', 'patients.nin_number')
                    ->first();
        $data = [
            'decedent_legal_name' => $patient->name,
            'gender' => $patient->gender,
            'nin_number' => $patient->nin_number,
            'date_of_birth' => $patient->date_of_birth,
            'birth_place' => $patient->birth_place,
            'address' =>  $patient->address,
            'state' =>  $patient->state,
            'city' =>  $patient->city,
            'postal_code' => $patient->postal_code,
            'father_name' => $patient->father_name,
            'mother_name' => $patient->mother_name,
            'marital_status' =>  $patient->marital_status,
            'patient_id' => $patient_id
        ];
        return response()->json($data);

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
        $this->validate($request, [
            'decedent_legal_name' => 'required|string',
            'gender' => 'required|string',
            'nin_number' => 'required|string',
            'date_of_birth' => 'required|date',
            'birth_place' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'postal_code' => 'required|string',
            'father_name' => 'required|string',
            'mother_name' => 'required|string',
            'marital_status' => 'required',
            'informant_name' => 'required|string',
            'relationship_with_decedent' => 'required|string',
            'facility_name' => 'required|string',
            'facility_address' => 'required|string',
            'method_of_disposition' => 'required|string',
            'place_of_disposition' => 'required|string',
            'address_of_disposition' => 'required|string',
            'actual_date_of_death' => 'required|date',
            'actual_time_of_death' => 'required',
            'immediate_cause_of_death' => 'required|string',
            'immediate_cause_of_death_interval' => 'required|string',
            'sequential_cause_of_death' => 'required|string',
            'sequential_cause_of_death_interval' => 'required|string',
            'underlying_cause_of_death' => 'required|string',
            'underlying_cause_of_death_interval' => 'required|string',
            'last_event_resulting_in_death' => 'required|string',
            'last_event_resulting_in_death_interval' => 'required|string',
            'autopsy_performed' => 'required',
            'autopsy_findings' => 'required',
            'tobacco_to_death' => 'required|string',
            'manner_of_death' => 'required',
            'name_of_person_completing_cause_death' => 'required|string',
            'address_of_person_completing_cause_of_death' => 'required|string',
            'decedent_education' => 'required',
            'decedent_origin' => 'required',
            'decedent_race' => 'required',
            'decedent_occupation' => 'required|string',
            'kind_of_business_or_industry' => 'required|string'
        ]);
        if (isset($request->patient_id)) {
            $patient_id = $request->patient_id;
        }else{
            $patient_id = null;
        }
        $today = date('Y-m-d');
        $to = \Carbon\Carbon::parse($today);
        $from = \Carbon\Carbon::parse($request->date_of_birth);
        $years = $to->diffInYears($from);
        $months = $to->diffInMonths($from);
        if ($years < 1) {
            if ($months < 1 ) {
                $age_class = 'Newborn';
                $weeks = $to->diffInWeeks($from);
                $age = $weeks . ' weeks old';
            } elseif($months >= 1 && $months <= 3) {
                $age_class = 'Newborn';
                $age = $months . ' months old';
            }else {
                $age_class = 'Infant';
                $age = $months . ' months old';
            }
        }elseif($years >= 1 && $years <= 5){
            $age_class = 'Toddler';
            $age = $years . ' years old';
        }elseif ($years >= 6 && $years <= 13) {
            $age_class = 'Kids';
            $age = $years . ' years old';
        }elseif($years >= 14 && $years <= 24){
            $age_class = 'Youth';
            $age = $years . ' years old';
        }else{
            $age_class = 'Adult';
            $age = $years . ' years old';
        }

        if (isset($request->method_of_disposition_specify)) {
            $method_of_disposition = $request->method_of_disposition_specify;
        }else{
            $method_of_disposition = $request->method_of_disposition;
        }
        $slug = Str::slug($request->decedent_legal_name);
        $deaths = DeathRecord::where('slug', $slug)->get();
        if(count($deaths) == 0){
            $slug = Str::slug($request->decedent_legal_name);
        }else{
            $slug = Str::slug($request->decedent_legal_name) . '-' . Str::lower(Str::random(5));
        }
        $user = User::where('id', $request->id)->first();
        $data = [
            'patient_id' => $request->patient_id,
            'decedent_legal_name' => $request->decedent_legal_name,
            'slug' => $slug,
            'gender' => $request->gender,
            'nin_number' => $request->nin_number,
            'date_of_birth' => $request->date_of_birth,
            'age' => $age,
            'age_class' => $age_class,
            'birth_place' => $request->birth_place,
            'address' => $request->address,
            'state' => $request->state,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
            'father_name' => $request->father_name,
            'mother_name' => $request->mother_name,
            'marital_status' => $request->marital_status,
            'surviving_spouse_name' => $request->surviving_spouse_name,
            'informant_name' => $request->informant_name,
            'relationship_with_decedent' => $request->relationship_with_decedent,
            'if_death_occured_in_a_hospital' => $request->if_death_occured_in_a_hospital,
            'if_death_occurred_somewhere_other_than_hospital' => $request->if_death_occurred_somewhere_other_than_hospital,
            'facility_name' => $request->facility_name,
            'facility_id' => $user->facility_id,
            'facility_address' => $request->facility_address,
            'method_of_disposition' => $method_of_disposition,
            'place_of_disposition' => $request->place_of_disposition,
            'address_of_disposition' => $request->address_of_disposition,
            'name_and_address_of_funeral_facility' => $request->name_and_address_of_funeral_facility,
            'date_pronounced_dead' => $request->date_pronounced_dead,
            'time_pronounced_dead' => $request->time_pronounced_dead,
            'actual_date_of_death' => $request->actual_date_of_death,
            'actual_time_of_death' => $request->actual_time_of_death,
            'medical_examminer_contacted' => $request->medical_examminer_contacted,
            'immediate_cause_of_death' => $request->immediate_cause_of_death,
            'immediate_cause_of_death_interval' => $request->immediate_cause_of_death_interval,
            'sequential_cause_of_death' => $request->sequential_cause_of_death,
            'sequential_cause_of_death_interval' => $request->sequential_cause_of_death_interval,
            'underlying_cause_of_death' => $request->underlying_cause_of_death,
            'underlying_cause_of_death_interval' => $request->underlying_cause_of_death_interval,
            'last_event_resulting_in_death' => $request->last_event_resulting_in_death,
            'last_event_resulting_in_death_interval' => $request->last_event_resulting_in_death_interval,
            'significant_conditions_contibuting_to_death' => $request->significant_conditions_contibuting_to_death,
            'autopsy_performed' => $request->autopsy_performed,
            'autopsy_findings' => $request->autopsy_findings,
            'tobacco_to_death' => $request->tobacco_to_death,
            'pregnancy' => $request->pregnancy,
            'manner_of_death' => $request->manner_death,
            'date_of_injury' => $request->date_of_injury,
            'time_of_injury' => $request->time_of_injury,
            'place_of_injury' => $request->place_of_injury,
            'injury_at_work' => $request->injury_at_work,
            'address_of_injury' => $request->address_of_injury,
            'how_injury_occurred' => $request->how_injury_occured,
            'transportation_injury' => $request->transportation_injury,
            'name_of_person_completing_cause_death' => $request->name_of_person_completing_cause_death,
            'address_of_person_completing_cause_of_death' => $request->address_of_person_completing_cause_of_death,
            'decedent_education' => $request->decedent_education,
            'decedent_origin' => $request->decedent_origin,
            'decedent_race' => $request->decedent_race,
            'decedent_occupation' => $request->decedent_occupation,
            'kind_of_business_or_industry' => $request->kind_of_business_or_industry,
            'staff_name' => $user->name,
            'staff_id' => $user->id
        ];
        DeathRecord::create($data);
        if (isset($request->patient_id)) {
            Patient::where('id', $request->patient_id)->update([
                'dead' => true
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        return response()->json(DeathRecord::where('slug', $slug)->first());
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
    public function update(Request $request, $slug)
    {

        $this->validate($request, [
            'decedent_legal_name' => 'required|string',
            'gender' => 'required|string',
            'nin_number' => 'required|string',
            'date_of_birth' => 'required|date',
            'birth_place' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'postal_code' => 'required|string',
            'father_name' => 'required|string',
            'mother_name' => 'required|string',
            'marital_status' => 'required',
            'informant_name' => 'required|string',
            'relationship_with_decedent' => 'required|string',
            'facility_name' => 'required|string',
            'facility_address' => 'required|string',
            'method_of_disposition' => 'required|string',
            'place_of_disposition' => 'required|string',
            'address_of_disposition' => 'required|string',
            'actual_date_of_death' => 'required|date',
            'actual_time_of_death' => 'required',
            'immediate_cause_of_death' => 'required|string',
            'immediate_cause_of_death_interval' => 'required|string',
            'sequential_cause_of_death' => 'required|string',
            'sequential_cause_of_death_interval' => 'required|string',
            'underlying_cause_of_death' => 'required|string',
            'underlying_cause_of_death_interval' => 'required|string',
            'last_event_resulting_in_death' => 'required|string',
            'last_event_resulting_in_death_interval' => 'required|string',
            'autopsy_performed' => 'required',
            'autopsy_findings' => 'required',
            'tobacco_to_death' => 'required|string',
            'manner_of_death' => 'required',
            'name_of_person_completing_cause_death' => 'required|string',
            'address_of_person_completing_cause_of_death' => 'required|string',
            'decedent_education' => 'required',
            'decedent_origin' => 'required',
            'decedent_race' => 'required',
            'decedent_occupation' => 'required|string',
            'kind_of_business_or_industry' => 'required|string'
        ]);

        $today = date('Y-m-d');
        $to = \Carbon\Carbon::parse($today);
        $from = \Carbon\Carbon::parse($request->date_of_birth);
        $years = $to->diffInYears($from);
        $months = $to->diffInMonths($from);
        if ($years < 1) {
            if ($months < 1 ) {
                $age_class = 'Newborn';
                $weeks = $to->diffInWeeks($from);
                $age = $weeks . ' weeks old';
            } elseif($months >= 1 && $months <= 3) {
                $age_class = 'Newborn';
                $age = $months . ' months old';
            }else {
                $age_class = 'Infant';
                $age = $months . ' months old';
            }
        }elseif($years >= 1 && $years <= 5){
            $age_class = 'Toddler';
            $age = $years . ' years old';
        }elseif ($years >= 6 && $years <= 13) {
            $age_class = 'Kids';
            $age = $years . ' years old';
        }elseif($years >= 14 && $years <= 24){
            $age_class = 'Youth';
            $age = $years . ' years old';
        }else{
            $age_class = 'Adult';
            $age = $years . ' years old';
        }

        if (isset($request->method_of_disposition_specify)) {
            $method_of_disposition = $request->method_of_disposition_specify;
        }else{
            $method_of_disposition = $request->method_of_disposition;
        }
        $slug = Str::slug($request->decedent_legal_name);
        $deaths = DeathRecord::where('slug', $slug)->get();
        if(count($deaths) == 0){
            $slug = Str::slug($request->decedent_legal_name);
        }else{
            $slug = Str::slug($request->decedent_legal_name) . '-' . Str::lower(Str::random(5));
        }

        $data = [
            'decedent_legal_name' => $request->decedent_legal_name,
            'slug' => $slug,
            'gender' => $request->gender,
            'nin_number' => $request->nin_number,
            'date_of_birth' => $request->date_of_birth,
            'age' => $age,
            'age_class' => $age_class,
            'birth_place' => $request->birth_place,
            'address' => $request->address,
            'state' => $request->state,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
            'father_name' => $request->father_name,
            'mother_name' => $request->mother_name,
            'marital_status' => $request->marital_status,
            'surviving_spouse_name' => $request->surviving_spouse_name,
            'informant_name' => $request->informant_name,
            'relationship_with_decedent' => $request->relationship_with_decedent,
            'if_death_occured_in_a_hospital' => $request->if_death_occured_in_a_hospital,
            'if_death_occurred_somewhere_other_than_hospital' => $request->if_death_occurred_somewhere_other_than_hospital,
            'facility_name' => $request->facility_name,
            'facility_address' => $request->facility_address,
            'method_of_disposition' => $method_of_disposition,
            'place_of_disposition' => $request->place_of_disposition,
            'address_of_disposition' => $request->address_of_disposition,
            'name_and_address_of_funeral_facility' => $request->name_and_address_of_funeral_facility,
            'date_pronounced_dead' => $request->date_pronounced_dead,
            'time_pronounced_dead' => $request->time_pronounced_dead,
            'actual_date_of_death' => $request->actual_date_of_death,
            'actual_time_of_death' => $request->actual_time_of_death,
            'medical_examminer_contacted' => $request->medical_examminer_contacted,
            'immediate_cause_of_death' => $request->immediate_cause_of_death,
            'immediate_cause_of_death_interval' => $request->immediate_cause_of_death_interval,
            'sequential_cause_of_death' => $request->sequential_cause_of_death,
            'sequential_cause_of_death_interval' => $request->sequential_cause_of_death_interval,
            'underlying_cause_of_death' => $request->underlying_cause_of_death,
            'underlying_cause_of_death_interval' => $request->underlying_cause_of_death_interval,
            'last_event_resulting_in_death' => $request->last_event_resulting_in_death,
            'last_event_resulting_in_death_interval' => $request->last_event_resulting_in_death_interval,
            'significant_conditions_contibuting_to_death' => $request->significant_conditions_contibuting_to_death,
            'autopsy_performed' => $request->autopsy_performed,
            'autopsy_findings' => $request->autopsy_findings,
            'tobacco_to_death' => $request->tobacco_to_death,
            'pregnancy' => $request->pregnancy,
            'manner_of_death' => $request->manner_death,
            'date_of_injury' => $request->date_of_injury,
            'time_of_injury' => $request->time_of_injury,
            'place_of_injury' => $request->place_of_injury,
            'injury_at_work' => $request->injury_at_work,
            'address_of_injury' => $request->address_of_injury,
            'how_injury_occurred' => $request->how_injury_occured,
            'transportation_injury' => $request->transportation_injury,
            'name_of_person_completing_cause_death' => $request->name_of_person_completing_cause_death,
            'address_of_person_completing_cause_of_death' => $request->address_of_person_completing_cause_of_death,
            'decedent_education' => $request->decedent_education,
            'decedent_origin' => $request->decedent_origin,
            'decedent_race' => $request->decedent_race,
            'decedent_occupation' => $request->decedent_occupation,
            'kind_of_business_or_industry' => $request->kind_of_business_or_industry
        ];
        DeathRecord::where('slug', $slug)->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
