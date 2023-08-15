<?php

namespace App\Http\Controllers;
use App\User;
use App\MedicalConsultation;
use App\PatientDischargeInstruction;
use Illuminate\Http\Request;

class PatientDischargeInstructionController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'url' => 'required|string'
        ]);
        $user = User::where('id', $request->id)->first();
        PatientDischargeInstruction::create([
            'name' => $request->name,
            'url' => $request->url,
            'staff_id' => $user->id,
            'staff_name' => $user->name,
            'facility_id' => $user->facility_id
        ]);
    }
    public function index($id)
    {
        $user = User::where('id', $id)->first();
        return response()->json(PatientDischargeInstruction::where('facility_id', $user->facility_id)->get());
    }

    public function show($id)
    {
        return response()->json(PatientDischargeInstruction::where('id', $id)->first());
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'url' => 'required|string'
        ]);

        PatientDischargeInstruction::where('id', $id)->update([
            'name' => $request->name,
            'url' => $request->url
        ]);
    }
    public function destroy($id)
    {
        PatientDischargeInstruction::where('id', $id)->delete();
    }
}
