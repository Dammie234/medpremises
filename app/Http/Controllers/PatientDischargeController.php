<?php

namespace App\Http\Controllers;
use DB;
use App\User;
use App\VitalSign;
use App\AdmissionFacility;
use App\DischargePlanningChecklist;
use App\PatientDischarge;
use Illuminate\Http\Request;

class PatientDischargeController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'reason_for_admittance' => 'required|string',
            'date_discharged' => 'required|date',
            'physician_approved' => 'required',
            'reason_for_discharge' => 'required|string',
            'diagnosis_at_discharge' => 'required|string',
        ]);
        $key = $request->key;
        $user = User::where('id', $request->id)->first();
        // get admission
        $admission = AdmissionFacility::where(['key' => $key, 'active' => true])->first();
        $patient_id = $admission->patient_id;
        $admitted_date = $admission->admitted_date;
        // get medical diagnosis
        $medical_diagnostic = DB::table('medical_diagnostics')->where('key', $key)->first();
        // get medical treatment
        $medical_treatment = DB::table('medical_treatments')->where('key', $key)->first();

        $discharge = PatientDischarge::create([
            'patient_id' => $patient_id,
            'key' => $key,
            'reason_for_admittance' => $request->reason_for_admittance,
            'admitted_date' => $admitted_date,
            'diagnosis_at_admittance' => $medical_diagnostic->diagnosis,
            'treatment_summary' => $medical_treatment->treatment,
            'date_discharged' => $request->date_discharged,
            'physician_approved' => $request->physician_approved,
            'reason_for_discharged' => $request->reason_for_discharge,
            'diagnosis_at_discharge' => $request->diagnosis_at_discharge,
            'staff_id' => $user->id,
            'staff_name' => $user->name,
            'facility_id' => $user->facility_id
        ]);
        DischargePlanningChecklist::create([
            'patient_id' => $patient_id,
            'key' => $key,
            'patient_discharge_id' => $discharge->id,
            'staff_id' => $user->id,
            'staff_name' => $user->name,
            'facility_id' => $user->facility_id
        ]);
        AdmissionFacility::where('key', $key)->update([
            'active' => false
        ]);
        VitalSign::where('key', $key)->update([
            'discharge_patient' => true
        ]);
    }
    public function index($id)
    {
        $user = User::where('id', $id)->first();
        $patients = DB::table('patient_discharges')
                        ->leftJoin('patients', 'patients.id', '=', 'patient_discharges.patient_id')
                        ->where('patient_discharges.facility_id', $user->facility_id)
                        ->select('patient_discharges.*', 'patients.name')
                        ->get();
        return response()->json($patients);
    }
    public function show($key)
    {
        $patient = DB::table('patient_discharges')
                        ->leftJoin('patients', 'patients.id', 'patient_discharges.patient_id')
                        ->where('patient_discharges.key', $key)
                        ->select('patient_discharges.*', 'patients.name')
                        ->first();
        return response()->json($patient);
    }
    public function checklist($key)
    {
        return response()->json(DischargePlanningChecklist::where('key', $key)->first());
    }
    public function updateDischargePlanningChecklist(Request $request, $key)
    {
        if ($request->staff == true) {
            $this->validate($request, [
                'side_effects' => 'required|string',
                'what_to_expect' => 'required|string',
                'pain_experience' => 'required|string',
                'special_diet' => 'required|string',
                'activities' => 'required|string',
                'work_school_return' => 'required|string',
                'when_to_drive' => 'required|string',
                'when_to_bath' => 'required|string',
                'climb_stairs' => 'required|string',
                'inpatient_healthcare_setting' => 'required|string',
                'outpatient_theraphy' => 'required|string',
                'appointment_plan' => 'required',
                'follow_up_testing' => 'required|string',
                'urgent_issue' => 'required|string',
                'general_question' => 'required|string',
                'doctor_appointment' => 'required|string'
            ]);
        }
        if ($request->patient == true) {
            $this->validate($request, [
                'where_to_go_after_discharge' => 'required|string',
                'caregiver_contact' => 'required|string',
                ''
            ]);
        }
        $data = [
            'where_to_go_after_discharge' => $request->where_to_go_after_discharge,
            'job_arrangement' => $request->job_arrangement,
            'caregiver_arrangement' => $request->caregiver_arrangement,
            'health_insurance_services' => $request->health_insurance_services,
            'hospital_bills' => $request->hospital_bills,
            'caregiver_contact' => $request->caregiver_contact,
            'patient_help' => $request->patient_help,
            'task_for_help' => $request->task_for_help,
            'caregiver_education' => $request->caregiver_education,
            'who_to_contact_information' => $request->who_to_contact_for_question,
            'side_effects' => $request->side_effects,
            'what_to_expect' => $request->what_to_expect,
            'pain_experience' => $request->pain_experience,
            'special_diet' => $request->special_diet,
            'activities' => $request->activities,
            'work_school_return' => $request->work_school_return,
            'when_to_drive' => $request->when_to_drive,
            'when_to_bath' => $request->when_to_bath,
            'climb_stairs' => $request->climb_stairs,
            'care_for_incision' => $request->care_for_incision,
            'medical_equipment' => $request->medical_equipment,
            'understand_medical_treatment' => $request->understand_medical_treatment,
            'inpatient_healthcare_setting' => $request->inpatient_healthcare_setting,
            'outpatient_theraphy' => $request->outpatient_theraphy,
            'appointment_plan' => $request->appointment_plan,
            'follow_up_testing' => $request->follow_up_testing,
            'urgent_issue' => $request->urgent_issue,
            'general_question' => $request->general_question,
            'doctor_appointment' => $request->doctor_appointment
        ];
        if (isset($request->discharge_instructions) && count($request->discharge_instructions) != 0) {
            $data['discharge_instruction_id'] = implode(', ', $request->discharge_instructions);
        }
        DischargePlanningChecklist::where('key', $key)->update($data);
    }
}
