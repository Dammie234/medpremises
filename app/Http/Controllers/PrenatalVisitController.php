<?php

namespace App\Http\Controllers;
use App\User;
use App\Prenatal;
use App\Prenatal19Or20Week;
use App\Prenatal26Or27Week;
use App\Prenatal22Week;
use App\Prenatal28Week;
use App\Prenatal32Week;
use App\Prenatal34Or36Week;
use App\Prenatal38Or39Week;
use App\Prenatal40Or41Week;
use App\PrenatalFirstVisit;
use App\PrenatalInvestigation;
use App\PrenatalMedicalLaboratoryTest;
use Illuminate\Http\Request;

class PrenatalVisitController extends Controller
{
    public function storePrenatalFirstVisit(Request $request)
    {
        $this->validate($request, [
            'blood_pressure' => 'required|string',
            'weight' => 'required|string',
            'height' => 'required|string',
            'screening_for_down_syndrome' => 'required|string',
            'cervical_screening' => 'required|string',
            'ungoing_medication' => 'required',
            'antenatal_risk' => 'required',
            'haemogloblin_result' => 'required|string',
            'smoking' => 'required',
            'alcohol' => 'required',
            'fetal_heart_rate' => 'required|string',
            'tocolysis' => 'required',
            'induction_of_labour' => 'required',
            'blood_transfusion' => 'required'
        ]);
        $prenatal = Prenatal::where('key', $request->key)->first();
        $user = User::where('id', $request->id)->first();
        PrenatalFirstVisit::create([
            'patient_id' => $prenatal->patient_id,
            'key' => $request->key,
            'pregnancy_duration' => $request->pregnancy_duration,
            'blood_pressure' => $request->blood_pressure,
            'height' => $request->height,
            'weight' => $request->weight,
            'screening_for_down_syndrome' => $request->screening_for_down_syndrome,
            'cervical_screening' => $request->cervical_screening,
            'ungoing_medication' => $request->ungoing_medication,
            'type_of_ungoing_medication' => $request->type_of_ungoing_medication,
            'smoking' => $request->smoking,
            'smoking_qty' => $request->smoking_qty,
            'alcohol' => $request->alcohol,
            'alcohol_qty' => $request->alcohol_qty,
            'gestational_age' => $request->gestational_age,
            'haemogloblin_result' => $request->haemogloblin_result,
            'antenatal_risk' => $request->antenatal_risk,
            'fetal_heart_rate' => $request->fetal_heart_rate,
            'tocolysis' =>   $request->tocolysis,
            'induction_of_labour' => $request->induction_of_labour,
            'blood_transfusion' => $request->blood_transfusion,
            'staff_id' => $user->id,
            'staff_name' => $user->name,
            'facility_id' => $user->facility_id
        ]);
        $tests = ['Blood Type Test', 'Rheumatoid Factor (RF)', 'Rubella Test', 'Hepatitis B Virus Test', 'Syphilis Tests', 'Chlamydia Test', 'HIV Test', 'Urine Test', 'Vitamin D Test', 'CBC (Complete Blood Count)'];
        foreach ($tests as $test) {
            PrenatalMedicalLaboratoryTest::create([
                'patient_id' =>   $prenatal->patient_id,
                'key' => $request->key,
                'week' => 'prenatal-first-visit',
                'test_name' => $test,
                'staff_id' => $user->id,
                'staff_name' => $user->name,
                'facility_id' => $user->facility_id
            ]);
        }
        $investigation = PrenatalInvestigation::where('key', $request->key)->first();
        PrenatalInvestigation::where('key', $request->key)->update([
            'antenatal_visit' => ($investigation->antenatal_visit + 1)
        ]);
    }
    public function updateFirstPrenatal(Request $request, $key)
    {
        $this->validate($request, [
            'blood_pressure' => 'required|string',
            'weight' => 'required|string',
            'height' => 'required|string',
            'screening_for_down_syndrome' => 'required|string',
            'cervical_screening' => 'required|string',
            'ungoing_medication' => 'required',
            'antenatal_risk' => 'required',
            'haemogloblin_result' => 'required|string',
            'smoking' => 'required',
            'alcohol' => 'required'
        ]);
        PrenatalFirstVisit::where('key', $key)->update([
            'pregnancy_duration' => $request->pregnancy_duration,
            'blood_pressure' => $request->blood_pressure,
            'height' => $request->height,
            'weight' => $request->weight,
            'screening_for_down_syndrome' => $request->screening_for_down_syndrome,
            'cervical_screening' => $request->cervical_screening,
            'ungoing_medication' => $request->ungoing_medication,
            'type_of_ungoing_medication' => $request->type_of_ungoing_medication,
            'smoking' => $request->smoking,
            'smoking_qty' => $request->smoking_qty,
            'alcohol' => $request->alcohol,
            'alcohol_qty' => $request->alcohol_qty,
            'gestational_age' => $request->gestational_age,
            'haemogloblin_result' => $request->haemogloblin_result,
            'antenatal_risk' => $request->antenatal_risk,
            'fetal_heart_rate' => $request->fetal_heart_rate,
            'tocolysis' =>   $request->tocolysis,
            'induction_of_labour' => $request->induction_of_labour,
            'blood_transfusion' => $request->blood_transfusion
        ]);


    }
    public function store19Or20Week(Request $request)
    {
        $this->validate($request, [
            'blood_pressure' => 'required|string',
            'tummy_measurement' => 'required|string',
            'type_of_ultrasound_scan' => 'required|string',
            'gestational_age' => 'required|string',
            'health_status' => 'required|string',
            'haemoglobin_result' => 'required|string',
            'antenatal_risk' => 'required|string',
            'fetal_heart_rate' => 'required|string',
            'tocolysis' => 'required',
            'induction_of_labour' => 'required',
            'blood_transfusion' => 'required'
        ]);
        $prenatal = Prenatal::where('key', $request->key)->first();
        $user = User::where('id', $request->id)->first();
        Prenatal19Or20Week::create([
            'key' => $prenatal->key,
            'patient_id' => $prenatal->patient_id,
            'blood_pressure' => $request->blood_pressure,
            'tummy_measurement' => $request->tummy_measurement,
            'health_status' => $request->health_status,
            'type_of_ultrasound_scan' => $request->type_of_ultrasound_scan,
            'scan_result' => $request->scan_result,
            'gestational_age' => $request->gestational_age,
            'haemoglobin_result' => $request->haemoglobin_result,
            'antenatal_risk' => $request->antenatal_risk,
            'fetal_heart_rate' => $request->fetal_heart_rate,
            'tocolysis' =>   $request->tocolysis,
            'induction_of_labour' => $request->induction_of_labour,
            'blood_transfusion' => $request->blood_transfusion,
            'staff_id' => $user->id,
            'staff_name' => $user->name,
            'facility_id' => $user->facility_id
        ]);
        Prenatal::where('key', $request->key)->update([
            'count_visits' => ($prenatal->count_visits + 1)
        ]);
        $investigation = PrenatalInvestigation::where('key', $request->key)->first();
        PrenatalInvestigation::where('key', $request->key)->update([
            'antenatal_visit' => ($investigation->antenatal_visit + 1)
        ]);
    }
    public function update19Or20Week(Request $request, $key)
    {
        $this->validate($request, [
            'blood_pressure' => 'required|string',
            'tummy_measurement' => 'required|string',
            'type_of_ultrasound_scan' => 'required|string',
            'gestational_age' => 'required|string',
            'health_status' => 'required|string',
            'haemoglobin_result' => 'required|string',
            'antenatal_risk' => 'required|string',
            'fetal_heart_rate' => 'required|string',
            'tocolysis' => 'required',
            'induction_of_labour' => 'required',
            'blood_transfusion' => 'required'
        ]);
        $prenatal = Prenatal::where('key', $request->key)->first();
        $user = User::where('id', $request->id)->first();
        Prenatal19Or20Week::where('key', $key)->update([
            'blood_pressure' => $request->blood_pressure,
            'tummy_measurement' => $request->tummy_measurement,
            'health_status' => $request->health_status,
            'type_of_ultrasound_scan' => $request->type_of_ultrasound_scan,
            'scan_result' => $request->scan_result,
            'gestational_age' => $request->gestational_age,
            'haemoglobin_result' => $request->haemoglobin_result,
            'antenatal_risk' => $request->antenatal_risk,
            'fetal_heart_rate' => $request->fetal_heart_rate,
            'tocolysis' =>   $request->tocolysis,
            'induction_of_labour' => $request->induction_of_labour,
            'blood_transfusion' => $request->blood_transfusion,
        ]);
    }
    public function store22Week(Request $request)
    {
        $this->validate($request, [
            'blood_pressure' => 'required|string',
            'tummy_measurement' => 'required|string',
            'gestational_age' => 'required|string',
            'health_status' => 'required|string',
            'haemoglobin_result' => 'required|string',
            'antenatal_risk' => 'required|string',
            'fetal_heart_rate' => 'required|string',
            'tocolysis' => 'required',
            'induction_of_labour' => 'required',
            'blood_transfusion' => 'required'
        ]);
        $prenatal = Prenatal::where('key', $request->key)->first();
        $user = User::where('id', $request->id)->first();
        Prenatal22Week::create([
            'key' => $prenatal->key,
            'patient_id' => $prenatal->patient_id,
            'blood_pressure' => $request->blood_pressure,
            'tummy_measurement' => $request->tummy_measurement,
            'health_status' => $request->health_status,
            'gestational_age' => $request->gestational_age,
            'haemoglobin_result' => $request->haemoglobin_result,
            'antenatal_risk' => $request->antenatal_risk,
            'fetal_heart_rate' => $request->fetal_heart_rate,
            'tocolysis' =>   $request->tocolysis,
            'induction_of_labour' => $request->induction_of_labour,
            'blood_transfusion' => $request->blood_transfusion,
            'staff_id' => $user->id,
            'staff_name' => $user->name,
            'facility_id' => $user->facility_id
        ]);
        Prenatal::where('key', $request->key)->update([
            'count_visits' => ($prenatal->count_visits + 1)
        ]);
        $investigation = PrenatalInvestigation::where('key', $request->key)->first();
        PrenatalInvestigation::where('key', $request->key)->update([
            'antenatal_visit' => ($investigation->antenatal_visit + 1)
        ]);
    }
    public function update22Week(Request $request, $key)
    {
        $this->validate($request, [
            'blood_pressure' => 'required|string',
            'tummy_measurement' => 'required|string',
            'gestational_age' => 'required|string',
            'health_status' => 'required|string',
            'haemoglobin_result' => 'required|string',
            'antenatal_risk' => 'required|string',
            'fetal_heart_rate' => 'required|string',
            'tocolysis' => 'required',
            'induction_of_labour' => 'required',
            'blood_transfusion' => 'required'
        ]);

        Prenatal22Week::where('key', $key)->update([
            'blood_pressure' => $request->blood_pressure,
            'tummy_measurement' => $request->tummy_measurement,
            'health_status' => $request->health_status,
            'gestational_age' => $request->gestational_age,
            'haemoglobin_result' => $request->haemoglobin_result,
            'antenatal_risk' => $request->antenatal_risk,
            'fetal_heart_rate' => $request->fetal_heart_rate,
            'tocolysis' =>   $request->tocolysis,
            'induction_of_labour' => $request->induction_of_labour,
            'blood_transfusion' => $request->blood_transfusion
        ]);

    }
    public function store26Or27Week(Request $request)
    {
        $this->validate($request, [
            'blood_pressure' => 'required|string',
            'tummy_measurement' => 'required|string',
            'gestational_age' => 'required|string',
            'health_status' => 'required|string',
            'haemoglobin_result' => 'required|string',
            'antenatal_risk' => 'required|string',
            'fetal_heart_rate' => 'required|string',
            'tocolysis' => 'required',
            'induction_of_labour' => 'required',
            'blood_transfusion' => 'required'
        ]);
        $prenatal = Prenatal::where('key', $request->key)->first();
        $user = User::where('id', $request->id)->first();
        Prenatal26Or27Week::create([
            'key' => $prenatal->key,
            'patient_id' => $prenatal->patient_id,
            'blood_pressure' => $request->blood_pressure,
            'tummy_measurement' => $request->tummy_measurement,
            'health_status' => $request->health_status,
            'gestational_age' => $request->gestational_age,
            'haemoglobin_result' => $request->haemoglobin_result,
            'antenatal_risk' => $request->antenatal_risk,
            'fetal_heart_rate' => $request->fetal_heart_rate,
            'tocolysis' =>   $request->tocolysis,
            'induction_of_labour' => $request->induction_of_labour,
            'blood_transfusion' => $request->blood_transfusion,
            'staff_id' => $user->id,
            'staff_name' => $user->name,
            'facility_id' => $user->facility_id
        ]);
        Prenatal::where('key', $request->key)->update([
            'count_visits' => ($prenatal->count_visits + 1)
        ]);
        $investigation = PrenatalInvestigation::where('key', $request->key)->first();
        PrenatalInvestigation::where('key', $request->key)->update([
            'antenatal_visit' => ($investigation->antenatal_visit + 1)
        ]);
    }
    public function update26Or27Week(Request $request, $key)
    {
        $this->validate($request, [
            'blood_pressure' => 'required|string',
            'tummy_measurement' => 'required|string',
            'gestational_age' => 'required|string',
            'health_status' => 'required|string',
            'haemoglobin_result' => 'required|string',
            'antenatal_risk' => 'required|string',
            'fetal_heart_rate' => 'required|string',
            'tocolysis' => 'required',
            'induction_of_labour' => 'required',
            'blood_transfusion' => 'required'
        ]);

        Prenatal26Or27Week::where('key', $key)->update([
            'blood_pressure' => $request->blood_pressure,
            'tummy_measurement' => $request->tummy_measurement,
            'health_status' => $request->health_status,
            'gestational_age' => $request->gestational_age,
            'haemoglobin_result' => $request->haemoglobin_result,
            'antenatal_risk' => $request->antenatal_risk,
            'fetal_heart_rate' => $request->fetal_heart_rate,
            'tocolysis' =>   $request->tocolysis,
            'induction_of_labour' => $request->induction_of_labour,
            'blood_transfusion' => $request->blood_transfusion
        ]);

    }
    public function store28Week(Request $request)
    {
        $this->validate($request, [
            'blood_pressure' => 'required|string',
            'baby_heartbeat' => 'required|string',
            'tummy_measurement' => 'required|string',
            'gestational_age' => 'required|string',
            'health_status' => 'required|string',
            'haemoglobin_result' => 'required|string',
            'antenatal_risk' => 'required|string',
            'fetal_heart_rate' => 'required|string',
            'tocolysis' => 'required',
            'induction_of_labour' => 'required',
            'blood_transfusion' => 'required'
        ]);
        $prenatal = Prenatal::where('key', $request->key)->first();
        $user = User::where('id', $request->id)->first();
        Prenatal28Week::create([
            'key' => $prenatal->key,
            'patient_id' => $prenatal->patient_id,
            'blood_pressure' => $request->blood_pressure,
            'tummy_measurement' => $request->tummy_measurement,
            'baby_heartbeat' => $request->baby_heartbeat,
            'health_status' => $request->health_status,
            'gestational_age' => $request->gestational_age,
            'haemoglobin_result' => $request->haemoglobin_result,
            'antenatal_risk' => $request->antenatal_risk,
            'fetal_heart_rate' => $request->fetal_heart_rate,
            'tocolysis' =>   $request->tocolysis,
            'induction_of_labour' => $request->induction_of_labour,
            'blood_transfusion' => $request->blood_transfusion,
            'staff_id' => $user->id,
            'staff_name' => $user->name,
            'facility_id' => $user->facility_id
        ]);
        Prenatal::where('key', $request->key)->update([
            'count_visits' => ($prenatal->count_visits + 1)
        ]);
        $tests = ['Hepatitis B Virus Test', 'Syphilis Tests', 'HIV Test'];
        foreach ($tests as $test) {
            PrenatalMedicalLaboratoryTest::create([
                'key' => $prenatal->key,
                'patient_id' => $prenatal->patient_id,
                'week' => 'prenatal-28-week',
                'test_name' => $test,
                'staff_id' => $user->id,
                'staff_name' => $user->name,
                'facility_id' => $user->facility_id
            ]);
        }
        $investigation = PrenatalInvestigation::where('key', $request->key)->first();
        PrenatalInvestigation::where('key', $request->key)->update([
            'antenatal_visit' => ($investigation->antenatal_visit + 1)
        ]);
    }
    public function update28Week(Request $request, $key)
    {
        $this->validate($request, [
            'blood_pressure' => 'required|string',
            'baby_heartbeat' => 'required|string',
            'tummy_measurement' => 'required|string',
            'gestational_age' => 'required|string',
            'health_status' => 'required|string',
            'haemoglobin_result' => 'required|string',
            'antenatal_risk' => 'required|string',
            'fetal_heart_rate' => 'required|string',
            'tocolysis' => 'required',
            'induction_of_labour' => 'required',
            'blood_transfusion' => 'required'
        ]);

        Prenatal28Week::where('key', $key)->update([
            'blood_pressure' => $request->blood_pressure,
            'tummy_measurement' => $request->tummy_measurement,
            'baby_heartbeat' => $request->baby_heartbeat,
            'health_status' => $request->health_status,
            'gestational_age' => $request->gestational_age,
            'haemoglobin_result' => $request->haemoglobin_result,
            'antenatal_risk' => $request->antenatal_risk,
            'fetal_heart_rate' => $request->fetal_heart_rate,
            'tocolysis' =>   $request->tocolysis,
            'induction_of_labour' => $request->induction_of_labour,
            'blood_transfusion' => $request->blood_transfusion
        ]);
    }
    public function store32Week(Request $request)
    {
        $this->validate($request, [
            'blood_pressure' => 'required|string',
            'baby_heartbeat' => 'required|string',
            'tummy_measurement' => 'required|string',
            'gestational_age' => 'required|string',
            'health_status' => 'required|string',
            'haemoglobin_result' => 'required|string',
            'antenatal_risk' => 'required|string',
            'fansidar_doses' => 'required|string',
            'fansidar_date' => 'required|string',
            'fetal_heart_rate' => 'required|string',
            'tocolysis' => 'required',
            'induction_of_labour' => 'required',
            'blood_transfusion' => 'required'
        ]);
        $prenatal = Prenatal::where('key', $request->key)->first();
        $user = User::where('id', $request->id)->first();
        Prenatal32Week::create([
            'key' => $prenatal->key,
            'patient_id' => $prenatal->patient_id,
            'blood_pressure' => $request->blood_pressure,
            'tummy_measurement' => $request->tummy_measurement,
            'baby_heartbeat' => $request->baby_heartbeat,
            'health_status' => $request->health_status,
            'gestational_age' => $request->gestational_age,
            'haemoglobin_result' => $request->haemoglobin_result,
            'antenatal_risk' => $request->antenatal_risk,
            'fansidar_doses' => $request->fansidar_doses,
            'fansidar_date' => $request->fansidar_date,
            'fetal_heart_rate' => $request->fetal_heart_rate,
            'tocolysis' =>   $request->tocolysis,
            'induction_of_labour' => $request->induction_of_labour,
            'blood_transfusion' => $request->blood_transfusion,
            'staff_id' => $user->id,
            'staff_name' => $user->name,
            'facility_id' => $user->facility_id
        ]);
        Prenatal::where('key', $request->key)->update([
            'count_visits' => ($prenatal->count_visits + 1)
        ]);
        $investigation = PrenatalInvestigation::where('key', $request->key)->first();
        PrenatalInvestigation::where('key', $request->key)->update([
            'antenatal_visit' => ($investigation->antenatal_visit + 1)
        ]);
        $tests = ['Urine Test'];
        foreach ($tests as $test) {
            PrenatalMedicalLaboratoryTest::create([
                'key' => $prenatal->key,
                'patient_id' => $prenatal->patient_id,
                'week' => 'prenatal-32-week',
                'test_name' => $test,
                'staff_id' => $user->id,
                'staff_name' => $user->name,
                'facility_id' => $user->facility_id
            ]);
        }
    }
    public function update32Week(Request $request, $key)
    {
        $this->validate($request, [
            'blood_pressure' => 'required|string',
            'baby_heartbeat' => 'required|string',
            'tummy_measurement' => 'required|string',
            'gestational_age' => 'required|string',
            'health_status' => 'required|string',
            'haemoglobin_result' => 'required|string',
            'antenatal_risk' => 'required|string',
            'fetal_heart_rate' => 'required|string',
            'tocolysis' => 'required',
            'induction_of_labour' => 'required',
            'blood_transfusion' => 'required'
        ]);

        Prenatal32Week::where('key', $key)->update([
            'blood_pressure' => $request->blood_pressure,
            'tummy_measurement' => $request->tummy_measurement,
            'baby_heartbeat' => $request->baby_heartbeat,
            'health_status' => $request->health_status,
            'gestational_age' => $request->gestational_age,
            'haemoglobin_result' => $request->haemoglobin_result,
            'antenatal_risk' => $request->antenatal_risk,
            'fansidar_doses' => $request->fansidar_doses,
            'fansidar_date' => $request->fansidar_date,
            'fetal_heart_rate' => $request->fetal_heart_rate,
            'tocolysis' =>   $request->tocolysis,
            'induction_of_labour' => $request->induction_of_labour,
            'blood_transfusion' => $request->blood_transfusion
        ]);
    }
    public function store34Or36Week(Request $request)
    {
        $this->validate($request, [
            'blood_pressure' => 'required|string',
            'baby_heartbeat' => 'required|string',
            'tummy_measurement' => 'required|string',
            'gestational_age' => 'required|string',
            'health_status' => 'required|string',
            'haemoglobin_result' => 'required|string',
            'antenatal_risk' => 'required|string',
            'tt_doses' => 'required|string',
            'tt_date' => 'required|string',
            'fetal_heart_rate' => 'required|string',
            'tocolysis' => 'required',
            'induction_of_labour' => 'required',
            'blood_transfusion' => 'required'
        ]);
        $prenatal = Prenatal::where('key', $request->key)->first();
        $user = User::where('id', $request->id)->first();
        Prenatal34Or36Week::create([
            'key' => $prenatal->key,
            'patient_id' => $prenatal->patient_id,
            'blood_pressure' => $request->blood_pressure,
            'tummy_measurement' => $request->tummy_measurement,
            'baby_heartbeat' => $request->baby_heartbeat,
            'health_status' => $request->health_status,
            'gestational_age' => $request->gestational_age,
            'haemoglobin_result' => $request->haemoglobin_result,
            'antenatal_risk' => $request->antenatal_risk,
            'tt_doses' => $request->fansidar_doses,
            'tt_date' => $request->fansidar_date,
            'fetal_heart_rate' => $request->fetal_heart_rate,
            'tocolysis' =>   $request->tocolysis,
            'induction_of_labour' => $request->induction_of_labour,
            'blood_transfusion' => $request->blood_transfusion,
            'staff_id' => $user->id,
            'staff_name' => $user->name,
            'facility_id' => $user->facility_id
        ]);
        Prenatal::where('key', $request->key)->update([
            'count_visits' => ($prenatal->count_visits + 1)
        ]);
        $investigation = PrenatalInvestigation::where('key', $request->key)->first();
        PrenatalInvestigation::where('key', $request->key)->update([
            'antenatal_visit' => ($investigation->antenatal_visit + 1)
        ]);
        $tests = ['Urine Test'];
        foreach ($tests as $test) {
            PrenatalMedicalLaboratoryTest::create([
                'key' => $prenatal->key,
                'patient_id' => $prenatal->patient_id,
                'week' => 'prenatal-34-36-week',
                'test_name' => $test,
                'staff_id' => $user->id,
                'staff_name' => $user->name,
                'facility_id' => $user->facility_id
            ]);
        }
    }
    public function update34Or36Week(Request $request, $key)
    {
        $this->validate($request, [
            'blood_pressure' => 'required|string',
            'baby_heartbeat' => 'required|string',
            'tummy_measurement' => 'required|string',
            'gestational_age' => 'required|string',
            'health_status' => 'required|string',
            'haemoglobin_result' => 'required|string',
            'antenatal_risk' => 'required|string',
            'tt_doses' => 'required|string',
            'tt_date' => 'required|date',
            'fetal_heart_rate' => 'required|string',
            'tocolysis' => 'required',
            'induction_of_labour' => 'required',
            'blood_transfusion' => 'required'
        ]);

        Prenatal34Or36Week::where('key', $key)->update([
            'blood_pressure' => $request->blood_pressure,
            'tummy_measurement' => $request->tummy_measurement,
            'baby_heartbeat' => $request->baby_heartbeat,
            'health_status' => $request->health_status,
            'gestational_age' => $request->gestational_age,
            'haemoglobin_result' => $request->haemoglobin_result,
            'antenatal_risk' => $request->antenatal_risk,
            'tt_doses' => $request->tt_doses,
            'tt_date' => $request->tt_date,
            'fetal_heart_rate' => $request->fetal_heart_rate,
            'tocolysis' =>   $request->tocolysis,
            'induction_of_labour' => $request->induction_of_labour,
            'blood_transfusion' => $request->blood_transfusion
        ]);
    }
    public function store38Or39Week(Request $request)
    {
        $this->validate($request, [
            'blood_pressure' => 'required|string',
            'baby_heartbeat' => 'required|string',
            'tummy_measurement' => 'required|string',
            'gestational_age' => 'required|string',
            'health_status' => 'required|string',
            'haemoglobin_result' => 'required|string',
            'antenatal_risk' => 'required|string',
            'fetal_heart_rate' => 'required|string',
            'tocolysis' => 'required',
            'induction_of_labour' => 'required',
            'blood_transfusion' => 'required'
        ]);
        $prenatal = Prenatal::where('key', $request->key)->first();
        $user = User::where('id', $request->id)->first();
        Prenatal38Or39Week::create([
            'key' => $prenatal->key,
            'patient_id' => $prenatal->patient_id,
            'blood_pressure' => $request->blood_pressure,
            'tummy_measurement' => $request->tummy_measurement,
            'baby_heartbeat' => $request->baby_heartbeat,
            'health_status' => $request->health_status,
            'gestational_age' => $request->gestational_age,
            'haemoglobin_result' => $request->haemoglobin_result,
            'antenatal_risk' => $request->antenatal_risk,
            'fetal_heart_rate' => $request->fetal_heart_rate,
            'tocolysis' =>   $request->tocolysis,
            'induction_of_labour' => $request->induction_of_labour,
            'blood_transfusion' => $request->blood_transfusion,
            'staff_id' => $user->id,
            'staff_name' => $user->name,
            'facility_id' => $user->facility_id
        ]);
        Prenatal::where('key', $request->key)->update([
            'count_visits' => ($prenatal->count_visits + 1)
        ]);
        $investigation = PrenatalInvestigation::where('key', $request->key)->first();
        PrenatalInvestigation::where('key', $request->key)->update([
            'antenatal_visit' => ($investigation->antenatal_visit + 1)
        ]);
        $tests = ['Urine Test'];
        foreach ($tests as $test) {
            PrenatalMedicalLaboratoryTest::create([
                'key' => $prenatal->key,
                'patient_id' => $prenatal->patient_id,
                'week' => 'prenatal-38-39-week',
                'test_name' => $test,
                'staff_id' => $user->id,
                'staff_name' => $user->name,
                'facility_id' => $user->facility_id
            ]);
        }
    }
    public function update38Or39Week(Request $request, $key)
    {
        $this->validate($request, [
            'blood_pressure' => 'required|string',
            'baby_heartbeat' => 'required|string',
            'tummy_measurement' => 'required|string',
            'gestational_age' => 'required|string',
            'health_status' => 'required|string',
            'haemoglobin_result' => 'required|string',
            'antenatal_risk' => 'required|string',
            'fetal_heart_rate' => 'required|string',
            'tocolysis' => 'required',
            'induction_of_labour' => 'required',
            'blood_transfusion' => 'required'
        ]);

        Prenatal38Or39Week::where('key', $key)->update([
            'blood_pressure' => $request->blood_pressure,
            'tummy_measurement' => $request->tummy_measurement,
            'baby_heartbeat' => $request->baby_heartbeat,
            'health_status' => $request->health_status,
            'gestational_age' => $request->gestational_age,
            'haemoglobin_result' => $request->haemoglobin_result,
            'antenatal_risk' => $request->antenatal_risk,
            'fetal_heart_rate' => $request->fetal_heart_rate,
            'tocolysis' =>   $request->tocolysis,
            'induction_of_labour' => $request->induction_of_labour,
            'blood_transfusion' => $request->blood_transfusion
        ]);

    }
    public function store40Or41Week(Request $request)
    {
        $this->validate($request, [
            'blood_pressure' => 'required|string',
            'baby_heartbeat' => 'required|string',
            'tummy_measurement' => 'required|string',
            'gestational_age' => 'required|string',
            'health_status' => 'required|string',
            'haemoglobin_result' => 'required|string',
            'antenatal_risk' => 'required|string',
            'fetal_heart_rate' => 'required|string',
            'tocolysis' => 'required',
            'induction_of_labour' => 'required',
            'blood_transfusion' => 'required'
        ]);
        $prenatal = Prenatal::where('key', $request->key)->first();
        $user = User::where('id', $request->id)->first();
        Prenatal40Or41Week::create([
            'key' => $prenatal->key,
            'patient_id' => $prenatal->patient_id,
            'blood_pressure' => $request->blood_pressure,
            'tummy_measurement' => $request->tummy_measurement,
            'baby_heartbeat' => $request->baby_heartbeat,
            'health_status' => $request->health_status,
            'gestational_age' => $request->gestational_age,
            'haemoglobin_result' => $request->haemoglobin_result,
            'antenatal_risk' => $request->antenatal_risk,
            'fetal_heart_rate' => $request->fetal_heart_rate,
            'tocolysis' =>   $request->tocolysis,
            'induction_of_labour' => $request->induction_of_labour,
            'blood_transfusion' => $request->blood_transfusion,
            'staff_id' => $user->id,
            'staff_name' => $user->name,
            'facility_id' => $user->facility_id
        ]);
        Prenatal::where('key', $request->key)->update([
            'count_visits' => ($prenatal->count_visits + 1)
        ]);
        $investigation = PrenatalInvestigation::where('key', $request->key)->first();
        PrenatalInvestigation::where('key', $request->key)->update([
            'antenatal_visit' => ($investigation->antenatal_visit + 1)
        ]);
        $tests = ['Urine Test'];
        foreach ($tests as $test) {
            PrenatalMedicalLaboratoryTest::create([
                'key' => $prenatal->key,
                'patient_id' => $prenatal->patient_id,
                'week' => 'prenatal-40-41-week',
                'test_name' => $test,
                'staff_id' => $user->id,
                'staff_name' => $user->name,
                'facility_id' => $user->facility_id
            ]);
        }
    }
    public function update40Or41Week(Request $request, $key)
    {
        $this->validate($request, [
            'blood_pressure' => 'required|string',
            'baby_heartbeat' => 'required|string',
            'tummy_measurement' => 'required|string',
            'gestational_age' => 'required|string',
            'health_status' => 'required|string',
            'haemoglobin_result' => 'required|string',
            'antenatal_risk' => 'required|string',
            'fetal_heart_rate' => 'required|string',
            'tocolysis' => 'required',
            'induction_of_labour' => 'required',
            'blood_transfusion' => 'required'
        ]);

        Prenatal40Or41Week::where('key', $key)->update([
            'blood_pressure' => $request->blood_pressure,
            'tummy_measurement' => $request->tummy_measurement,
            'baby_heartbeat' => $request->baby_heartbeat,
            'health_status' => $request->health_status,
            'gestational_age' => $request->gestational_age,
            'haemoglobin_result' => $request->haemoglobin_result,
            'antenatal_risk' => $request->antenatal_risk,
            'fetal_heart_rate' => $request->fetal_heart_rate,
            'tocolysis' =>   $request->tocolysis,
            'induction_of_labour' => $request->induction_of_labour,
            'blood_transfusion' => $request->blood_transfusion
        ]);

    }
}
