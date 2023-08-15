<?php

namespace App\Http\Controllers;
use DB;
use App\User;
use DateTime;
use App\Patient;
use App\Biodata;
use App\VitalSign;
use App\OutpatientVisit;
use App\PatientInvoice;
use App\HospitalClass;
use App\AdmissionFacility;
use App\MedicalHistory;
use App\MedicalTreatment;
use App\DiseaseDemographic;
use App\MedicalDiagnostic;
use App\MedicalExamination;
use App\PatientMedicalService;
use App\MedicalConsultation;
use App\MedicalInvestigation;
use App\MedicalPrescribedDrug;
use App\MedicalTreatmentPlan;
use App\MedicalTreatmentPlanType;
use App\PatientDeposit;
use App\PatientProgressNoteTypeA;
use App\PatientProgressNoteTypeB;
use Illuminate\Http\Request;

class MedicalConsultationController extends Controller
{
    public function makeConsultation($patient_id, $key, $id)
    {
        $user = User::where('id', $id)->first();
        $consultations = MedicalConsultation::where(['key' => $key, 'facility_id' => $user->facility_id])->get();
        if (count($consultations) == 0) {
            $data = [
                'patient_id' => $patient_id,
                'key' => $key,
                'staff_id' => $user->id,
                'staff_name' => $user->name,
                'facility_id' => $user->facility_id
            ];

            MedicalConsultation::create($data);
            MedicalHistory::create($data);
            MedicalExamination::create($data);
            MedicalDiagnostic::create($data);
            MedicalInvestigation::create($data);
            MedicalTreatment::create($data);
            MedicalPrescribedDrug::create($data);
            PatientProgressNoteTypeA::create($data);
            VitalSign::where('key', $key)->update([
                'consultation' => true
            ]);
        } else {
            return response()->json(['error' => 'Patient already under-going a consultation.'], 401);
        }
    }
    public function consultation($key)
    {
        $consultation = MedicalConsultation::where('key', $key)->first();
        $history = MedicalHistory::where('key', $key)->first();
        $examination = MedicalExamination::where('key', $key)->first();
        $diagnostic = MedicalDiagnostic::where('key', $key)->first();
        $investigation = MedicalInvestigation::where('key', $key)->first();
        $treatment = MedicalTreatment::where('key', $key)->first();
        $drug = MedicalPrescribedDrug::where('key', $key)->first();
        $patient = Patient::where('id', $consultation->patient_id)->first();
        $treatment_plan = MedicalTreatmentPlan::where('key', $key)->first();
        $progress_note = PatientProgressNoteTypeA::where('key', $key)->first();
        $vital_sign = VitalSign::where('key', $key)->first();
        $consultation_details = DB::table('medical_consultations')
                            ->leftJoin('patients', 'patients.id', '=', 'medical_consultations.patient_id')
                            ->leftJoin('users', 'users.facility_id', '=', 'medical_consultations.facility_id')
                            ->leftJoin('facility_signatures', 'facility_signatures.facility_id', '=', 'medical_consultations.facility_id')
                            ->where(['medical_consultations.completed' => true, 'medical_consultations.key' => $key])
                            ->select('patients.name', 'medical_consultations.*', 'facility_signatures.registered_facility_name', 'users.email as uemail', 'facility_signatures.logo', 'facility_signatures.physical_location', 'facility_signatures.state', 'facility_signatures.postal_code', 'facility_signatures.phone_number', 'facility_signatures.website', 'facility_signatures.facility_uniqueness', 'facility_signatures.ownership_picture', 'users.name', 'users.role')
                            ->first();
        return response()->json(['consultation' => $consultation, 'history' => $history, 'examination' => $examination, 'diagnostic' => $diagnostic, 'investigation' => $investigation, 'treatment' => $treatment, 'drug' => $drug, 'patient' => $patient, 'treatment_plan' => $treatment_plan, 'progress_note' => $progress_note, 'consultation_details' => $consultation_details, 'vital_sign' => $vital_sign]);
    }
    public function getFacilityServices($id)
    {
        $user = User::where('id', $id)->first();
        $class = HospitalClass::where('facility_id',$user->facility_id)->first();
        if ($class->cardiology) {
            $services[] = 'Cardiology';
        }else{
            $other_services[] = 'Cardiology';
        }
        if ($class->gastroenterology) {
            $services[] = 'Gastroenterology';
        }else{
            $other_services[] = 'Gastroenterology';
        }
        if ($class->nephrology) {
            $services[] = 'Nephrology';
        }else{
            $other_services[] = 'Nephrology';
        }
        if ($class->dermatology) {
            $services[] = 'Dermatology';
        }else{
            $other_services[] = 'Dermatology';
        }
        if ($class->hematology) {
            $services[] = 'Hematology';
        }else{
            $other_services[] = 'Hematology';
        }
        if ($class->endocrinology) {
            $services[] = 'Endocrinology';
        }else{
            $other_services[] = 'Endocrinology';
        }
        if ($class->geriatrics) {
            $services[] = 'Geriatrics';
        }else{
            $other_services[] = 'Geriatrics';
        }
        if ($class->psychiatry) {
            $services[] = 'Psychiatry/Behavioral Medicine';
        }else{
            $other_services[] = 'Psychiatry/Behavioral Medicine';
        }
        if ($class->pulmonology) {
            $services[] = 'Pulmonology';
        }else{
            $other_services[] = 'Pulmonology';
        }
        if ($class->neurology) {
            $services[] = 'Neurology';
        }else{
            $other_services[] = 'Neurology';
        }
        if ($class->infectious_diseases) {
            $services[] = 'Infectious Diseases';
        }else{
            $other_services[] = 'Infectious Diseases';
        }
        if ($class->nuclear_medicine) {
            $services[] = 'Nuclear Medicine';
        }else{
            $other_services[] = 'Nuclear Medicine';
        }
        if ($class->family_medicine) {
            $services[] = 'Family Medicine';
        }else{
            $other_services[] = 'Family Medicine';
        }
        if ($class->general_surgery) {
            $services[] = 'General Surgery';
        }else{
            $other_services[] = 'General Surgery';
        }
        if ($class->ophthalmology) {
            $services[] = 'Ophthalmology';
        }else{
            $other_services[] = 'Ophthalmology';
        }
        if ($class->cardiothoracic_surgery) {
            $services[] = 'Cardiothoracic Surgery';
        }else{
            $other_services[] = 'Cardiothoracic Surgery';
        }
        if ($class->neuro_surgery) {
            $services[] = 'Neuro-Surgery';
        }else{
            $other_services[] = 'Neuro-Surgery';
        }
        if ($class->orthopedic_surgery) {
            $services[] = 'Orthopedic Surgery';
        }else{
            $other_services[] = 'Orthopedic Surgery';
        }
        if ($class->urology) {
            $services[] =  'Urology';
        }else{
            $other_services[] = 'Urology';
        }
        if ($class->otorhinolaryngology) {
            $services[] = 'Otorhinolaryngology (ENT)';
        }else{
            $other_services[] = 'Otorhinolaryngology (ENT)';
        }
        if ($class->anesthesia) {
            $services[] = 'Anesthesia';
        }else{
            $other_services[] = 'Anesthesia';
        }
        if ($class->oncology) {
            $services[] = 'Oncology/Radiotherapy';
        }else{
            $other_services[] = 'Oncology/Radiotherapy';
        }
        if ($class->radiology) {
            $services[] = 'Radiology';
        }else{
            $other_services[] = 'Radiology';
        }
        if ($class->vascular_surgery) {
            $services[] = 'Vascular Surgery';
        }else{
            $other_services[] = 'Vascular Surgery';
        }
        if ($class->pediatric_surgery) {
            $services[] = 'Pediatric Surgery';
        }else{
            $other_services[] = 'Pediatric Surgery';
        }
        if ($class->plastic_surgery) {
            $services[] = 'Plastic Surgery';
        }else{
            $other_services[] = 'Plastic Surgery';
        }
        if ($class->pathology) {
            $services[] = 'Pathology';
        }else{
            $other_services[] = 'Pathology';
        }
        if ($class->obstetrics) {
            $services[] = 'Obstetrics';
        }else{
            $other_services[] = 'Obstetrics';
        }
        if ($class->gynecology) {
            $services[] = 'Gynecology';
        }else{
            $other_services[] = 'Gynecology';
        }
        if ($class->fertility_reproductive_techniques) {
            $services[] = 'Fertility Reproductive Techniques';
        }else{
            $other_services[] = 'Fertility Reproductive Techniques';
        }
        if ($class->p_gastroenterology) {
            $services[] = 'Pediatric Gastroenterology';
        }else{
            $other_services[] = 'Pediatric Gastroenterology';
        }
        if ($class->p_pulmomology) {
            $services[] =  'Pediatric Pulmonology';
        }else{
            $other_services[] = 'Pediatric Pulmonology';
        }
        if ($class->p_nephrology) {
            $services[] = 'Pediatric Nephrology';
        }else{
            $other_services[] = 'Pediatric Nephrology';
        }
        if ($class->p_neonatology) {
            $services[] = 'Pediatric Neonatology';
        }else{
            $other_services[] = 'Pediatric Neonatology';
        }
        if ($class->child_psychiatry) {
            $services[] = 'Child Psychiatry/Behavioral Medicine';
        }else{
            $other_services[] = 'Child Psychiatry/Behavioral Medicine';
        }
        if ($class->p_oncology) {
            $services[] = 'Pediatric Oncology';
        }else{
            $other_services[] = 'Pediatric Oncology';
        }
        if ($class->p_endocrinology) {
            $services[] = 'Pediatric Endocrinology';
        }else{
            $other_services[] = 'Pediatric Endocrinology';
        }
        if ($class->oral_and_maxilo_facial_surgery) {
            $services[] = 'Oral and Maxillo-Facial Surgery';
        }else{
            $other_services[] = 'Oral and Maxillo-Facial Surgery';
        }
        if ($class->periodontics) {
            $services[] = 'Periodontics';
        }else{
            $other_services[] = 'Periodontics';
        }
        return response()->json(['services' => $services, 'other_services' => $other_services]);
    }
    public function updateMedicalHistory(Request $request, $key)
    {
        $this->validate($request, [
            'chief_complaint' => 'required|string',
            'history_of_present_illness' => 'required|string',
            'review_of_system' => 'required|string'
        ]);

        $user = User::where('id', $request->id)->first();
        MedicalHistory::where(['key' => $key, 'facility_id' => $user->facility_id])->update([
            'chief_complaint' => $request->chief_complaint,
            'history_of_present_illness' => $request->history_of_present_illness,
            'past_medical_history' => $request->past_medical_history,
            'family_history' => $request->family_history,
            'social_history' => $request->social_history,
            'allergies' => $request->allergies,
            'review_of_system' => $request->review_of_system,
            'staff_id' => $user->id,
            'staff_name' => $user->name
        ]);
    }
    public function updateMedicalExamination(Request $request, $key)
    {
        $this->validate($request, [
            'physical_examination' => 'required|string'
        ]);
        $user = User::where('id', $request->id)->first();
        MedicalExamination::where(['key' => $key, 'facility_id' => $user->facility_id])->update([
            'physical_examination' => $request->physical_examination,
            'staff_id' => $user->id,
            'staff_name' => $user->name
        ]);
    }
    public function updateMedicalDiagnostic(Request $request, $key)
    {
        $this->validate($request, [
            'diagnosis_i' => 'required'
        ]);
        $diagnosis = [];
        if (isset($request->diagnosis_i)) {
            $diagnosis[] = $request->diagnosis_i['name'];
        }
        if (isset($request->diagnosis_ii)) {
            $diagnosis[] = $request->diagnosis_ii['name'];
        }
        if (isset($request->diagnosis_iii)) {
            $diagnosis[] = $request->diagnosis_iii['name'];
        }
        $user = User::where('id', $request->id)->first();
        MedicalDiagnostic::where(['key' => $key, 'facility_id' => $user->facility_id])->update([
            'diagnosis' => implode(', ', $diagnosis),
            'staff_id' => $user->id,
            'staff_name' => $user->name
        ]);
    }
    public function updateMedicalInvestigation(Request $request, $key)
    {
        $this->validate($request, [
            'test_i' => 'required'
        ]);
        $tests = [];
        if (isset($request->test_i['test_name'])) {
            $tests[] = $request->test_i['test_name'];
        }
        if (isset($request->test_ii['test_name'])) {
            $tests[] = $request->test_ii['test_name'];
        }
        if (isset($request->test_iii['test_name'])) {
            $tests[] = $request->test_iii['test_name'];
        }
        if (isset($request->test_iv['test_name'])) {
            $tests[] = $request->test_iv['test_name'];
        }
        $user = User::where('id', $request->id)->first();
        MedicalInvestigation::where(['key' => $key, 'facility_id' => $user->facility_id])->update([
            'investigation' => implode(', ', $tests),
            'staff_id' => $user->id,
            'staff_name' => $user->name
        ]);
    }
    public function conductedPatientMedicalLaboratoryTests($key)
    {
        return response()->json(DB::table('patient_medical_laboratory_tests')->where([['key', '=', $key], ['test_result', '!=', null]])->get());
    }
    public function updateMedicalTreatment(Request $request, $key)
    {
        $this->validate($request, [
            'treatment' => 'required|string',
            'patient_type' => 'required|string'
        ]);
        $user = User::where('id', $request->id)->first();
        MedicalTreatment::where('key', $key)->update([
            'treatment' => $request->treatment,
            'patient_type' => $request->patient_type,
            'staff_id' => $user->id,
            'staff_name' => $user->name
        ]);
        $consultation = MedicalConsultation::where(['key' => $key, 'facility_id' => $user->facility_id])->first();
        $diagnostic = MedicalDiagnostic::where(['key' => $key, 'facility_id' => $user->facility_id])->first();
        $plans = MedicalTreatmentPlan::where(['key' => $key, 'facility_id' => $user->facility_id])->get();

        if (count($plans) == 0) {
            MedicalTreatmentPlan::create([
                'patient_id' => $consultation->patient_id,
                'key' => $key,
                'diagnosis' => $diagnostic->diagnosis,
                'long_term_goal' => $request->treatment,
                'staff_id' => $user->id,
                'staff_name' => $user->name,
                'facility_id' => $user->facility_id
            ]);
        } else {
            MedicalTreatmentPlan::where(['key' => $key, 'facility_id' => $user->facility_id])->update([
                'diagnosis' => $diagnostic->diagnosis,
                'long_term_goal' => $request->treatment,
                'staff_id' => $user->id,
                'staff_name' => $user->name
            ]);
        }
        // check if inpatient
        if ($request->patient_type == 'Inpatient') {

            VitalSign::where('key', $key)->update([
                'documentation' => true,
                'admission' => true
            ]);
            // get who to contact
            $contact_name = '';
            $contact_phone = '';
            $checkin = DB::table('patient_checkins')->where(['patient_id' => $consultation->patient_id, 'key' => $key, 'active' => true])->first();
            if ($checkin->self) {
                $kin = DB::table('kin')->where('patient_id', $consultation->patient_id)->first();
                $contact_name = $kin->name;
                $contact_phone = $kin->mobile_phone;
            } else {
                $contact_name = $checkin->brought_name;
                $contact_phone = $checkin->brought_phone;
            }
            if ($contact_name == '' && $contact_phone == '' && isset($request->contact_name) && isset($request->contact_phone)) {
                $contact_name = $request->contact_name;
                $contact_phone = $request->contact_phone;
            }
            $admissions = AdmissionFacility::where(['key' => $key, 'facility_id' => $user->facility_id, 'patient_id' => $consultation->patient_id])->get();
            if (count($admissions) == 0) {
                $this->validate($request, [
                    'admitted_date' => 'required',
                    'admission_type' => 'required',
                    'admitted_through' => 'required',
                    'room_type' => 'required',
                    'room_number' => 'required',
                    'amount' => 'required'
                ]);
                AdmissionFacility::create([
                    'patient_id' => $consultation->patient_id,
                    'key' => $key,
                    'contact_name' => $contact_name,
                    'contact_phone' => $contact_phone,
                    'admitted_date' => $request->admitted_date,
                    'admission_type' => $request->admission_type,
                    'admitted_through' => $request->admitted_through,
                    'room_type' => $request->room_type,
                    'room_number' => $request->room_number,
                    'admitting_diagnosis' => $diagnostic->diagnosis,
                    'staff_id' => $user->id,
                    'staff_name' => $user->name,
                    'facility_id' => $user->facility_id
                ]);
                $description = ['Admitted Medical Service', 'Consultation Fee'];
                if($request->room_type == 'Public'){
                    $description[] = 'Shared Bed Charge';
                }else{
                    $description[] = 'Private Bed Charge';
                }
                $services = [];
                foreach ($description as $name) {
                    $services[] = DB::table('medical_services')->where(['facility_id' => $user->facility_id, 'name' => $name])->first();
                }
                foreach ($services as $service) {
                    PatientMedicalService::create([
                        'patient_id' => $consultation->patient_id,
                        'key' => $key,
                        'medical_service_id' => $service->id,
                        'fee' => $service->price,
                        'staff_id' => $user->id,
                        'staff_name' => $user->name,
                        'facility_id' => $user->facility_id
                    ]);
                    PatientInvoice::create([
                        'patient_id' => $consultation->patient_id,
                        'key' => $key,
                        'description' => $service->name,
                        'quantity' => 1,
                        'amount' => $service->price,
                        'staff_id' => $user->id,
                        'staff_name' => $user->name,
                        'facility_id' => $user->facility_id
                    ]);
                }
            }
            $deposits =  PatientDeposit::where(['key' => $key, 'patient_id' => $consultation->patient_id, 'facility_id' => $user->facility_id])->get();
            if (count($deposits) == 0) {
                PatientDeposit::create([
                    'patient_id' => $consultation->patient_id,
                    'key' => $key,
                    'diagnosis' => $diagnostic->diagnosis,
                    'amount' => $request->amount,
                    'staff_id' => $user->id,
                    'staff_name' => $user->name,
                    'facility_id' => $user->facility_id
                ]);
            }
        } else {
            // outpatient
            $description = 'Outpatient Charge';
            $service = DB::table('medical_services')->where(['facility_id' => $user->facility_id, 'name' => $description])->first();
            $invoices = PatientInvoice::where(['key' => $key, 'facility_id' => $user->facility_id])->get();
            VitalSign::where('key', $key)->update([
                'documentation' => true,
                'drug_prescription_plan' => true,
                'outpatient_visit' => true
            ]);
            if (count($invoices) == 0) {
                PatientInvoice::create([
                    'patient_id' => $consultation->patient_id,
                    'key' => $key,
                    'description' => $description,
                    'quantity' => 1,
                    'amount' => $service->price,
                    'staff_id' => $user->id,
                    'staff_name' => $user->name,
                    'facility_id' => $user->facility_id
                ]);
                PatientMedicalService::create([
                    'patient_id' => $consultation->patient_id,
                    'key' => $key,
                    'medical_service_id' => $service->id,
                    'fee' => $service->price,
                    'staff_id' => $user->id,
                    'staff_name' => $user->name,
                    'facility_id' => $user->facility_id
                ]);
            }
        }
    }

    public function admissionFacilityDetail($key)
    {
        return response()->json(AdmissionFacility::where('key', $key)->first());
    }
    public function updateMedicalPrescribedDrug(Request $request, $key)
    {
        $this->validate($request, [
            'drugs' => 'required|string'
        ]);
        $user = User::where('id', $request->id)->first();
        MedicalPrescribedDrug::where('key', $key)->update([
            'drugs' => $request->drugs,
            'staff_id' => $user->id,
            'staff_name' => $user->name
        ]);
    }
    public function updateMedicalTreatmentPlan(Request $request, $key)
    {
        $this->validate($request, [
            'problem' => 'required|string'
        ]);
        $user = User::where('id', $request->id)->first();
        MedicalTreatmentPlan::where('key', $key)->update([
            'problem' => $request->problem,
            'long_term_goal' => $request->long_term_goal,
            'staff_id' => $user->id,
            'staff_name' => $user->name
        ]);
        if (isset($request->long_term_goal)) {
            MedicalTreatment::where('key', $key)->update([
                'treatment' => $request->long_term_goal,
                'staff_id' => $user->id,
                'staff_name' => $user->name
            ]);
        }
    }
    public function storeShortTermGoal(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        $plan = MedicalTreatmentPlan::where('key', $request->key)->first();
        $consultation = MedicalConsultation::where('key', $request->key)->first();
        // get the last short term goal
        $goal = MedicalTreatmentPlanType::where('key', $request->key)->orderBy('id', 'desc')->first();
        //dd($goal, $request->key);
        if ($goal == null) {
            // add
            MedicalTreatmentPlanType::create([
                'patient_id' => $consultation->patient_id,
                'key' => $request->key,
                'medical_treatment_plan_id' => $plan->id,
                'date1' => $request->date1,
                'problem' => $request->problem,
                'short_term_goal' => $request->short_term_goal,
                'approaches' => $request->approaches,
                'staff_id' => $user->id,
                'staff_name' => $user->name,
                'facility_id' => $user->facility_id
            ]);
        }else{
            if ($goal->date1 != null && $goal->problem != null && $goal->short_term_goal != null && $goal->approaches != null) {
                # add
                MedicalTreatmentPlanType::create([
                    'patient_id' => $consultation->patient_id,
                    'key' => $request->key,
                    'medical_treatment_plan_id' => $plan->id,
                    'date1' => $request->date1,
                    'problem' => $request->problem,
                    'short_term_goal' => $request->short_term_goal,
                    'approaches' => $request->approaches,
                    'staff_id' => $user->id,
                    'staff_name' => $user->name,
                    'facility_id' => $user->facility_id
                ]);
            }else{
                return response()->json(['error' => 'Medical Treatment Plan has been added, edit the previous one before you can add a new one.'], 401);
            }
        }
    }
    public function planTypes($key)
    {
        return response()->json(MedicalTreatmentPlanType::where('key', $key)->get());
    }
    public function planType($key, $id)
    {
        return response()->json(MedicalTreatmentPlanType::where(['key' => $key, 'id' => $id])->first());
    }
    public function updateShortTermGoal(Request $request, $key, $id, $user_id)
    {
        $user = User::where('id', $user_id)->first();
        MedicalTreatmentPlanType::where(['id' => $id, 'key' => $key])->update([
            'date1' => $request->date1,
            'problem' => $request->problem,
            'short_term_goal' => $request->short_term_goal,
            'approaches' => $request->approaches,
            'date2' => $request->date2,
            'evaluation' => $request->evaluation,
            'goals_met' => $request->goals_met,
            'staff_id' => $user->id,
            'staff_name' => $user->name,
        ]);
    }
    public function updateProgressNoteTypeA(Request $request, $key)
    {
        $user = User::where('id', $request->id)->first();
        PatientProgressNoteTypeA::where('key', $key)->update([
            'blood_sugar' => $request->blood_sugar,
            'weight' => $request->weight,
            'blood_pressure' => $request->blood_pressure,
            'other' => $request->other,
            'staff_id' => $user->id,
            'staff_name' => $user->name
        ]);
    }
    public function storePatientProgressNoteTypeB(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        $consultation = MedicalConsultation::where('key', $request->key)->first();
        PatientProgressNoteTypeB::create([
            'patient_id' => $consultation->patient_id,
            'key' => $request->key,
            'note' => $request->note,
            'staff_id' => $user->id,
            'staff_name' => $user->name,
            'facility_id' => $user->facility_id
        ]);
    }
    public function patientProgressNotes($key)
    {
        return response()->json(PatientProgressNoteTypeB::where('key', $key)->get());
    }
    public function patientProgressNote($id)
    {
        return response()->json(PatientProgressNoteTypeB::where('id', $id)->first());
    }
    public function updatePatientProgressNoteTypeB(Request $request, $id)
    {
        $user = User::where('id', $request->id)->first();

        PatientProgressNoteTypeB::where('id', $id)->update([
            'note' => $request->note,
            'staff_id' => $user->id,
            'staff_name' => $user->name
        ]);
    }
    public function destroyPatientProgressNoteTypeB($id)
    {
        PatientProgressNoteTypeB::where('id', $id)->delete();
    }
    public function endMedicalConsultation($key)
    {
        $data = [
            'completed' => true
        ];
        VitalSign::where('key', $key)->update($data);
        MedicalConsultation::where('key', $key)->update($data);
        MedicalHistory::where('key', $key)->update($data);
        MedicalExamination::where('key', $key)->update($data);
        MedicalDiagnostic::where('key', $key)->update($data);
        MedicalInvestigation::where('key', $key)->update($data);
        MedicalTreatment::where('key', $key)->update($data);
        MedicalPrescribedDrug::where('key', $key)->update($data);
        $treatment = MedicalTreatment::where('key', $key)->first();
        if($treatment->patient_type == 'Inpatient'){
            VitalSign::where('key', $key)->update([
                'drug_prescription_plan' => true
            ]);
        }
        $diagnostic = MedicalDiagnostic::where('key', $key)->first();
        $patient = Patient::where('id', $diagnostic->patient_id)->first();
        $biodata = Biodata::where('patient_id', $diagnostic->patient_id)->first();
        $diagnosis = explode(', ', $diagnostic->diagnosis);
        $today = date('Y-m-d');
        $to = \Carbon\Carbon::parse($today);
        $from = \Carbon\Carbon::parse($biodata->date_of_birth);
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
        $facility = DB::table('facility_signatures')->where('facility_id', $diagnostic->facility_id)->first();
        foreach ($diagnosis as $value) {
            DiseaseDemographic::create([
                'patient_id' => $diagnostic->patient_id,
                'key' => $key,
                'type' => $value,
                'user_name' => $patient->name,
                'gender' => $biodata->gender,
                'age' => $age,
                'user_type' => $age_class,
                'staff_id' => $diagnostic->staff_id,
                'staff_name' => $diagnostic->staff_name,
                'facility_id' => $diagnostic->facility_id,
                'registered_facility_name' => $facility->registered_facility_name,
                'source' => $facility->facility_type,
                'state' => $facility->state
            ]);
        }
    }
    public function previousConsultations($patient_id)
    {
        $consultations = DB::table('medical_consultations')
                            ->leftJoin('patients', 'patients.id', '=', 'medical_consultations.patient_id')
                            ->leftJoin('facility_signatures', 'facility_signatures.facility_id', '=', 'medical_consultations.facility_id')
                            ->where(['medical_consultations.completed' => true, 'medical_consultations.patient_id' => $patient_id])
                            ->select('patients.name', 'medical_consultations.*', 'facility_signatures.registered_facility_name')
                            ->get();
        return response()->json($consultations);
    }
    public function patientById($patient_id)
    {
        return response()->json(Patient::where('id', $patient_id)->first());
    }
}
