<?php

namespace App\Http\Controllers;
use App\User;
use App\VitalSign;
use App\MedicalConsultation;
use App\DrugPrescriptionPlan;
use Illuminate\Http\Request;

class DrugPrescriptionPlanController extends Controller
{
    public function index($key)
    {
        return response()->json(DrugPrescriptionPlan::where('key', $key)->get());
    }
    public function store(Request $request)
    {
        $drug = $request->drug;
        $times = $request->times;
        $quantity = $request->quantity;
        $usages = $request->usages;
        $user = User::where('id', $request->id)->first();
        $consultation = MedicalConsultation::where('key', $request->key)->first();
        $prescriptions = DrugPrescriptionPlan::where('key', $request->key)->get();
        if (count($prescriptions) == 0) {
            for ($i = 0; $i < count($drug); $i++) {
                if (isset($drug[$i]) && isset($times[$i]) && isset($quantity[$i]) && isset($usages[$i])) {
                    DrugPrescriptionPlan::create([
                        'patient_id' => $consultation->patient_id,
                        'key' => $request->key,
                        'drug' => $drug[$i],
                        'usages' => $usages[$i],
                        'times' => $times[$i],
                        'quantity' => $quantity[$i],
                        'staff_id' => $user->id,
                        'staff_name' => $user->name,
                        'facility_id' => $user->facility_id
                    ]);
                }
            }
            VitalSign::where('key', $request->key)->update([
                'drug_prescription_plan' => true
            ]);
        } else {
            return response()->json(['error' => 'The drug prescription plan has already been created.'], 401);
        }
    }
    public function addToPlan(Request $request)
    {
        $drug = $request->drug;
        $times = $request->times;
        $quantity = $request->quantity;
        $usages = $request->usages;
        $user = User::where('id', $request->id)->first();
        $consultation = MedicalConsultation::where('key', $request->key)->first();
        for ($i = 0; $i < count($drug); $i++) {
            if (isset($drug[$i]) && isset($times[$i]) && isset($quantity[$i]) && isset($usages[$i])) {
                DrugPrescriptionPlan::create([
                    'patient_id' => $consultation->patient_id,
                    'key' => $request->key,
                    'drug' => $drug[$i],
                    'usages' => $usages[$i],
                    'times' => $times[$i],
                    'quantity' => $quantity[$i],
                    'staff_id' => $user->id,
                    'staff_name' => $user->name,
                    'facility_id' => $user->facility_id
                ]);
            }
        }
    }
    public function show($id)
    {
        return response()->json(DrugPrescriptionPlan::where('id', $id)->first());
    }
    public function update(Request $request, $id)
    {
        $user = User::where('id', $request->id)->first();
        DrugPrescriptionPlan::where('id', $id)->update([
            'drug' => $request->drug,
            'usages' => $request->usages,
            'times' => $request->times,
            'quantity' => $request->quantity,
            'staff_id' => $user->id,
            'staff_name' => $user->name,
        ]);
    }
    public function destroy($id)
    {
        DrugPrescriptionPlan::where('id', $id)->delete();
    }
}
