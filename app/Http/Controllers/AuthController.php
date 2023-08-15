<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\FacilitySignature;
use App\HospitalClass;
use App\MedicalService;
use App\User;
use App\Patient;
use App\Biodata;
use App\Education;
use App\ProfessionalQualification;
use App\ProfessionalExperience;
use App\UserVerify;
use App\PatientVerify;
use DB;
use Str;
use Mail;
use Image;
use App\Kin;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('JWT', ['except' => ['login', 'facilityRegistration']]);
    // }

    /**
     * Get a JWT token via given credentials.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validateData = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');
        $user = User::where('email', $request->email)->first();
        // if($user->active == true){
        //     return response()->json(['error' => 'You are logged in on another browser.'], 401);
        // }
        if ($token = $this->guard()->attempt($credentials)) {
            $login = User::where('email', $request->email)->first();
            if (!$login->is_email_verified) {
                return response()->json(['error' => 'You have to verify your account. A mail has been sent to your account'], 401);
            } else {

                if (!$user->dead) {
                    if($user->role == 'Medical Staff'){
                        if (!isset($user->facility_id)) {
                            return response()->json(['error' => 'Unemployed Staff! To login, you must be employed.'], 401);
                        }else{
                            if ($user->pin == $request->pin) {
                                if ($user->pin_usability == false) {
                                    User::where('email', $request->email)->update([
                                        'pin_usability' => true,
                                        'active' => true,
                                        'token' => $token
                                    ]);
                                    return $this->respondWithToken($token);
                                } else {
                                    return response()->json(['error' => 'The PIN you have provided has already been used by you.'], 401);
                                }
                            } else {
                                return response()->json(['error' => 'The PIN you have provided is invalid.'], 401);
                            }
                        }
                    }elseif($user->role == 'Non Medical Staff'){
                        if (!isset($user->facility_id)) {
                            return response()->json(['error' => 'Unemployed Staff! To login, you must be employed.'], 401);
                        }else{
                            if ($user->pin == $request->pin) {
                                if ($user->pin_usability == false) {
                                    User::where('email', $request->email)->update([
                                        'pin_usability' => true,
                                        'active' => true,
                                        'token' => $token
                                    ]);
                                    return $this->respondWithToken($token);
                                } else {
                                    return response()->json(['error' => 'The PIN you have provided has already been used by you.'], 401);
                                }
                            } else {
                                return response()->json(['error' => 'The PIN you have provided is invalid.'], 401);
                            }
                        }
                    }else{
                        User::where('email', $request->email)->update([
                            'token' => $token,
                            'active' => true
                        ]);
                        return $this->respondWithToken($token);
                    }
                } else {
                    return response()->json(['error' => 'Patient is dead, you can not login to his/her account.'], 401);
                }



            }
        }else{
            return response()->json(['error' => 'Email or Password Invalid'], 401);
        }

    }
    public function patientLogin(Request $request)
    {
        $validateData = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');
        $patient = Patient::where('email', $request->email)->first();
        if ($token = $this->guardPatient()->attempt($credentials)) {
            $login = Patient::where('email', $request->email)->first();
            if (!$login->is_email_verified) {
                return response()->json(['error' => 'You have to verify your account. A mail has been sent to your account'], 401);
            } else {
                if (!$patient->dead) {
                    Patient::where('email', $request->email)->update([
                        'token' => $token
                    ]);
                    return $this->respondWithPatientToken($token);
                } else {
                    return response()->json(['error' => 'Patient is dead, you can not login to his/her account.'], 401);
                }
            }
        }else{
            return response()->json(['error' => 'Email or Password Invalid'], 401);
        }


    }
    public function fetchUser($email)
    {
        $user = User::where('email', $email)->select('role', 'facility_id')->first();
        return response()->json($user);

    }
    public function patientRegistration(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email',
            'nin_number' => 'required|string|unique:users',
            'password' => 'required|string'
        ]);
        $patient = Patient::create([
            'name' => $request->name,
            'email' => $request->email,
            'nin_number' => $request->nin_number,
            'password' => bcrypt($request->password)
        ]);
        Biodata::create([
            'patient_id' => $patient->id
        ]);
        Kin::create([
            'patient_id' => $patient->id
        ]);
        $token = Str::random(100);
        PatientVerify::create([
            'patient_id' => $patient->id,
            'token' => $token
        ]);
        Mail::send('emails.patientVerificationEmail', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject('Email Verification Mail');
        });
    }
    public function facilityRegistration(Request $request)
    {
        // Validate
        $validateData = $request->validate([
            'registered_facility_name' => 'required|string|unique:facility_signatures',
            'email' => 'required|email|unique:users',
            'national_facility_id' => 'required|string|unique:facility_signatures',
            'state_facility_id' => 'required|string|unique:facility_signatures',
            'facility_type' => 'required|string',
            'name' => 'required|string',
            'nin_number' => 'required|string|max:11',
            'password' => 'required|string|min:6|confirmed',
            'agreement' => 'required',
            'logo' => 'required',
            'ownership_picture' => 'required'
        ]);

        // insert data into users using the User model
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'nin_number' => $request->nin_number,
            'role' => $request->role,
            'password' => Hash::make($request->password)
        ]);
        $token = Str::random(100);
        UserVerify::create([
            'user_id' => $user->id,
            'token' => $token
        ]);
        Mail::send('emails.emailVerificationEmail', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject('Email Verification Mail');
        });
        if ($request->role == 'Facility Manager') {
            $facility_id = $user->id;
            // update the user facility id
            User::where('email', $request->email)->update([
                'facility_id' => $facility_id
            ]);

            $data = [
                'facility_id' => $facility_id,
                'national_facility_id' => $request->national_facility_id,
                'state_facility_id' => $request->state_facility_id,
                'cac_registration_number' => $request->cac_registration_number,
                'slug' => Str::slug($request->registered_facility_name, '-'),
                'registered_facility_name' => $request->registered_facility_name,
                'facility_type' => $request->facility_type
            ];
            if ($request->logo) {
                $logo = $request->logo;
                $position = strpos($logo, ';');
                $sub = substr($logo, 0, $position);
                $ext = explode('/', $sub)[1];

                $image_name = time() . "." . $ext;
                $img = Image::make($logo)->resize(150,150);
                $upload_path = 'dist/images/logo/';
                $image_url = $upload_path . $image_name;
                $img->save($image_url);
                $data['logo'] = $image_url;
            }
            if ($request->ownership_picture) {
                $ownership = $request->ownership_picture;
                $position = strpos($ownership, ';');
                $sub = substr($ownership, 0, $position);
                $ext = explode('/', $sub)[1];

                $image_name = time() . "." . $ext;
                $img = Image::make($ownership)->resize(400,400);
                $upload_path = 'dist/images/avatar/';
                $image_url = $upload_path . $image_name;
                $img->save($image_url);
                $data['ownership_picture'] = $image_url;
            }
            // insert data into facility signature
            FacilitySignature::create($data);

            // insert to hospital class if facility type is a hospital
            if ($request->facility_type == 'Hospital') {
                HospitalClass::create([
                    'facility_id' => $facility_id
                ]);
                $services = ['Outpatient Charge', 'Admitted Medical Service', 'Shared Bed Charge', 'Private Bed Charge', 'Consultation Fee', 'Antenatal Care', 'Prenatal Delivery Fee', 'Cesarean Fee'];
                foreach ($services as $service) {
                    MedicalService::create([
                        'facility_id' => $facility_id,
                        'name' => $service
                    ]);
                }
            }
        }
    }
    public function staffRegistration(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'practice_type' => 'required|string',
            'job_type' => 'required|string',
            'employment_type' => 'required|string',
            'mdcn_number' => 'required|string',
            'nin_number' => 'required|string|unique:users',
            'gender' => 'required',
            'date_of_birth' => 'required|date',
            'marital_status' => 'required|string',
            'religion' => 'required|string',
            'address' => 'required|string',

            'mobile_phone' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'school_name' => 'required|string',
            'education_from' => 'required',
            'education_to' => 'required',
            'school_address' => 'required|string',
            'studied_course' => 'required|string',
            'graduated_with' => 'required|string',
            'qualification' => 'required|string',
            'year' => 'required',
            'licensing_body' => 'required|string',
            'facility_name' => 'required|string',
            'facility_address' => 'required|string',
            'facility_from' => 'required',
            'facility_to' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'nin_number' => $request->nin_number,
            'role' => 'Medical Staff',
            'practice_type' => $request->practice_type,
            'job_type' => $request->job_type,
            'mdcn_number' => $request->mdcn_number,
            'employment_type' => $request->employment_type
        ]);
        $token = Str::random(100);
        UserVerify::create([
            'user_id' => $user->id,
            'token' => $token
        ]);
        Mail::send('emails.emailVerificationEmail', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject('Email Verification Mail');
        });
        $data = [
            'user_id' => $user->id,
            'gender' => $request->gender,
            'date_of_birth' => $request->date_of_birth,
            'marital_status' => $request->marital_status,
            'religion' => $request->religion,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'url' => $request->url,
            'local_government_area' => $request->local_government_area,
            'gps_coordinate_longtitude' => $request->gps_coordinate_longtitude,
            'gps_coordinate_latitude' => $request->gps_coordinate_latitude,
            'postal_code' => $request->postal_code,
            'mobile_phone' => $request->mobile_phone
        ];
        if ($request->profile_picture) {
            $picture = $request->profile_picture;
            $position = strpos($picture, ';');
            $sub = substr($picture, 0, $position);
            $ext = explode('/', $sub)[1];

            $image_name = time() . "." . $ext;
            $img = Image::make($picture)->resize(400,400);
            $upload_path = 'dist/images/profile/';
            $image_url = $upload_path . $image_name;
            $img->save($image_url);
            $data['profile_picture'] = $image_url;
        }
        Biodata::create($data);
        Education::create([
            'user_id' => $user->id,
            'school_name' => $request->school_name,
            'from' => $request->education_from,
            'to' => $request->education_to,
            'school_address' => $request->school_address,
            'studied_course' => $request->studied_course,
            'graduated_with' => $request->graduated_with
        ]);
        ProfessionalQualification::create([
            'user_id' => $user->id,
            'qualification' => $request->qualification,
            'year' => $request->year,
            'licensing_body' => $request->licensing_body
        ]);
        ProfessionalExperience::create([
            'user_id' => $user->id,
            'facility_name' => $request->facility_name,
            'address' => $request->facility_address,
            'from' => $request->facility_from,
            'to' => $request->facility_to
        ]);
    }
    public function userLogout($id)
    {
        User::where('id', $id)->update([
            'active' => false
        ]);
    }
    /**
     * Get the authenticated User
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json($this->guard()->user());
    }

    /**
     * Log the user out (Invalidate the token)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $this->guard()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60,
        ]);
    }

    public function respondWithPatientToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guardPatient()->factory()->getTTL() * 60,
        ]);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return Auth::guard('api');
    }
    public function guardPatient()
    {
        return Auth::guard('api-patient');
    }
    public function verifyAccount($token)
    {
        $verifyUser = UserVerify::where('token', $token)->first();

        $message = 'Sorry your email cannot be identified.';

        if(!is_null($verifyUser) ){
            $user = $verifyUser->user;

            if(!$user->is_email_verified) {
                $verifyUser->user->is_email_verified = 1;
                $verifyUser->user->email_verified_at = date('Y-m-d H:i:s');
                $verifyUser->user->save();
                $message = "Your e-mail is verified. You can now login.";
            } else {
                $message = "Your e-mail is already verified. You can now login.";
            }
        }

      return redirect('/staff/sign-in')->with('message', $message);
    }
    public function verifyPatientAccount($token)
    {
        $verifyPatient = PatientVerify::where('token', $token)->first();

        $message = 'Sorry your email cannot be identified.';

        if(!is_null($verifyPatient) ){
            $patient = $verifyPatient->patient;

            if(!$patient->is_email_verified) {
                $verifyPatient->patient->is_email_verified = 1;
                $verifyPatient->patient->email_verified_at = date('Y-m-d H:i:s');
                $verifyPatient->patient->save();
                $message = "Your e-mail is verified. You can now login.";
            } else {
                $message = "Your e-mail is already verified. You can now login.";
            }
        }

      return redirect('/sign-in')->with('message', $message);
    }
    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email'
        ]);
        $user = User::where('email', $request->email)->first();
        if (isset($user)) {
            if (empty($user->token)) {
                User::where('email', $request->email)->update([
                    'token' => Str::random(100)
                ]);
            }
            Mail::send('emails.forgetPassword', ['user' => $user], function($message) use($user){
                $message->to($user->email);
                $message->subject('Forget Password Mail');
            });
        }else{
            return response()->json(['error' => 'You have no account on our platform'], 401);
        }
    }

    public function resetPassword($token)
    {
        $user = User::where('token', $token)->first();
        return view('reset_password', compact('user'));
    }
    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|string|min:6|confirmed'
        ]);
        User::where('token', $request->token)->update([
            'password' => Hash::make($request->password)
        ]);
        return redirect('/');
    }
}
