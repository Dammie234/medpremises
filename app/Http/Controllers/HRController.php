<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Str;
use Mail;
use App\User;
use App\UserVerify;
use App\Biodata;
use App\Education;
use App\Mail\NonMedicalStaffEmploymentMail;
use App\Mail\StaffLoginPinMail;
use Illuminate\Support\Facades\Hash;
class HRController extends Controller
{
    public function medicalStaffs($id)
    {
        $user = User::where('id', $id)->first();
        $medical_staffs = User::where(['role' => 'Medical Staff', 'facility_id' => $user->facility_id])->get();
        return response()->json($medical_staffs);
    }
    public function unemployedMedicalStaffs($name)
    {
        $medical_staffs = DB::table('users')->where([
                            ['role', '=', 'Medical Staff'],
                            ['facility_id', '=', null],
                            ['name', 'like', '%'.$name.'%']
                        ])->get();

        return response()->json($medical_staffs);
    }
    public function employMedicalStaff($user_id, $id)
    {
        # get facility id
        $user = User::where('id', $id)->first();
        $medical_staff = User::where('id', $user_id)->first();
        if ($medical_staff->employment_type == 'Full Staff') {
            User::where('id', $user_id)->update([
                'facility_id' => $user->id
            ]);
        }
    }
    public function employNonMedicalStaff(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email',
            'job_type' => 'required|string',
            'password' => 'required|string'
        ]);
        $facility = User::where('id', $request->id)->first();
        $signature = DB::table('facility_signatures')->where('facility_id', $facility->facility_id)->first();
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'Non Medical Staff',
            'job_type' => $request->job_type,
            'employment_type' => 'Full Staff',
            'facility_id' => $facility->facility_id
        ]);
        Education::create([
            'user_id' => $user->id
        ]);
        Biodata::create([
            'user_id' => $user->id
        ]);
        $mail = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'job_type' => $request->job_type,
            'facility' => $signature->registered_facility_name
        ];
        $id = Str::random(100);
        UserVerify::create([
            'user_id' => $user->id,
            'id' => $id
        ]);
        Mail::send('emails.emailVerificationEmail', ['id' => $id], function($message) use($request){
            $message->to($request->email);
            $message->subject('Email Verification Mail');
        });
        Mail::to($request->email)->send(new NonMedicalStaffEmploymentMail($mail));
    }
    public function nonMedicalStaffs($id)
    {
        $user = User::where('id', $id)->first();
        $staffs = User::where(['role' => 'Non Medical Staff', 'facility_id' => $user->facility_id])->get();
        return response()->json($staffs);
    }
    public function generatePIN($id)
    {
        $pin = rand(1000000, 9999999);
        User::where('id', $id)->update([
            'pin' => $pin,
            'active' => false,
            'pin_usability' => false
        ]);
        $user = User::where('id', $id)->first();
        $facility = DB::table('facility_signatures')->where('facility_id', $user->facility_id)->first();
        $data = [
            'name' => $user->name,
            'registered_facility_name' => $facility->registered_facility_name,
            'pin' => $pin
        ];
        Mail::to($user->email)->send(new StaffLoginPinMail($data));
    }
}
