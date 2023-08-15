<?php

namespace App\Http\Controllers;
use DB;
use Str;
use Mail;
use App\User;
use Carbon\Carbon;
use App\Patient;
use App\Prenatal;
use App\Prenatal22Week;
use App\Prenatal28Week;
use App\Prenatal32Week;
use App\PatientInvoice;
use App\LactationInterview;
use App\PrenatalAdmission;
use App\PatientMedicalService;
use App\Prenatal19Or20Week;
use App\Prenatal26Or27Week;
use App\Prenatal34Or36Week;
use App\Prenatal38Or39Week;
use App\Prenatal40Or41Week;
use App\PrenatalFirstVisit;
use App\PrenatalMedicalRisk;
use App\PrenatalObstetricRisk;
use App\SpouseInformation;
use App\PregnancyMaternalOutcome;
use App\PrenatalInvestigation;
use App\PrenatalFamilyHistory;
use App\PrenatalMedication;
use App\PrenatalObstetricHistory;
use App\PrenatalMedicalLaboratoryTest;
use App\PrenatalBehaviouralRisk;
use App\PrenatalAdmissionSignSymptom;
use App\PrenatalPsychologicalRisk;
use Illuminate\Http\Request;
use App\Mail\SpouseInformationMail;

class PrenatalController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'patient' => 'required',
            'last_menstral_period' => 'required|date',
            'expected_due_date' => 'required|date',
            'gestational_period' => 'required|string',
            'date_of_first_prenatal_visit' => 'required|date',
            'day_of_prenatal_visit' => 'required|string',
            'expected_delivery_facility' => 'required|string',
            'pregnancy_type' => 'required|string',
            'number_of_pregnancy' => 'required|string',
            'number_of_previous_vaginal_deliveries' => 'required|string',
            'number_of_surviving_children' => 'required|string',
            'number_of_caesarian_sections' => 'required|string',
            'preterm_birth' => 'required',
            'congenital_anomaly' => 'required',
            'stillborn' => 'required',
            'neonatal_death' => 'required',
            'neonatal_death_days' => 'required',
            'lesser_weight' => 'required', '
            greater_weight' => 'required',
            'pregnancy_responsibility' => 'required',
            'smokes' => 'required',
            'substance_use' => 'required',
            'spouse_smoke' => 'required',
            'alcohol' => 'required',
            'current_rubella_immunisation' => 'required',
            'paracetamol' => 'required',
            'nsaid' => 'required',
            'anticonvulsants' => 'required',
            'antinausea' => 'required',
            'prenatal_vitamins' => 'required',
            'antivirals' => 'required',
            'antibiotics' => 'required',
            'vaginal_watery_discharge' => 'required',
            'vaginal_bleeding' => 'required',
            'headaches' => 'required',
            'vision_changes' => 'required',
            'abdominal_pain' => 'required',
            'decreased' => 'required',
            'uterine_contractions' => 'required',
            'fetal_heart_rate' => 'required|string',
            'pack_volume_cells' => 'required|string',
            'twins' => 'required',
            'high_blood_pressure' => 'required',
            'aboriginal_status' => 'required',
            'genetic_disorders' => 'required',
            'family_diabetes' => 'required',
            'edinburgh_score' => 'required',
            'well_so_far_in_this_pregnancy' => 'required',
            'ultrasound' => 'required',
            'cvs' => 'required',
            'maternal_serum_screening' => 'required',
            'amniocentesis' => 'required',
            'other_procedures' => 'required',
            'vaginal_birth' => 'required',
            'antenatal_classes' => 'required',
            'rapid_progressive_dementia' => 'required',
            'cjd' => 'required',
            'human_pituitary' => 'required',
            'dura_mater_graft' => 'required',
            'cjd_look_back' => 'required',
            'medical_in_confidence' => 'required'
        ]);
        $user = User::where('id', $request->id)->first();

        $data = [
            'patient_id' => $request->patient['patient_id'],
            'key' => $request->patient['key'],
            'last_menstral_period' => $request->last_menstral_period,
            'date_of_conception' => $request->date_of_conception,
            'gestational_period' => $request->gestational_period,
            'expected_due_date' => $request->expected_due_date,
            'date_of_first_prenatal_visit' => $request->date_of_first_prenatal_visit,
            'day_of_prenatal_visit' => $request->day_of_prenatal_visit,
            'type_of_last_delivery' => $request->type_of_last_delivery,
            'date_of_last_delivery' => $request->date_of_last_delivery,
            'expected_delivery_facility' => $request->expected_delivery_facility,
            'pregnancy_type' => $request->pregnancy_type,
            'pack_volume_cells' => $request->pack_volume_cells,
            'active' => true,
            'count_visits' => 1,
            'staff_id' => $user->id,
            'staff_name' => $user->name,
            'facility_id' => $user->facility_id,
            'fetal_heart_rate' => $request->fetal_heart_rate
        ];
        $random = Str::random(100);
        $patient = Patient::where('id', $request->patient['patient_id'])->first();
        if (isset($request->pregnancy_responsibility) && $request->pregnancy_responsibility == 1) {
            if (isset($request->add_husband) && $request->add_husband == true) {
                $spouse = SpouseInformation::create([
                    'name' => $request->spouse_name,
                    'email' => $request->spouse_email,
                    'phone_number' => $request->spouse_phone_number,
                    'gender' => $request->spouse_gender,
                    'wife_patient_id' => $request->patient['patient_id'],
                    'token' => $random
                ]);
                $mail = [
                    'name' => $request->spouse_name,
                    'email' => $request->spouse_email,
                    'token' => $random,
                    'patient' => $patient->name
                ];
                Mail::to($request->spouse_email)->send(new SpouseInformationMail($mail));
            }else{
                $spouse = DB::table('spouse_information')
                            ->where('wife_patient_id', $request->patient['patient_id'])
                            ->first();
            }
        }else{
            $spouse = SpouseInformation::create([
                'name' => $request->spouse_name,
                'email' => $request->spouse_email,
                'phone_number' => $request->spouse_phone_number,
                'gender' => $request->spouse_gender,
                'wife_patient_id' => $request->patient['patient_id'],
                'token' => $random
            ]);
            $mail = [
                'name' => $request->spouse_name,
                'email' => $request->spouse_email,
                'token' => $random,
                'patient' => $patient->name
            ];
            Mail::to($request->spouse_email)->send(new SpouseInformationMail($mail));
        }

        $data['spouse_token'] = $spouse->token;
        if (empty($request->pregnancy_scan)) {
            $data['pregnancy_scan'] = false;
        }
        if (empty($request->primp_scan)) {
            $data['primp_scan'] = false;
        }
        $prenatal = Prenatal::create($data);
        PrenatalObstetricHistory::create([
            'prenatal_id' => $prenatal->id,
            'patient_id' =>  $request->patient['patient_id'],
            'number_of_pregnancy' => $request->number_of_pregnancy,
            'number_of_previous_vaginal_deliveries' => $request->number_of_previous_vaginal_deliveries,
            'number_of_surviving_children' => $request->number_of_surviving_children,
            'number_of_caesarian_sections' => $request->number_of_caesarian_sections,
            'preterm_birth' => $request->preterm_birth,
            'congenital_anomaly' => $request->congenital_anomaly,
            'stillborn' => $request->stillborn,
            'neonatal_death' => $request->neonatal_death,
            'neonatal_death_days' => $request->neonatal_death_days,
            'lesser_weight' => $request->lesser_weight,
            'greater_weight' => $request->greater_weight,
            'staff_id' => $user->id,
            'staff_name' => $user->name,
            'facility_id' => $user->facility_id,
        ]);
        $pr = [
            'prenatal_id' => $prenatal->id,
            'patient_id' => $request->patient['patient_id'],
            'key' => $request->patient['key'],
            'staff_id' => $user->id,
            'staff_name' => $user->name,
            'facility_id' => $user->facility_id,
        ];


        if (empty($request->adolescent)) {
            $pr['adolescent'] = false;
        }
        if (empty($request->inadequate_finances)) {
            $pr['inadequate_finances'] = false;
        }
        if (empty($request->inadequate_housing)) {
            $pr['inadequate_housing'] = false;
        }
        if (empty($request->inadequate_social_supports)) {
            $pr['inadequate_social_supports'] = false;
        }
        if (empty($request->less_than_high_school_education)) {
            $pr['less_than_high_school_education'] = false;
        }
        if (empty($request->poor_nutrition)) {
            $pr['poor_nutrition'] = false;
        }
        if (empty($request->psychiatric_history)) {
            $pr['psychiatric_history'] = false;
        }
        if (empty($request->significant_learning_disabilities)) {
            $pr['significant_learning_disabilities'] = false;
        }
        if (empty($request->violence)) {
            $pr['violence'] = false;
        }
        PrenatalPsychologicalRisk::create($pr);

        $mr = [
            'prenatal_id' => $prenatal->id,
            'patient_id' => $request->patient['patient_id'],
            'key' => $request->patient['key'],
            'staff_id' => $user->id,
            'staff_name' => $user->name,
            'facility_id' => $user->facility_id,
        ];
        if (empty($request->cardiac_diseases)) {
            $mr['cardiac_diseases'] = false;
        }
        if (empty($request->diabetes)) {
            $mr['diabetes'] = false;
        }
        if (empty($request->endocrine_disorders)) {
            $mr['endocrine_disorders'] = false;
        }
        if (empty($request->hyperthyroid)) {
            $mr['hyperthyroid'] = false;
        }
        if (empty($request->hypothyroid)) {
            $mr['hypothyroid'] = false;
        }
        if (empty($request->gi_disorders)) {
            $mr['gi_disorders'] = false;
        }
        if (empty($request->malignancy)) {
            $mr['malignancy'] = false;
        }
        if (empty($request->moderate_asthma)) {
            $mr['moderate_asthma'] = false;
        }
        if (empty($request->renal_disease)) {
            $mr['renal_disease'] = false;
        }
        if (empty($request->seizure_disorders)) {
             $mr['seizure_disorders'] = false;
         }
        if (empty($request->sickle_cell_diseases)) {
            $mr['sickle_cell_diseases'] = false;
        }
        if (empty($request->kidney_disease)) {
            $mr['kidney_disease'] = false;
        }
        if (empty($request->epilepsy)) {
            $mr['epilepsy'] = false;
        }
        if (empty($request->disorder_of_nervous_system)) {
            $mr['disorder_of_nervous_system'] = false;
        }
        if (empty($request->psychiatric_illness)) {
            $mr['psychiatric_illness'] = false;
        }
        if (empty($request->high_blood_pressure)) {
            $mr['high_blood_pressure'] = false;
        }
        if (empty($request->lung_disease)) {
            $mr['lung_disease'] = false;
        }
        if (empty($request->blood_transfusion)) {
            $mr['blood_transfusion'] = false;
        }
        if (empty($request->hepatitis)) {
            $mr['hepatitis'] = false;
        }
        if (empty($request->blood_disorder)) {
            $mr['blood_disorder'] = false;
        }
        if (empty($request->assault)) {
            $mr['assault'] = false;
        }
        if (empty($request->hormone_problem)) {
            $mr['hormone_problem'] = false;
        }
        if (empty($request->bone_problem)) {
            $mr['bone_problem'] = false;
        }
        PrenatalMedicalRisk::create($mr);

        $or = [
            'prenatal_id' => $prenatal->id,
            'patient_id' => $request->patient['patient_id'],
            'key' => $request->patient['key'],
            'staff_id' => $user->id,
            'staff_name' => $user->name,
            'facility_id' => $user->facility_id,
        ];
        if (empty($request->abnormal_pap_smear)) {
            $or['abnormal_pap_smear'] = false;
        }

        if (empty($request->bmi)) {
            $or['bmi'] = false;
        }
        if (empty($request->gestational_diabetes)) {
            $or['gestational_diabetes'] = false;
        }
        if (empty($request->cervical_uterine_infections)) {
            $or['cervical_uterine_infections'] = false;
        }
        if (empty($request->neurological_defect)) {
            $or['neurological_defect'] = false;
        }
         if (empty($request->history_of_infertility)) {
             $or['history_of_infertility'] = false;
         }
         if (empty($request->inadequate_prenatal_care)) {
            $or['inadequate_prenatal_care'] = false;
        }
        if (empty($request->history_of_low_birth_weight)) {
            $or['history_of_low_birth_weight'] = false;
        }
        if (empty($request->incompetent_cervix)) {
            $or['incompetent_cervix'] = false;
        }
        if (empty($request->intrauterine_growth_retardation)) {
            $or['intrauterine_growth_retardation'] = false;
        }
        if (empty($request->placenta_previa)) {
            $or['placenta_previa'] = false;
        }
        if (empty($request->polyhydramnios)) {
            $or['polyhydramnios'] = false;
        }
        if (empty($request->poor_weight_gain)) {
            $or['poor_weight_gain'] = false;
        }
         if (empty($request->postpartum_depression_family)) {
             $or['postpartum_depression_family'] = false;
         }
         if (empty($request->postpartum_depression_personal)) {
            $or['postpartum_depression_personal'] = false;
        }
        if (empty($request->pregnancy_induced_hypertension)) {
            $or['pregnancy_induced_hypertension'] = false;
        }
        if (empty($request->pre_pregnant_weight)) {
            $or['pre_pregnant_weight'] = false;
        }
        if (empty($request->previous_pre_term_labour)) {
            $or['previous_pre_term_labour'] = false;
        }
        if (empty($request->previous_pre_term_delivery)) {
            $or['previous_pre_term_delivery'] = false;
        }
        if (empty($request->previous_stillborn)) {
            $or['previous_stillborn'] = false;
        }
        if (empty($request->multiple_gestation)) {
            $or['multiple_gestation'] = false;
        }
         if (empty($request->rh_sensitization)) {
             $or['rh_sensitization'] = false;
         }
         if (empty($request->sexually_transmitted_disease)) {
            $or['sexually_transmitted_disease'] = false;
        }
        if (empty($request->therapeutics_abortion)) {
            $or['therapeutics_abortion'] = false;
        }
        if (empty($request->uterine_anomally)) {
            $or['uterine_anomally'] = false;
        }
        PrenatalObstetricRisk::create($or);
        PrenatalBehaviouralRisk::create([
            'prenatal_id' => $prenatal->id,
            'patient_id' => $request->patient['patient_id'],
            'key' => $request->patient['key'],
            'smokes' => $request->smokes,
            'smoke_qty_per_day' => $request->smoke_qty_per_day,
            'ceased_smoking' => $request->ceased_smoking,
            'substance_use' => $request->substance_use,
            'spouse_smoke' => $request->spouse_smoke,
            'quit_information' => $request->quit_information,
            'alcohol' => $request->alcohol,
            'alcohol_qty_per_week' => $request->alcohol_qty_per_week,
            'current_rubella_immunisation' => $request->current_rubella_immunisation,
            'current_rubella_immunisation_level' => $request->current_rubella_immunisation_level,
            'staff_id' => $user->id,
            'staff_name' => $user->name,
            'facility_id' => $user->facility_id
        ]);



        PrenatalMedication::create([
            'prenatal_id' => $prenatal->id,
            'patient_id' => $request->patient['patient_id'],
            'key' => $request->patient['key'],
            'fever_specify' => $request->fever_specify,
            'nsaid' => $request->nsaid,
            'paracetamol' => $request->paracetamol,
            'anticonvulsants' => $request->anticonvulsants,
            'anticonvulsants_generic_name' => $request->anticonvulsanta_generic_name,
            'antinausea' => $request->antinausea,
            'antinausea_generic_name' => $request->antinausea_generic_name,
            'prenatal_vitamins' => $request->prenatal_vitamins,
            'prenatal_vitamins_generic_name' => $request->prenatal_vitamins_generic_name,
            'antivirals' => $request->antivirals,
            'antivirals_generic_name' => $request->antivirals_generic_name,
            'antibiotics' => $request->antibiotics,
            'antibiotics_generic_name' => $request->antibiotics_generic_name,
            'staff_id' => $user->id,
            'staff_name' => $user->name,
            'facility_id' => $user->facility_id
        ]);
        PrenatalFamilyHistory::create([
            'prenatal_id' => $prenatal->id,
            'patient_id' => $request->patient['patient_id'],
            'key' => $request->patient['key'],
            'twins' => $request->twins,
            'high_blood_pressure' => $request->high_blood_pressure,
            'aboriginal_status' => $request->aboriginal_status,
            'genetic_disorders' => $request->genetic_disorders,
            'diabetes' => $request->family_diabetes,
            'family_history_specify' => $request->family_history_specify,
            'medical_illness' => $request->medical_illness,
            'gynaecological_history' => $request->gynaecological_history,
            'previous_operation' => $request->previous_opertaion,
            'anaesthetic' => $request->anaesthetic,
            'medication' => $request->medication,
            'depression_during_pregnancy' => $request->depression_during_pregnancy,
            'edinburgh_score' => $request->edinburgh_score,
            'gestation_week' => $prenatal->gestational_period,
            'well_so_far_in_this_pregnancy' => $request->well_so_far_in_this_pregnancy,
            'staff_id' => $user->id,
            'staff_name' => $user->name,
            'facility_id' => $user->facility_id
        ]);
        PrenatalInvestigation::create([
            'prenatal_id' => $prenatal->id,
            'patient_id' => $request->patient['patient_id'],
            'key' => $request->patient['key'],
            'ultrasound' => $request->ultrasound,
            'ultrasound_week' => $request->ultrasound_week,
            'cvs' => $request->cvs,
            'maternal_serum_screening' => $request->maternal_serum_screening,
            'amniocentesis' => $request->amniocentesis,
            'other_procedures' => $request->other_procedures,
            'specify_other_procedures' => $request->specify_other_procedures,
            'antenatal_visit' => 0,
            'condition_developed' => $request->condition_developed,
            'vaginal_birth' => $request->vaginal_birth,
            'antenatal_classes' => $request->antenatal_classes,
            'rapid_progressive_dementia' => $request->rapid_progressive_dementia,
            'cjd' => $request->cjd,
            'human_pituitary' => $request->human_pituitary,
            'dura_mater_graft' => $request->dura_mater_graft,
            'cjd_look_back' => $request->cjd_look_back,
            'medical_in_confidence' => $request->medical_in_confidence,
            'staff_id' => $user->id,
            'staff_name' => $user->name,
            'facility_id' => $user->facility_id
        ]);
        Patient::where('id', $request->patient['patient_id'])->update([
            'prenatal' => true
        ]);

        $description = 'Antenatal Care';
        $service =  DB::table('medical_services')->where(['facility_id' => $user->facility_id, 'name' => $description])->first();
        PatientMedicalService::create([
            'patient_id' => $request->patient['patient_id'],
            'key' => $request->patient['key'],
            'medical_service_id' => $service->id,
            'fee' => $service->price,
            'staff_id' => $user->id,
            'staff_name' => $user->name,
            'facility_id' => $user->facility_id
        ]);
        PatientInvoice::create([
            'patient_id' => $request->patient['patient_id'],
            'key' => $request->patient['key'],
            'description' => $service->name,
            'quantity' => 1,
            'amount' => $service->price,
            'staff_id' => $user->id,
            'staff_name' => $user->name,
            'facility_id' => $user->facility_id
        ]);

    }
    public function index($id)
    {
        $user = User::where('id', $id)->first();
        $prenatals = DB::table('prenatals')
                        ->leftJoin('patients', 'patients.id', '=', 'prenatals.patient_id')
                        ->where(['prenatals.facility_id' => $user->facility_id, 'prenatals.active' => true])
                        ->select('patients.name', 'prenatals.*')
                        ->get();
        foreach ($prenatals as $prenatal) {
            $date = $prenatal->last_menstral_period;
            $add7Days = Carbon::parse($date)->addDays(7);
            $sub3Months = $add7Days->subMonths(3);
            $addYear = $sub3Months->addYear();
            $today = Carbon::now();
            $diffInDays = $today->diffInDays($date);
            $weeks = $today->diffInWeeks($date);
            $days = $diffInDays % 7;
            Prenatal::where('key', $prenatal->key)->update([
                'gestational_period' => $weeks . ' weeks ' . $days . ' days'
            ]);
        }
        return response()->json($prenatals);
    }
    public function fetchPrenatals()
    {
        $prenatals = DB::table('prenatals')
                        ->leftJoin('patients', 'patients.id', '=', 'prenatals.patient_id')
                        ->leftJoin('facility_signatures', 'facility_signatures.facility_id', '=', 'prenatals.facility_id')
                        ->where('prenatals.active', true)
                        ->select('patients.name', 'prenatals.*', 'facility_signatures.registered_facility_name')
                        ->get();
        foreach ($prenatals as $prenatal) {
            $date = $prenatal->last_menstral_period;
            $add7Days = Carbon::parse($date)->addDays(7);
            $sub3Months = $add7Days->subMonths(3);
            $addYear = $sub3Months->addYear();
            $today = Carbon::now();
            $diffInDays = $today->diffInDays($date);
            $weeks = $today->diffInWeeks($date);
            $days = $diffInDays % 7;
            Prenatal::where('key', $prenatal->key)->update([
                'gestational_period' => $weeks . ' weeks ' . $days . ' days'
            ]);
        }
        return response()->json($prenatals);
    }
    public function show($key)
    {
        $prenatal = DB::table('prenatals')
                        ->leftJoin('patients', 'patients.id', '=', 'prenatals.patient_id')
                        ->where('prenatals.key', $key)
                        ->select('prenatals.*', 'patients.name')
                        ->first();
        $date = $prenatal->last_menstral_period;
        $add7Days = Carbon::parse($date)->addDays(7);
        $sub3Months = $add7Days->subMonths(3);
        $addYear = $sub3Months->addYear();
        $today = Carbon::now();
        $diffInDays = $today->diffInDays($date);
        $weeks = $today->diffInWeeks($date);
        $days = $diffInDays % 7;
        Prenatal::where('key', $prenatal->key)->update([
            'gestational_period' => $weeks . ' weeks ' . $days . ' days'
        ]);
        $behavioural_risk = PrenatalBehaviouralRisk::where('key', $key)->first();
        $psychological_risk = PrenatalPsychologicalRisk::where('key', $key)->first();
        $medical_risk = PrenatalMedicalRisk::where('key', $key)->first();
        $obstetric_risk = PrenatalObstetricRisk::where('key', $key)->first();
        $medication = PrenatalMedication::where('key', $key)->first();
        $obstetric_history = PrenatalObstetricHistory::where('key', $key)->first();
        $family = PrenatalFamilyHistory::where('key', $key)->first();
        $investigation = PrenatalInvestigation::where('key', $key)->first();
        $spouse = SpouseInformation::where('token', $prenatal->spouse_token)->first();
        $lactation = LactationInterview::where('key', $key)->first();
        $first_visit = PrenatalFirstVisit::where('key', $key)->first();
        $prenatal_19_20_week = Prenatal19Or20Week::where('key', $key)->first();
        $prenatal_22_week = Prenatal22Week::where('key', $key)->first();
        $prenatal_26_27_week = Prenatal26Or27Week::where('key', $key)->first();
        $prenatal_28_week = Prenatal28Week::where('key', $key)->first();
        $prenatal_32_week = Prenatal32Week::where('key', $key)->first();
        $prenatal_34_36_week = Prenatal34Or36Week::where('key', $key)->first();
        $prenatal_38_39_week = Prenatal38Or39Week::where('key', $key)->first();
        $prenatal_40_41_week = Prenatal40Or41Week::where('key', $key)->first();
        if (count(PrenatalFirstVisit::where('key', $key)->get()) > 0) {
            $check_first_visit_week = true;
        }else{
            $check_first_visit_week = false;
        }
        if (count(Prenatal19Or20Week::where('key', $key)->get()) > 0) {
            $check_prenatal_19_20_week = true;
        }else{
            $check_prenatal_19_20_week = false;
        }
        if (count(Prenatal22Week::where('key', $key)->get()) > 0) {
            $check_prenatal_22_week = true;
        } else {
            $check_prenatal_22_week = false;
        }
        if (count(Prenatal26Or27Week::where('key', $key)->get()) > 0) {
            $check_prenatal_26_27_week = true;
        } else {
            $check_prenatal_26_27_week = false;
        }
        if (count(Prenatal28Week::where('key', $key)->get()) > 0) {
            $check_prenatal_28_week = true;
        } else {
            $check_prenatal_28_week = false;
        }
        if (count(Prenatal32Week::where('key', $key)->get()) > 0) {
            $check_prenatal_32_week = true;
        } else {
            $check_prenatal_32_week = false;
        }
        if (count(Prenatal34Or36Week::where('key', $key)->get()) > 0) {
            $check_prenatal_34_36_week = true;
        } else {
            $check_prenatal_34_36_week = false;
        }
        if (count(Prenatal38Or39Week::where('key', $key)->get()) > 0) {
            $check_prenatal_38_39_week = true;
        } else {
            $check_prenatal_38_39_week = false;
        }
        if (count(Prenatal40Or41Week::where('key', $key)->get()) > 0) {
            $check_prenatal_40_41_week = true;
        } else {
            $check_prenatal_40_41_week = false;
        }
        return response()->json(['prenatal' => $prenatal, 'spouse' => $spouse, 'behavioural_risk' => $behavioural_risk, 'psychological_risk' => $psychological_risk, 'medical_risk' => $medical_risk, 'medication' => $medication, 'obstetric_risk' => $obstetric_risk, 'obstetric_history' => $obstetric_history, 'family' => $family, 'investigation' => $investigation, 'lactation' => $lactation, 'first_visit' => $first_visit, 'prenatal_19_20_week' => $prenatal_19_20_week, 'prenatal_22_week' => $prenatal_22_week, 'prenatal_26_27_week' => $prenatal_26_27_week, 'prenatal_28_week' => $prenatal_28_week, 'prenatal_32_week' => $prenatal_32_week, 'prenatal_34_36_week' => $prenatal_34_36_week, 'prenatal_38_39_week' => $prenatal_38_39_week, 'prenatal_40_41_week' => $prenatal_40_41_week, 'check_first_visit_week' => $check_first_visit_week, 'check_prenatal_19_20_week' => $check_prenatal_19_20_week, 'check_prenatal_22_week' => $check_prenatal_22_week, 'check_prenatal_26_27_week' => $check_prenatal_26_27_week, 'check_prenatal_28_week' => $check_prenatal_28_week, 'check_prenatal_32_week' => $check_prenatal_32_week, 'check_prenatal_34_36_week' => $check_prenatal_34_36_week, 'check_prenantal_38_39_week' => $check_prenatal_38_39_week, 'check_prenatal_40_41_week' => $check_prenatal_40_41_week]);
    }

    public function updatePrenatal(Request $request, $key)
    {
        $this->validate($request, [

            'last_menstral_period' => 'required|date',
            'expected_due_date' => 'required|date',
            'gestational_period' => 'required|string',
            'date_of_first_prenatal_visit' => 'required|date',
            'expected_delivery_facility' => 'required|string',
            'day_of_prenatal_visit' => 'required|string',
            'pregnancy_type' => 'required|string',
            'number_of_pregnancy' => 'required|string',
            'number_of_previous_vaginal_deliveries' => 'required|string',
            'number_of_surviving_children' => 'required|string',
            'number_of_caesarian_sections' => 'required|string',

        ]);

        $data = [
            'last_menstral_period' => $request->last_menstral_period,
            'date_of_conception' => $request->date_of_conception,
            'gestational_period' => $request->gestational_period,
            'expected_due_date' => $request->expected_due_date,
            'date_of_first_prenatal_visit' => $request->date_of_first_prenatal_visit,
            'day_of_prenatal_visit' => $request->day_of_prenatal_visit,
            'type_of_last_delivery' => $request->type_of_last_delivery,
            'date_of_last_delivery' => $request->date_of_last_delivery,
            'expected_delivery_facility' => $request->expected_delivery_facility,
            'pregnancy_type' => $request->pregnancy_type,
            'pack_volume_cells' => $request->pack_volume_cells,
            'number_of_pregnancy' => $request->number_of_pregnancy,
            'number_of_previous_vaginal_deliveries' => $request->number_of_previous_vaginal_deliveries,
            'number_of_surviving_children' => $request->number_of_surviving_children,
            'number_of_caesarian_sections' => $request->number_of_caesarian_sections,
            'fetal_heart_rate' => $request->fetal_heart_rate,
            'pregnancy_scan' => $request->pregnancy_scan,
            'primp_scan' => $request->primp_scan

        ];

        Prenatal::where('key', $key)->update($data);
    }

    public function updatePrenatalBehaviouralRisk(Request $request, $key)
    {
        $this->validate($request, [
            'smokes' => 'required',
            'substance_use' => 'required',
            'spouse_smoke' => 'required',
            'alcohol' => 'required',
            'current_rubella_immunisation' => 'required',
        ]);
        PrenatalBehaviouralRisk::where('key', $key)->update([
            'smokes' => $request->smokes,
            'smoke_qty_per_day' => $request->smoke_qty_per_day,
            'ceased_smoking' => $request->ceased_smoking,
            'substance_use' => $request->substance_use,
            'spouse_smoke' => $request->spouse_smoke,
            'quit_information' => $request->quit_information,
            'alcohol' => $request->alcohol,
            'alcohol_qty_per_week' => $request->alcohol_qty_per_week,
            'current_rubella_immunisation' => $request->current_rubella_immunisation,
            'current_rubella_immunisation_level' => $request->current_rubella_immunisation_level,
        ]);
    }
    public function updatePrenatalPsychologicalRisk(Request $request, $key)
    {
        PrenatalPsychologicalRisk::where('key', $key)->update([
            'adolescent' => $request->adolescent,
            'inadequate_finances' => $request->inadequate_finances,
            'inadequate_housing' => $request->inadequate_housing,
            'inadequate_social_supports' => $request->inadequate_social_supports,
            'less_than_high_school_education' => $request->less_than_high_school_education,
            'poor_nutrition' => $request->poor_nutrition,
            'psychiatric_history' => $request->psychiatric_history,
            'significant_learning_disabilities' => $request->significant_learning_disabilities,
            'violence' => $request->violence
        ]);
    }
    public function updatePrenatalMedicalRisk(Request $request, $key)
    {
        PrenatalMedicalRisk::where('key', $key)->update([
            'cardiac_disease' => $request->cardiac_disease,
            'diabetes' => $request->diabetes,
            'endocrine_disorders' => $request->endocrine_disorders,
            'hyperthyroid' => $request->hyperthyroid,
            'hypothyroid' => $request->hypothyroid,
            'gi_disorders' => $request->gi_disorders,
            'malignancy' => $request->malignancy,
            'moderate_asthma' => $request->moderate_asthma,
            'renal_disease' => $request->renal_disease,
            'seizure_disorders' => $request->seizure_disorders,
            'sickle_cell_diseases' => $request->sickle_cell_diseases,
            'kidney_disease' => $request->kidney_disease,
            'epilepsy' => $request->epilepsy,
            'disorder_of_nervous_system' => $request->disorder_of_nervous_system,
            'psychiatric_illness' => $request->psychiatric_illness,
            'high_blood_pressure' => $request->high_blood_pressure,
            'lung_disease' => $request->lung_disease,
            'blood_transfusion' => $request->blood_transfusion,
            'hepatitis' => $request->hepatitis,
            'blood_disorder' => $request->blood_disorder,
            'assault' => $request->assault,
            'hormone_problem' => $request->hormone_problem
        ]);
    }
    public function updatePrenatalObstetricRisk(Request $request, $key)
    {
        PrenatalObstetricRisk::where('key', $key)->update([
            'abnormal_pap_smear' => $request->abnormal_pap_smear,
            'bmi' => $request->bmi,
            'gestational_diabetes' => $request->gestational_diabetes,
            'cervical_uterine_infections' => $request->cervical_uterine_infections,
            'neurological_defect' => $request->neurological_defect,
            'history_of_infertility' => $request->history_of_infertility,
            'inadequate_prenatal_care' => $request->inadequate_prenatal_care,
            'history_of_low_birth_weight' => $request->history_of_low_birth_weight,
            'incompetent_cervix' => $request->incompetent_cervix,
            'intrauterine_growth_retardation' => $request->intrauterine_growth_retardation,
            'placenta_previa' => $request->placenta_previa,
            'polyhydramnios' => $request->polyhydramnios,
            'poor_weight_gain' => $request->poor_weight_gain,
            'postpartum_depression_family' => $request->postpartum_depression_family,
            'postpartum_depression_personal' => $request->postpartum_depression_personal,
            'pregnancy_induced_hypertension' => $request->pregnancy_induced_hypertension,
            'pre_pregnant_weight' => $request->pre_pregnant_weight,
            'previous_pre_term_labour' => $request->previous_pre_term_labour,
            'previous_pre_term_delivery' => $request->previous_pre_term_delivery,
            'previous_stillborn' => $request->previous_stillborn,
            'multiple_gestation' => $request->multiple_gestation,
            'rh_sensitization' => $request->rh_sensitization,
            'sexually_transmitted_disease' => $request->sexually_transmitted_disease,
            'therapeutics_abortion' => $request->therapeutics_abortion,
            'uterine_anomally' => $request->uterine_anomally
        ]);
    }
    public function updatePrenatalObstetricHistory(Request $request, $key)
    {

        PrenatalObstetricHistory::where('key', $key)->update([
            'number_of_pregnancy' => $request->number_of_pregnancy,
            'number_of_previous_vaginal_deliveries' => $request->number_of_previous_vaginal_deliveries,
            'number_of_surviving_children' => $request->number_of_surviving_children,
            'number_of_caesarian_sections' => $request->number_of_caesarian_sections,
            'preterm_birth' => $request->preterm_birth,
            'congenital_anomaly' => $request->congenital_anomaly,
            'stillborn' => $request->stillborn,
            'neonatal_death' => $request->neonatal_death,
            'neonatal_death_days' => $request->neonatal_death_days,
            'lesser_weight' => $request->lesser_weight,
            'greater_weight' => $request->greater_weight
        ]);
    }
    public function updatePrenatalMedication(Request $request, $key)
    {
        PrenatalMedication::where('key', $key)->update([
            'fever_specify' => $request->fever_specify,
            'nsaid' => $request->nsaid,
            'paracetamol' => $request->paracetamol,
            'anticonvulsants' => $request->anticonvulsants,
            'anticonvulsants_generic_name' => $request->anticonvulsanta_generic_name,
            'antinausea' => $request->antinausea,
            'antinausea_generic_name' => $request->antinausea_generic_name,
            'prenatal_vitamins' => $request->prenatal_vitamins,
            'prenatal_vitamins_generic_name' => $request->prenatal_vitamins_generic_name,
            'antivirals' => $request->antivirals,
            'antivirals_generic_name' => $request->antivirals_generic_name,
            'antibiotics' => $request->antibiotics,
            'antibiotics_generic_name' => $request->antibiotics_generic_name
        ]);
    }
    public function updatePrenatalAdmissionSign(Request $request, $key)
    {
        PrenatalAdmissionSignSymptom::where('key', $key)->update([
            'vaginal_watery_discharge' => $request->vaginal_watery_discharge,
            'vaginal_bleeding' => $request->vaginal_bleeding,
            'headaches' => $request->headaches,
            'vision_changes' => $request->vision_changes,
            'abdominal_pain' => $request->abdominal_pain,
            'decreased' => $request->decreased,
            'uterine_contractions' => $request->uterine_contractions,
        ]);
    }
    public function updatePrenatalFamilyHistory(Request $request, $key)
    {
        PrenatalFamilyHistory::where('key', $key)->update([
            'twins' => $request->twins,
            'high_blood_pressure' => $request->high_blood_pressure,
            'aboriginal_status' => $request->aboriginal_status,
            'genetic_disorders' => $request->genetic_disorders,
            'diabetes' => $request->diabetes,
            'family_history_specify' => $request->family_history_specify,
            'medical_illness' => $request->medical_illness,
            'gynaecological_history' => $request->gynaecological_history,
            'previous_operation' => $request->previous_opertaion,
            'anaesthetic' => $request->anaesthetic,
            'medication' => $request->medication,
            'depression_during_pregnancy' => $request->depression_during_pregnancy,
            'edinburgh_score' => $request->edinburgh_score,
            'well_so_far_in_this_pregnancy' => $request->well_so_far_in_this_pregnancy
        ]);
    }
    public function updatePrenatalInvestigation(Request $request, $key)
    {
        PrenatalInvestigation::where('key', $key)->update([
            'ultrasound' => $request->ultrasound,
            'ultrasound_week' => $request->ultrasound_week,
            'cvs' => $request->cvs,
            'maternal_serum_screening' => $request->maternal_serum_screening,
            'amniocentesis' => $request->amniocentesis,
            'other_procedures' => $request->other_procedures,
            'specify_other_procedures' => $request->specify_other_procedures,
            'antenatal_visit' => 0,
            'condition_developed' => $request->condition_developed,
            'vaginal_birth' => $request->vaginal_birth,
            'antenatal_classes' => $request->antenatal_classes,
            'rapid_progressive_dementia' => $request->rapid_progressive_dementia,
            'cjd' => $request->cjd,
            'human_pituitary' => $request->human_pituitary,
            'dura_mater_graft' => $request->dura_mater_graft,
            'cjd_look_back' => $request->cjd_look_back,
            'medical_in_confidence' => $request->medical_in_confidence
        ]);
    }
    public function patientPrenatal($id)
    {
        $prenatals = Prenatal::where(['patient_id' => $id, 'active' => true])->get();
        $prenatal = Prenatal::where(['patient_id' => $id, 'active' => true])->first();
        $date = $prenatal->last_menstral_period;
        $add7Days = Carbon::parse($date)->addDays(7);
        $sub3Months = $add7Days->subMonths(3);
        $addYear = $sub3Months->addYear();
        $today = Carbon::now();
        $diffInDays = $today->diffInDays($date);
        $weeks = $today->diffInWeeks($date);
        $days = $diffInDays % 7;
        Prenatal::where('key', $prenatal->key)->update([
            'gestational_period' => $weeks . ' weeks ' . $days . ' days'
        ]);
        $key = $prenatal->key;
        $behavioural_risk = PrenatalBehaviouralRisk::where('key', $key)->first();
        $psychological_risk = PrenatalPsychologicalRisk::where('key', $key)->first();
        $medical_risk = PrenatalMedicalRisk::where('key', $key)->first();
        $obstetric_risk = PrenatalObstetricRisk::where('key', $key)->first();
        $medication = PrenatalMedication::where('key', $key)->first();

        $family = PrenatalFamilyHistory::where('key', $key)->first();
        $investigation = PrenatalInvestigation::where('key', $key)->first();
        $lactation = LactationInterview::where('key', $key)->first();
        $spouse = SpouseInformation::where('token', $prenatal->spouse_token)->first();
        $first_visit = PrenatalFirstVisit::where('key', $key)->first();
        $prenatal_19_20_week = Prenatal19Or20Week::where('key', $key)->first();
        $prenatal_22_week = Prenatal22Week::where('key', $key)->first();
        $prenatal_26_27_week = Prenatal26Or27Week::where('key', $key)->first();
        $prenatal_28_week = Prenatal28Week::where('key', $key)->first();
        $prenatal_32_week = Prenatal32Week::where('key', $key)->first();
        $prenatal_34_36_week = Prenatal34Or36Week::where('key', $key)->first();
        $prenatal_38_39_week = Prenatal38Or39Week::where('key', $key)->first();
        $prenatal_40_41_week = Prenatal40Or41Week::where('key', $key)->first();
        if (count(PrenatalFirstVisit::where('key', $key)->get()) > 0) {
            $check_first_visit_week = true;
        }else{
            $check_first_visit_week = false;
        }
        if (count(Prenatal19Or20Week::where('key', $key)->get()) > 0) {
            $check_prenatal_19_20_week = true;
        }else{
            $check_prenatal_19_20_week = false;
        }
        if (count(Prenatal22Week::where('key', $key)->get()) > 0) {
            $check_prenatal_22_week = true;
        } else {
            $check_prenatal_22_week = false;
        }
        if (count(Prenatal26Or27Week::where('key', $key)->get()) > 0) {
            $check_prenatal_26_27_week = true;
        } else {
            $check_prenatal_26_27_week = false;
        }
        if (count(Prenatal28Week::where('key', $key)->get()) > 0) {
            $check_prenatal_28_week = true;
        } else {
            $check_prenatal_28_week = false;
        }
        if (count(Prenatal32Week::where('key', $key)->get()) > 0) {
            $check_prenatal_32_week = true;
        } else {
            $check_prenatal_32_week = false;
        }
        if (count(Prenatal34Or36Week::where('key', $key)->get()) > 0) {
            $check_prenatal_34_36_week = true;
        } else {
            $check_prenatal_34_36_week = false;
        }
        if (count(Prenatal38Or39Week::where('key', $key)->get()) > 0) {
            $check_prenatal_38_39_week = true;
        } else {
            $check_prenatal_38_39_week = false;
        }
        if (count(Prenatal40Or41Week::where('key', $key)->get()) > 0) {
            $check_prenatal_40_41_week = true;
        } else {
            $check_prenatal_40_41_week = false;
        }
        return response()->json(['prenatal' => $prenatal, 'spouse' => $spouse, 'behavioural_risk' => $behavioural_risk, 'psychological_risk' => $psychological_risk, 'medical_risk' => $medical_risk, 'medication' => $medication, 'obstetric_risk' => $obstetric_risk,  'family' => $family, 'investigation' => $investigation, 'spouse' => $spouse, 'lactation' => $lactation,  'first_visit' => $first_visit, 'prenatal_19_20_week' => $prenatal_19_20_week, 'prenatal_22_week' => $prenatal_22_week, 'prenatal_26_27_week' => $prenatal_26_27_week, 'prenatal_28_week' => $prenatal_28_week, 'prenatal_32_week' => $prenatal_32_week, 'prenatal_34_36_week' => $prenatal_34_36_week, 'prenatal_38_39_week' => $prenatal_38_39_week, 'prenatal_40_41_week' => $prenatal_40_41_week, 'check_first_visit_week' => $check_first_visit_week, 'check_prenatal_19_20_week' => $check_prenatal_19_20_week, 'check_prenatal_22_week' => $check_prenatal_22_week, 'check_prenatal_26_27_week' => $check_prenatal_26_27_week, 'check_prenatal_28_week' => $check_prenatal_28_week, 'check_prenatal_32_week' => $check_prenatal_32_week, 'check_prenatal_34_36_week' => $check_prenatal_34_36_week, 'check_prenantal_38_39_week' => $check_prenatal_38_39_week, 'check_prenatal_40_41_week' => $check_prenatal_40_41_week, 'count' => count($prenatals)]);
    }
    public function storeLactationInterview(Request $request)
    {
        $this->validate($request, [
            'date_of_interview' =>  'required|date',
            'first_baby' => 'required|string',
            'breast_feeding' => 'required|string',
            'plan_to_feed_baby' => 'required|string',
            'partner_feel_about_decision' => 'required|string',
            'physical_anomalies' => 'required|string',
            'previous_breast_feed_experience' => 'required|string',
            'lactation_consultant' => 'required|string',
        ]);
        $prenatal = Prenatal::where('key', $request->key)->first();
        $user = User::where('id', $request->id)->first();
        LactationInterview::create([
            'patient_id' => $prenatal->patient_id,
            'prenatal_id' => $prenatal->id,
            'key' => $prenatal->key,
            'date_of_interview' => $request->date_of_interview,
            'baby_due_date' => $prenatal->expected_due_date,
            'first_baby' => $request->first_baby,
            'breast_feeding' => $request->breast_feeding,
            'plan_to_feed_baby' => $request->plan_to_feed_baby,
            'partner_feel_about_decision' => $request->partner_feel_about_decision,
            'physical_anomalies' => $request->physical_anomalies,
            'previous_breast_feed_experience' => $request->previous_breast_feed_experience,
            'lactation_consultant' => $request->lactation_consultant,
            'facility_id' => $user->facility_id
        ]);
    }
    public function updateLactationInterview(Request $request, $key)
    {
        $this->validate($request, [
            'date_of_interview' =>  'required|date',
            'first_baby' => 'required|string',
            'breast_feeding' => 'required|string',
            'plan_to_feed_baby' => 'required|string',
            'partner_feel_about_decision' => 'required|string',
            'physical_anomalies' => 'required|string',
            'previous_breast_feed_experience' => 'required|string',
            'lactation_consultant' => 'required|string',
        ]);

        LactationInterview::where('key', $key)->update([
            'date_of_interview' => $request->date_of_interview,
            'first_baby' => $request->first_baby,
            'breast_feeding' => $request->breast_feeding,
            'plan_to_feed_baby' => $request->plan_to_feed_baby,
            'partner_feel_about_decision' => $request->partner_feel_about_decision,
            'physical_anomalies' => $request->physical_anomalies,
            'previous_breast_feed_experience' => $request->previous_breast_feed_experience,
            'lactation_consultant' => $request->lactation_consultant
        ]);
    }
    public function storePrenatalAdmission(Request $request)
    {
        $this->validate($request, [
            'patient' => 'required',
            'last_menstral_period' => 'required|date',
            'expected_due_date' => 'required|date',
            'gestational_period' => 'required|string',
            'vaginal_watery_discharge' => 'required',
            'vaginal_bleeding' => 'required',
            'headaches' => 'required',
            'vision_changes' => 'required',
            'abdominal_pain' => 'required',
            'decreased' => 'required',
            'uterine_contractions' => 'required',
            'room_type' => 'required',
            'room_number' => 'required',
            'admitted_date' => 'required|date',
            'prenatal' => 'required',
            'postpartum' => 'required',
            'post_abortion' => 'required',
            'number_of_fetuses' => 'required',
            'fetal_heart_rate' => 'required'

        ]);
        $user = User::where('id', $request->id)->first();
        $data = [
            'patient_id' => $request->patient['patient_id'],
            'admitted_date' => $request->admitted_date,
            'room_type' => $request->room_type,
            'room_number' => $request->room_number,
            'last_menstral_period' => $request->last_menstral_period,
            'date_of_conception' => $request->date_of_conception,
            'expected_due_date' => $request->expected_due_date,
            'gestational_period' => $request->gestational_period,
            'prenatal' => $request->prenatal,
            'pregnant_not_in_labour' => $request->pregnant_not_in_labour,
            'pregnant_in_labour' => $request->pregnant_in_labour,
            'postpartum' => $request->postpartum,
            'postpartum_days' => $request->postpartum_days,
            'breastfeeding' => $request->breastfeeding,
            'post_abortion' => $request->post_abortion,
            'number_of_fetuses' => $request->number_of_fetuses,
            'fetal_heart_rate' => $request->fetal_heart_rate,
            'active' => true,
            'staff_id' => $user->id,
            'facility_id' => $user->facility_id,
            'staff_name' => $user->name
        ];

        if (isset($request->prenatal) && $request->prenatal == 1) {
            $prenatal = Prenatal::where('patient_id', $request->patient['patient_id'])->orderBy('id', 'desc')->first();
            $prenatal_id = $prenatal->id;
            $data['prenatal_id'] = $prenatal_id;
            $key = $prenatal->key;
            $data['key'] = $key;
            $data['antenatal_visits'] = $prenatal->count_visits;
        }else{
            $key = Str::random(100);
            $data['key'] = $key;
            $data['antenatal_visits'] = 0;
            $prenatal_id = NULL;
        }
        $random = Str::random(100);
        $patient = Patient::where('id', $request->patient['patient_id'])->first();
        if (isset($request->pregnancy_responsibility) && $request->pregnancy_responsibility == 1) {
            if (isset($request->add_husband) && $request->add_husband == true) {
                $spouse = SpouseInformation::create([
                    'name' => $request->spouse_name,
                    'email' => $request->spouse_email,
                    'phone_number' => $request->spouse_phone_number,
                    'gender' => $request->spouse_gender,
                    'wife_patient_id' => $request->patient['patient_id'],
                    'token' => $random
                ]);
                $mail = [
                    'name' => $request->spouse_name,
                    'email' => $request->spouse_email,
                    'token' => $random,
                    'patient' => $patient->name
                ];
                Mail::to($request->spouse_email)->send(new SpouseInformationMail($mail));
            }else{
                $spouse = DB::table('spouse_information')
                            ->where('wife_patient_id', $request->patient['patient_id'])
                            ->first();
            }
        }else{
            $spouse = SpouseInformation::create([
                'name' => $request->spouse_name,
                'email' => $request->spouse_email,
                'phone_number' => $request->spouse_phone_number,
                'gender' => $request->spouse_gender,
                'wife_patient_id' => $request->patient['patient_id'],
                'token' => $random
            ]);
            $mail = [
                'name' => $request->spouse_name,
                'email' => $request->spouse_email,
                'token' => $random,
                'patient' => $patient->name
            ];
            Mail::to($request->spouse_email)->send(new SpouseInformationMail($mail));
        }
        $data['spouse_token'] = $spouse->token;
        PrenatalAdmission::create($data);
        Patient::where('id', $request->patient['patient_id'])->update([
            'prenatal_admission' => true
        ]);
        $description = ['Prenatal Delivery Fee'];
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
                'patient_id' =>  $request->patient['patient_id'],
                'key' => $key,
                'medical_service_id' => $service->id,
                'fee' => $service->price,
                'staff_id' => $user->id,
                'staff_name' => $user->name,
                'facility_id' => $user->facility_id
            ]);
            PatientInvoice::create([
                'patient_id' => $request->patient['patient_id'],
                'key' => $key,
                'description' => $service->name,
                'quantity' => 1,
                'amount' => $service->price,
                'staff_id' => $user->id,
                'staff_name' => $user->name,
                'facility_id' => $user->facility_id
            ]);
        }

        PrenatalAdmissionSignSymptom::create([
            'prenatal_id' => $prenatal_id,
            'patient_id' => $request->patient['patient_id'],
            'key' => $key,
            'vaginal_watery_discharge' => $request->vaginal_watery_discharge,
            'vaginal_bleeding' => $request->vaginal_bleeding,
            'headaches' => $request->headaches,
            'vision_changes' => $request->vision_changes,
            'abdominal_pain' => $request->abdominal_pain,
            'decreased' => $request->decreased,
            'uterine_contractions' => $request->uterine_contractions,
            'staff_id' => $user->id,
            'staff_name' => $user->name,
            'facility_id' => $user->facility_id
        ]);
    }
    public function admittedPrenatals($id)
    {
        $user = User::where('id', $id)->first();
        $prenatals = DB::table('prenatal_admissions')
                        ->leftJoin('patients', 'patients.id', '=', 'prenatal_admissions.patient_id')
                        ->where('prenatal_admissions.facility_id', $user->facility_id)
                        ->orderBy('prenatal_admissions.id', 'desc')
                        ->select('prenatal_admissions.*', 'patients.name')
                        ->get();
        return response()->json($prenatals);
    }
    public function prenatalAdmission($key)
    {
        return response()->json(DB::table('prenatal_admissions')
                ->leftJoin('patients', 'patients.id', '=', 'prenatal_admissions.patient_id')
                ->where('prenatal_admissions.key', $key)
                ->select('prenatal_admissions.*', 'patients.name')
                ->first());
    }
    public function prenatalAdmissionSign($key)
    {
        return response()->json(PrenatalAdmissionSignSymptom::where('key', $key)->first());
    }
    public function updatePrenatalAdmission(Request $request, $key)
    {
        $this->validate($request, [
            'last_menstral_period' => 'required|date',
            'expected_due_date' => 'required|date',
            'gestational_period' => 'required|string',
            'room_type' => 'required',
            'room_number' => 'required',
            'admitted_date' => 'required|date',
            'postpartum' => 'required',
            'post_abortion' => 'required',
            'number_of_fetuses' => 'required'
        ]);
        PrenatalAdmission::where('key', $key)->update([
            'admitted_date' => $request->admitted_date,
            'room_type' => $request->room_type,
            'room_number' => $request->room_number,
            'last_menstral_period' => $request->last_menstral_period,
            'date_of_conception' => $request->date_of_conception,
            'expected_due_date' => $request->expected_due_date,
            'gestational_period' => $request->gestational_period,
            'pregnant_not_in_labour' => $request->pregnant_not_in_labour,
            'pregnant_in_labour' => $request->pregnant_in_labour,
            'postpartum' => $request->postpartum,
            'postpartum_days' => $request->postpartum_days,
            'breastfeeding' => $request->breastfeeding,
            'post_abortion' => $request->post_abortion,
            'number_of_fetuses' => $request->number_of_fetuses,
            'fetal_heart_rate' => $request->fetal_heart_rate
        ]);
    }
    public function admissionSpouseInformation($key)
    {
        $admission = PrenatalAdmission::where('key', $key)->first();
        return response()->json(SpouseInformation::where('token', $admission->spouse_token)->first());
    }
    public function patientPrenatalAdmission($patient_id)
    {
        $prenatal = DB::table('prenatal_admissions')
                        ->leftJoin('patients', 'patients.id', '=', 'prenatal_admissions.patient_id')
                        ->where(['prenatal_admissions.patient_id' => $patient_id, 'prenatal_admissions.active' => true])
                        ->first();
        $admission =  PrenatalAdmissionSignSymptom::where('key', $prenatal->key)->first();
        $spouse = SpouseInformation::where('token', $prenatal->spouse_token)->first();
        return response()->json(['prenatal' => $prenatal, 'admission' => $admission, 'spouse' => $spouse]);
    }
}
