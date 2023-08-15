<?php

namespace App\Http\Controllers;
use App\User;
use App\Patient;
use App\Biodata;
use App\FacilitySignature;
use App\MedicalConsultation;
use App\PatientSatisfactorySurvey;
use Illuminate\Http\Request;

class PatientSatisfactorySurveyController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'experience' => 'required|string',
            'why_choose_us' => 'required|string',
            'first_time' => 'required|string',
            'impressed' => 'required|string',
            'exceptional_staff' => 'required|string',
            'hospital_name' => 'required|string',
            'special_needs' => 'required',
            'return_for_medical_care' => 'required',
            'why_return_for_medical_care' => 'required|string',
            'recommend_facility' => 'required|string',
            'why_recommend_facility' => 'required|string'
        ]);
        $biodata = Biodata::where('patient_id', $request->patient_id)->first();
        $today = date('Y-m-d');
        $to = \Carbon\Carbon::parse($today);
        $from = \Carbon\Carbon::parse($biodata->date_of_birth);
        $years = $to->diffInYears($from);
        $age = $years . ' years old';
        Biodata::where('patient_id', $request->patient_id)->update([
            'age' => $age
        ]);
        $patient = Patient::where('id', $request->patient_id)->first();
        $consultation = MedicalConsultation::where(['patient_id' => $request->patient_id, 'key' => $request->key])->first();
        $facility = FacilitySignature::where('facility_id', $consultation->facility_id)->first();
        PatientSatisfactorySurvey::create([
            'patient_id' => $request->patient_id,
            'facility_id' => $consultation->facility_id,
            'key' => $request->key,
            'experience' => $request->experience,
            'why_choose_us' => $request->why_choose_us,
            'first_time' => $request->first_time,
            'age' => $age,
            'registered_facility_name' => $facility->registered_facility_name,
            'impressed' => $request->impressed,
            'exceptional_staff' => $request->exceptional_staff,
            'hospital_name' => $request->hospital_name,
            'name' => $patient->name,
            'nursing_care' => $request->nursing_care,
            'medical_officer_care' => $request->medical_officer_care,
            'clerical_staff' => $request->clerical_staff,
            'food_services' => $request->food_services,
            'cleanliness' => $request->cleanliness,
            'staff_courtesy' => $request->staff_courtesy,
            'discharge_process' => $request->discharge_process,
            'facilities_and_accomodation' => $request->facilities_and_accomodation,
            'special_needs' => $request->special_needs,
            'return_for_medical_care' => $request->return_for_medical_care,
            'why_return_for_medical_care' => $request->why_return_for_medical_care,
            'recommend_facility' => $request->recommend_facility,
            'why_recommend_facility' => $request->why_recommend_facility
        ]);
        MedicalConsultation::where(['patient_id' => $request->patient_id, 'key' => $request->key])->update([
            'satisfactory_survey' => true
        ]);
    }
    public function index($id)
    {
        $user = User::where('id', $id)->first();
        return response()->json(PatientSatisfactorySurvey::where('facility_id', $user->facility_id)->get());
    }
    public function show($key)
    {
        return response()->json(PatientSatisfactorySurvey::where('key', $key)->first());

    }
    public function approveSurvey($key)
    {
        PatientSatisfactorySurvey::where('key', $key)->update([
            'approval' => true
        ]);
    }
}
