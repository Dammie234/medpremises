<?php

namespace App\Http\Controllers;

use App\User;
use App\VitalSign;
use App\MedicalConsultation;
use App\NurseDocumentation;
use Illuminate\Http\Request;

class NurseDocumentationController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'report' => 'required|string'
        ]);
        $user = User::where('id', $request->id)->first();
        $consultation = MedicalConsultation::where('key', $request->key)->first();
        NurseDocumentation::create([
            'title' => $request->title,
            'report' => $request->report,
            'key' => $request->key,
            'patient_id' => $consultation->patient_id,
            'staff_id' => $user->id,
            'staff_name' => $user->name,
            'facility_id' => $user->facility_id
        ]);
        VitalSign::where('key', $request->key)->update([
            'documentation' => true
        ]);
    }
    public function index($key)
    {
        return response()->json(NurseDocumentation::where('key', $key)->get());
    }
    public function show($id)
    {
        return response()->json(NurseDocumentation::where('id', $id)->first());
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'report' => 'required|string'
        ]);
        $user = User::where('id', $request->id)->first();
        NurseDocumentation::where('id', $id)->update([
            'title' => $request->title,
            'report' => $request->report,
            'staff_id' => $user->id,
            'staff_name' => $user->name
        ]);
    }
    public function destroy($id)
    {
        NurseDocumentation::where('id', $id)->delete();
    }
}
