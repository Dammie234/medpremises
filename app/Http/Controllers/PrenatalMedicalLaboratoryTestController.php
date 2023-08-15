<?php

namespace App\Http\Controllers;
use DB;
use App\Patient;
use App\Prenatal;
use App\PrenatalMedicalLaboratoryTest;
use Illuminate\Http\Request;

class PrenatalMedicalLaboratoryTestController extends Controller
{
    public function fetchTests($key)
    {
        $prenatal = Prenatal::where('key', $key)->first();
        $patient = Patient::where('id', $prenatal->patient_id)->first();
        $lmp = date('Y-m-d', strtotime($prenatal->last_menstral_period));
        $today = date('Y-m-d');
        $to = \Carbon\Carbon::parse($today);
        $from = \Carbon\Carbon::parse($lmp);
        $weeks = $to->diffInWeeks($from);
        $results = [];
        if ($weeks < 10) {
            $tests = PrenatalMedicalLaboratoryTest::where(['key' => $key, 'week' => 'prenatal-first-visit', 'status' => false])->select('test_name', 'status')->get();
            $conducted_tests1 = PrenatalMedicalLaboratoryTest::where(['key' => $key, 'week' => 'prenatal-first-visit', 'status' => true])->get();
            
            $patient_tests = DB::table('patient_medical_laboratory_tests') 
                                ->where([ 'test_result' => null, 'key' => $key])
                                ->get();
            return response()->json(['weeks' => $weeks, 'tests' => $tests, 'prenatal' => $prenatal, 'patient' => $patient, 'count' => count($conducted_tests1),  'orders' => count($patient_tests)]);
        }elseif($weeks == 28){
            $tests = PrenatalMedicalLaboratoryTest::where(['key' => $key, 'week' => 'prenatal-28-week', 'status' => false])->select('test_name', 'status')->get();
            $conducted_tests2 = PrenatalMedicalLaboratoryTest::where(['key' => $key, 'week' => 'prenatal-28-week', 'status' => true])->select('test_name', 'status')->get();
            
            $patient_tests = DB::table('patient_medical_laboratory_tests') 
                                ->where([ 'test_result' => null, 'key' => $key])
                                ->get();
            return response()->json(['weeks' => $weeks, 'tests' => $tests, 'prenatal' => $prenatal, 'patient' => $patient, 'count' => count($conducted_tests2), 'orders' => count($patient_tests)]);
        }elseif ($weeks == 32) {
            $tests = PrenatalMedicalLaboratoryTest::where(['key' => $key, 'week' => 'prenatal-32-week', 'status' => false])->select('test_name', 'status')->get();
            $conducted_tests3 = PrenatalMedicalLaboratoryTest::where(['key' => $key, 'week' => 'prenatal-32-week', 'status' => true])->select('test_name', 'status')->get();
            
            
            $patient_tests = DB::table('patient_medical_laboratory_tests') 
                                ->where([ 'test_result' => null, 'key' => $key])
                                ->get();
            return response()->json(['weeks' => $weeks, 'tests' => $tests, 'prenatal' => $prenatal, 'patient' => $patient, 'count' => count($conducted_tests3), 'orders' => count($patient_tests)]);
        }elseif ($weeks >= 34 && $weeks <= 36) {
            $tests = PrenatalMedicalLaboratoryTest::where(['key' => $key, 'week' => 'prenatal-34-36-week', 'status' => false])->select('test_name', 'status')->get();
            $conducted_tests4 = PrenatalMedicalLaboratoryTest::where(['key' => $key, 'week' => 'prenatal-34-36-week', 'status' => true])->select('test_name', 'status')->get();
            
            $patient_tests = DB::table('patient_medical_laboratory_tests') 
                                ->where([ 'test_result' => null, 'key' => $key])
                                ->get();
            return response()->json(['weeks' => $weeks, 'tests' => $tests, 'prenatal' => $prenatal, 'patient' => $patient, 'count' => count($conducted_tests4), 'orders' => count($patient_tests)]);
        }elseif ($weeks == 38 || $weeks == 39){
            $tests = PrenatalMedicalLaboratoryTest::where(['key' => $key, 'week' => 'prenatal-38-39-week', 'status' => false])->select('test_name', 'status')->get();
            $conducted_tests5 = PrenatalMedicalLaboratoryTest::where(['key' => $key, 'week' => 'prenatal-38-39-week', 'status' => true])->select('test_name', 'status')->get();
            
            $patient_tests = DB::table('patient_medical_laboratory_tests') 
                                ->where([ 'test_result' => null, 'key' => $key])
                                ->get();
            return response()->json(['weeks' => $weeks, 'tests' => $tests, 'prenatal' => $prenatal, 'patient' => $patient, 'count' => count($conducted_tests5), 'orders' => count($patient_tests)]);
        }elseif ($weeks == 40 || $weeks == 41){
            $tests = PrenatalMedicalLaboratoryTest::where(['key' => $key, 'week' => 'prenatal-40-41-week', 'status' => false])->select('test_name', 'status')->get();
            $conducted_tests6 = PrenatalMedicalLaboratoryTest::where(['key' => $key, 'week' => 'prenatal-40-41-week', 'status' => true])->select('test_name', 'status')->get();
            
            $patient_tests = DB::table('patient_medical_laboratory_tests') 
                                ->where([ 'test_result' => null, 'key' => $key])
                                ->get();
            return response()->json(['weeks' => $weeks, 'tests' => $tests, 'prenatal' => $prenatal, 'patient' => $patient, 'count' => count($conducted_tests6), 'orders' => count($patient_tests)]);
        }else{
            $tests = [];
            $conducted_tests6 = PrenatalMedicalLaboratoryTest::where(['key' => $key, 'week' => 'prenatal-40-41-week', 'status' => true])->select('test_name', 'status')->get();
            $conducted_tests5 = PrenatalMedicalLaboratoryTest::where(['key' => $key, 'week' => 'prenatal-38-39-week', 'status' => true])->select('test_name', 'status')->get();
            $conducted_tests4 = PrenatalMedicalLaboratoryTest::where(['key' => $key, 'week' => 'prenatal-34-36-week', 'status' => true])->select('test_name', 'status')->get();
            $conducted_tests3 = PrenatalMedicalLaboratoryTest::where(['key' => $key, 'week' => 'prenatal-32-week', 'status' => true])->select('test_name', 'status')->get();
            $conducted_tests2 = PrenatalMedicalLaboratoryTest::where(['key' => $key, 'week' => 'prenatal-28-week', 'status' => true])->select('test_name', 'status')->get();
            $conducted_tests1 = PrenatalMedicalLaboratoryTest::where(['key' => $key, 'week' => 'prenatal-first-visit', 'status' => true])->get();
           
            return response()->json(['weeks' => $weeks, 'tests' => $tests, 'prenatal' => $prenatal, 'patient' => $patient, 'count' => 0, 'orders' => 0]);
        }
    }
    public function checkPrenatalMedicalLaboratoryTests($key)
    {
        $conducted_tests1 = PrenatalMedicalLaboratoryTest::where(['key' => $key, 'week' => 'prenatal-first-visit', 'status' => true])->get();
        $conducted_tests2 = PrenatalMedicalLaboratoryTest::where(['key' => $key, 'week' => 'prenatal-28-week', 'status' => true])->select('test_name', 'status')->get();
        $conducted_tests3 = PrenatalMedicalLaboratoryTest::where(['key' => $key, 'week' => 'prenatal-32-week', 'status' => true])->select('test_name', 'status')->get();
        $conducted_tests4 = PrenatalMedicalLaboratoryTest::where(['key' => $key, 'week' => 'prenatal-34-36-week', 'status' => true])->select('test_name', 'status')->get();
        $conducted_tests5 = PrenatalMedicalLaboratoryTest::where(['key' => $key, 'week' => 'prenatal-38-39-week', 'status' => true])->select('test_name', 'status')->get();
        $conducted_tests6 = PrenatalMedicalLaboratoryTest::where(['key' => $key, 'week' => 'prenatal-40-41-week', 'status' => true])->select('test_name', 'status')->get();
        
        return response()->json(['count_test1' => count($conducted_tests1), 'count_test2' => count($conducted_tests2), 'count_test3' => count($conducted_tests3), 'count_test4' => count($conducted_tests4), 'count_test5' => count($conducted_tests5), 'count_test6' => count($conducted_tests6)]);
    }
    public function prenatalMedicalTestResults($key, $week)
    {
        $prenatal = Prenatal::where('key', $key)->first();
        $patient = Patient::where('id', $prenatal->patient_id)->first();
        $tests = DB::table('prenatal_medical_laboratory_tests')
                    ->where(['prenatal_medical_laboratory_tests.week' => $week, 'prenatal_medical_laboratory_tests.key' => $key, 'prenatal_medical_laboratory_tests.status' => true])
                    ->leftJoin('facility_signatures', 'facility_signatures.facility_id', '=', 'prenatal_medical_laboratory_tests.facility_id')
                    ->select('prenatal_medical_laboratory_tests.*', 'facility_signatures.registered_facility_name')
                    ->get();
        return response()->json(['tests' => $tests, 'patient' => $patient]);
    }
}
