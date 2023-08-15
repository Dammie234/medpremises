<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Patient;
use Image;
use DB;
use Str;
use Mail;
use App\Kin;
use App\Biodata;
use App\Education;
use App\MedicalService;
use App\FacilitySignature;
use App\HospitalClass;
use App\SpouseInformation;
use App\Mail\SpouseInformationMail;
use App\ProfessionalQualification;
use App\ProfessionalExperience;
use App\LaboratoryMedicalTest;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }


    public function jobs()
    {
        return response()->json(DB::table('jobs')->where('job_status', 'Medical Staff')->get());
    }
    public function nonMedicalJobs()
    {
        return response()->json(DB::table('jobs')->where('job_status', 'Non Medical Staff')->get());
    }
    public function user($id)
    {
        $users = User::where('id', $id)->get();
        $patients = Patient::where('id', $id)->get();
        if (count($patients) == 1) {
            $user = Patient::where('id', $id)->first();
            return response()->json($user);
        }elseif(count($users) == 1){
            $user = User::where('id', $id)->first();
            return response()->json($user);
        }else{
            return redirect()->route('/logout');
        }

    }
    public function facilityDetails($id)
    {
        $user = User::where('id', $id)->first();
        if (!empty($user)) {
            return response()->json(DB::table('facility_signatures')->where('facility_id', $user->facility_id)->first());
        }

    }
    public function hospitalClass($id)
    {
        $user = User::where('id', $id)->first();
        if (!empty($user)) {
            return response()->json(DB::table('hospital_classes')->where('facility_id', $user->facility_id)->first());
        }
    }
    public function updateFacililtyManager(Request $request, $id)
    {

        User::where('id', $id)->update([
            'mdcn_number' => $request->mdcn_number,
            'pcn_number' => $request->pcn_number
        ]);
    }
    public function updateOwnershipPicture(Request $request, $id)
    {
        $this->validate($request, [
            'ownership_picture' => 'required'
        ]);
        $user = User::where('id', $id)->first();
        $facility = FacilitySignature::where('facility_id', $user->facility_id)->first();
        if ($request->ownership_picture) {
            $ownership = $request->ownership_picture;
            $position = strpos($ownership, ';');
            $sub = substr($ownership, 0, $position);
            $ext = explode('/', $sub)[1];

            $image_name = time() . "." . $ext;
            $img = Image::make($ownership)->resize(400,400);
            $upload_path = 'dist/images/avatar/';
            $image_url = $upload_path . $image_name;
            $success = $img->save($image_url);

            if ($success) {
                $data['ownership_picture'] = $image_url;
                unlink($facility->ownership_picture);
            }
        }
        FacilitySignature::where('id', $user->id)->update($data);
    }
    public function updateProfilePicture(Request $request, $id)
    {
        $this->validate($request, [
            'profile_picture' => 'required'
        ]);
        $data = [];
        $user = User::where('id', $id)->first();
        if (empty($user)) {
            $patient = Patient::where('id', $id)->first();
            $biodata = Biodata::where('patient_id', $patient->id)->first();
        }else{
            $biodata = Biodata::where('user_id', $user->id)->first();
        }

        if ($request->profile_picture) {
            $ownership = $request->profile_picture;
            $position = strpos($ownership, ';');
            $sub = substr($ownership, 0, $position);
            $ext = explode('/', $sub)[1];

            $image_name = time() . "." . $ext;
            $img = Image::make($ownership)->resize(400,400);
            $upload_path = 'dist/images/avatar/';
            $image_url = $upload_path . $image_name;
            $success = $img->save($image_url);

            if ($success) {
                $data['profile_picture'] = $image_url;
                if (isset($biodata->profile_picture)) {
                    unlink($biodata->profile_picture);
                }
            }
            if (empty($user)) {
                Biodata::where('patient_id', $patient->id)->update($data);
            }else{
                Biodata::where('user_id', $user->id)->update($data);
            }

        }

    }
    public function states()
    {
        return response()->json(DB::table('states')->get());
    }
    public function updateFacilitySignature(Request $request, $id)
    {
        $this->validate($request, [
            'state' => 'required|string',
            'date_of_commencement_of_operation' => 'required|date',
            'local_government_area' => 'required|string',
            'physical_location' => 'required|string',
            'postal_code' => 'required|integer',
            'phone_number' => 'required',
            'hours_of_operation' => 'required',
            'operational_status' => 'required|string',
            'license_status' => 'required|required',
            'facility_uniqueness' => 'required|string',
            'ownership_type' => 'required'
        ]);


        $days = '';
        foreach($request->days as $a){
            foreach($a as $b => $c){
                $days .= $c . ', ';
            }
        }
        $day = substr($days,0,-1);
        $hour = '';
        if ($request->specify_period) {
            $hour = $request->specify_period;
        } else {
            $hour = $request->hours_of_operation;
        }

        $data = [
            'slug' => Str::slug($request->registered_facility_name, '-'),
            'date_of_commencement_of_operation' => $request->date_of_commencement_of_operation,
            'state' => $request->state,
            'local_government_area' => $request->local_government_area,
            'ward' => $request->ward,
            'lga_serial_number' => $request->lga_serial_number,
            'physical_location' => $request->physical_location,
            'city' => $request->city,
            'url' => $request->url,
            'country' => $request->country,
            'gps_coordinate_longtitude' => $request->gps_coordinate_longtitude,
            'gps_coordinate_latitude' => $request->gps_coordinate_latitude,
            'postal_code' => $request->postal_code,
            'phone_number' => $request->phone_number,
            'website' => $request->website,
            'days_of_operation' => $day,
            'hours_of_operation' => $hour,
            'hospital_level' => $request->hospital_level,
            'hours_of_operation' => $hour,
            'primary_level_type' => $request->primary_level_type,
            'tertiary_level_type' => $request->tertiary_level_type,
            'specialized_hospital_type' => $request->specialized_hospital_type,
            'ownership_type' => $request->ownership_type,
            'public_type' => $request->public_type,
            'private_type' => $request->private_type,
            'facility_uniqueness' => $request->facility_uniqueness,
            'operational_status' => $request->operational_status,
            'license_status' => $request->license_status,
            'status' => true
        ];
        $user = User::where('id', $id)->first();
        FacilitySignature::where('facility_id', $user->facility_id)->update($data);
    }
    public function medicalStaff($user_id)
    {
        $medical_staff = DB::table('users')
                            ->leftJoin('biodatas', 'biodatas.user_id', '=', 'users.id')
                            ->where('users.id', $user_id)
                            ->select('users.*', 'biodatas.*', 'biodatas.id as bid')
                            ->first();
        $educations = DB::table('education')->where('user_id', $user_id)->get();
        $qualifications = DB::table('professional_qualifications')->where('user_id', $user_id)->get();
        $experiences = DB::table('professional_experiences')->where('user_id', $user_id)->get();
        return response()->json(['biodata' => $medical_staff, 'educations' => $educations, 'qualifications' => $qualifications, 'experiences' => $experiences]);
    }
    public function medicalStaffFacility($id)
    {
        $user = User::where('id', $id)->first();
        $facility = DB::table('facility_signatures')->where('facility_id', $user->facility_id)->first();
        return response()->json($facility);
    }
    public function getNextOfKin($id)
    {
        $patient = Patient::where('id', $id)->first();
        $kin = Kin::where('patient_id', $patient->id)->first();
        return response()->json($kin);
    }
    public function staff($id)
    {
        $user = DB::table('users')->where('id', $id)->first();
        if ($user->role == 'Non Medical Staff') {
            $staff = DB::table('users')
                        ->leftJoin('biodatas', 'biodatas.user_id', '=', 'users.id')
                        ->select('users.*', 'biodatas.*', 'biodatas.id as bid')
                        ->where('users.id', $user->id)
                        ->first();
            $educations = DB::table('education')->where('user_id', $user->id)->get();
            return response()->json(['biodata' => $staff, 'educations' => $educations]);
        }else{
            $staff = DB::table('users')
                        ->leftJoin('biodatas', 'biodatas.user_id', '=', 'users.id')
                        ->select('users.*', 'biodatas.*', 'biodatas.id as bid')
                        ->where('users.id', $user->id)
                        ->first();
            $educations = DB::table('education')->where('user_id', $user->id)->get();
            $qualifications = DB::table('professional_qualifications')->where('user_id', $user->id)->get();
            $experiences = DB::table('professional_experiences')->where('user_id', $user->id)->get();
            return response()->json(['biodata' => $staff, 'educations' => $educations, 'qualifications' => $qualifications, 'experiences' => $experiences]);
        }

    }
    public function biodata($id)
    {
        $patient = Patient::where('id', $id)->first();
        $biodata = DB::table('patients')
                        ->leftJoin('biodatas', 'biodatas.patient_id', '=', 'patients.id')
                        ->select('patients.*', 'biodatas.*', 'biodatas.id as bid')
                        ->where('patients.id', $patient->id)
                        ->first();
        return response()->json(['biodata' => $biodata]);
    }
    public function updateBiodata(Request $request, $id)
    {
        $this->validate($request, [
            'gender' => 'required',
            'date_of_birth' => 'required|date',
            'marital_status' =>  'required|string',
            'religion' => 'required|string',
            'mobile_phone' => 'required',
            'birth_place' => 'required|string',
            'father_name' => 'required|string',
            'mother_name' => 'required|string'
        ]);
        $user = User::where('id', $id)->first();
        if (empty($user)) {
            $patient = Patient::where('id', $id)->first();
        }
        $today = date('Y-m-d');
        $to = \Carbon\Carbon::parse($today);
        $from = \Carbon\Carbon::parse($request->date_of_birth);
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
        $data = [
            'gender' => $request->gender,
            'date_of_birth' => $request->date_of_birth,
            'age' => $age,
            'age_class' => $age_class,
            'birth_place' => $request->birth_place,
            'father_name' => $request->father_name,
            'mother_name' => $request->mother_name,
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
            'mobile_phone' => $request->mobile_phone,
            'work_phone' => $request->work_phone,
            'home_phone' => $request->home_phone,
            'skype_id' => $request->skype_id
        ];
        if (empty($user)) {
            Biodata::where('patient_id', $patient->id)->update($data);
        } else {
            Biodata::where('user_id', $user->id)->update($data);
        }


    }
    public function updateKin(Request $request, $id)
    {
        $this->validate($request, [
            'gender' => 'required',
            'relation' => 'required',
            'name' =>  'required|string',
            'mobile_phone' => 'required',
            'email' => 'required|email'
        ]);
        $patient = Patient::where('id', $id)->first();
        Kin::where('patient_id', $patient->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'relation' => $request->relation,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'postal_code' => $request->postal_code,
            'mobile_phone' => $request->mobile_phone,
            'work_phone' => $request->work_phone,
            'home_phone' => $request->home_phone,
        ]);
    }
    public function updateSpouse(Request $request, $id)
    {
        $patient = Patient::where('id', $id)->first();
        $bio = Biodata::where('patient_id', $patient->id)->first();
        $random = Str::random(100);
        if (isset($request->patient)) {
            $pat = Patient::where('id', $request->patient['id'])->first();
            $data = [
                'name' => $pat->name,
                'email' => $pat->email,
                'phone_number' => $bio->mobile_phone,
                'id' => $random
            ];
            if ($bio->gender == 'Male') {
                $data['gender'] = 'Female';
                $data['husband_patient_id'] = $patient->id;
                $data['wife_patient_id'] = $request->patient['id'];
            }else{
                $data['gender'] = 'Male';
                $data['wife_patient_id'] = $patient->id;
                $data['husband_patient_id'] = $request->patient['id'];
            }
            $mail = [
                'name' => $pat->name,
                'email' => $pat->email,
                'id' => $random,
                'patient' => $patient->name
            ];

            SpouseInformation::create($data);
            Mail::to($pat->email)->send(new SpouseInformationMail($mail));
        }else{
            $data = [
                'name' => $request->spouse_name,
                'email' => $request->spouse_email,
                'phone_number' => $request->spouse_phone_number,
                'id' => $random
            ];
            if($bio->gender == 'Male'){
                $data['gender'] = 'Female';
                $data['husband_patient_id'] = $patient->id;
            }else{
                $data['gender'] = 'Male';
                $data['wife_patient_id'] = $patient->id;
            }
            SpouseInformation::create($data);
            $mail = [
                'name' => $request->spouse_name,
                'email' => $request->spouse_email,
                'id' => $random,
                'patient' => $patient->name
            ];
            Mail::to($request->spouse_email)->send(new SpouseInformationMail($mail));
        }
    }
    public function confirmSpouseRelationship($id)
    {
        SpouseInformation::where('id', $id)->update([
            'acceptance' => true
        ]);
        return redirect()->route('/');
    }
    public function spouseInformation($patient_id)
    {
        $husband = DB::table('spouse_information')
                    ->where([
                        ['husband_patient_id', '=', $patient_id],
                        ['acceptance', '=', false]
                    ])
                    ->orWhere([
                        ['husband_patient_id', '=', $patient_id],
                        ['acceptance', '=', true]
                    ])->first();
        $wife = DB::table('spouse_information')
                    ->where([
                        ['wife_patient_id', '=', $patient_id],
                        ['acceptance', '=', false]
                    ])
                    ->orWhere([
                        ['wife_patient_id', '=', $patient_id],
                        ['acceptance', '=', true]
                    ])
                    ->first();
        if (empty($husband)) {
            $spouse = $wife;
        }else{
            $spouse = $husband;
        }
        return response()->json($spouse);
    }
   public function updateEducation(Request $request, $id)
   {
       Education::where('id', $id)->update([
            'school_name' => $request->school_name,
            'from' => $request->from,
            'to' => $request->to,
            'school_address' => $request->school_address,
            'studied_course' => $request->studied_course,
            'graduated_with' => $request->graduated_with
       ]);
   }
   public function addEducation($id)
   {
       $user = User::where('id', $id)->first();
       $educations = Education::where(['user_id' => $user->id, 'school_name' => null])->get();
       if(count($educations) == 0){
        Education::create([
            'user_id' => $user->id
        ]);
       }
   }
   public function subtractEducation($id)
   {
       Education::where('id', $id)->delete();
   }
   public function addQualification($id)
   {
        $user = User::where('id', $id)->first();
       $qualifications = ProfessionalQualification::where(['user_id' => $user->id, 'qualification' => null])->get();
       if(count($qualifications) == 0){
        ProfessionalQualification::create([
            'user_id' => $user->id
        ]);
       }
   }
   public function subtractQualification($id)
   {
       ProfessionalQualification::where('id', $id)->delete();
   }
   public function updateQualification(Request $request,  $id)
   {
        ProfessionalQualification::where('id', $id)->update([
            'qualification' => $request->qualification,
            'licensing_body' => $request->licensing_body,
            'year' => $request->year
        ]);
   }
   public function addExperience($id)
   {
        $user = User::where('id', $id)->first();
       $experiences = ProfessionalExperience::where(['user_id' => $user->id, 'facility_name' => null])->get();
       if(count($experiences) == 0){
        ProfessionalExperience::create([
            'user_id' => $user->id
        ]);
       }
   }
   public function subtractExperience($id)
   {
       ProfessionalExperience::where('id', $id)->delete();
   }
   public function updateExperience(Request $request, $id)
   {
       ProfessionalExperience::where('id', $id)->update([
           'facility_name' => $request->facility_name,
           'address' => $request->address,
           'from' => $request->from,
           'to' => $request->to
       ]);
   }
   public function updatePassword(Request $request, $id)
   {
       $this->validate($request, [
           'current_password' => 'required|string',
           'new_password' => 'required|string',
           'confirm_password' => 'required|string'
       ]);
       $current_password = $request->current_password;
       $new_password = $request->new_password;
       $confirm_password = $request->confirm_password;
       $user = User::where('id', $id)->first();
       if (empty($user)) {
            $patient = Patient::where('id', $id)->first();
            $present_password = $patient->password;
            $salt = substr($present_password, 0, CRYPT_SALT_LENGTH);
            $given_encrypted = crypt($current_password, $salt);
            if ($salt === $given_encrypted) {
                if ($new_password === $confirm_password) {
                    Patient::where('id', $id)->update([
                        'password' => bcrypt($new_password)
                    ]);
                } else {
                    return response()->json(['error' => 'New password does not match with confirm password.'], 401);
                }

            }else{
                return response()->json(['error' => 'Invalid current password'], 401);
            }
       } else {
            $present_password = $user->password;
            $salt = substr($present_password, 0, CRYPT_SALT_LENGTH);
            $given_encrypted = crypt($current_password, $salt);
            if ($salt === $given_encrypted) {
                if ($new_password === $confirm_password) {
                    User::where('id', $id)->update([
                        'password' => bcrypt($new_password)
                    ]);
                } else {
                return response()->json(['error' => 'New password does not match with confirm password.'], 401);
                }

            }else{
                return response()->json(['error' => 'Invalid current password'], 401);
            }
       }


   }
   public function updateHospitalClass(Request $request, $id)
    {
        $data = [
            'out_patient' => $request->out_patient,
            'medical' => $request->medical,
            'cardiology' => $request->cardiology,
            'gastroenterology' => $request->gastroenterology,
            'nephrology' => $request->nephrology,
            'dermatology' => $request->dermatology,
            'hematology' => $request->hematology,
            'endocrinology' => $request->endocrinology,
            'geriatrics' => $request->geriatrics,
            'psychiatry' => $request->psychiatry,
            'pulmonology' => $request->pulmonology,
            'neurology' => $request->neurology,
            'infectious_diseases' => $request->infectious_diseases,
            'nuclear_medicine' => $request->nuclear_medicine,
            'family_medicine' => $request->family_medicine,
            'surgical' => $request->surgical,
            'ophthalmology' => $request->ophthalmology,
            'general_surgery' => $request->general_surgery,
            'cardiothoracic_surgery' => $request->cardiothoracic_surgery,
            'neuro_surgery' => $request->neuro_surgery,
            'orthopedic_surgery' => $request->orthopedic_surgery,
            'urology' => $request->urology,
            'otorhinolaryngology' => $request->otorhinolaryngology,
            'anesthesia' => $request->anesthesia,
            'oncology' => $request->oncology,
            'radiology' => $request->radiology,
            'vascular_surgery' => $request->vascular_surgery,
            'pediatric_surgery' => $request->pediatric_surgery,
            'plastic_surgery' => $request->plastic_surgery,
            'pathology' => $request->pathology,
            'obstetrics_gynecology' => $request->obstetrics_gynecology,
            'obstetrics' => $request->obstetrics,
            'gynecology' => $request->gynecology,
            'fertility_reproductive_techniques' => $request->fertility_reproductive_techniques,
            'pediatrics' => $request->pediatrics,
            'p_gastroenterology' => $request->p_gastroenterology,
            'p_pulmonology' => $request->p_pulmonology,
            'p_nephrology' => $request->p_nephrology,
            'p_neonatology' => $request->p_neonatology,
            'child_psychiatry' => $request->child_psychiatry,
            'p_oncology' => $request->p_oncology,
            'p_endocrinology' => $request->p_endocrinology,
            'dental' => $request->dental,
            'oral_and_maxilo_facial_surgery' => $request->oral_and_maxilo_facial_surgery,
            'periodontics' => $request->periodontics,
            'in_patient' => $request->in_patient,
            'accident_and_emergency' => $request->accident_and_emergency,
            'acc_number_of_beds' => $request->acc_number_of_beds,
            'admission_facilities' => $request->admission_facilities,
            'adm_number_of_beds' => $request->adm_number_of_beds,
            'intensive_care_unit' => $request->intensive_care_unit,
            'icu_number_of_beds' => $request->icu_number_of_beds,
            'antenatal_care' => $request->antenatal_care,
            'immunization' => $request->immunization,
            'hiv_aids_services' => $request->hiv_aids_services,
            'tuberculosis' => $request->tuberculosis,
            'non_communicable_diseases' => $request->non_communicable_diseases,
            'family_planning' => $request->family_planning,
            'number_of_medical_doctors' => $request->number_of_medical_doctors,
            'number_of_dentists' => $request->number_of_dentists,
            'number_of_nurses_single' => $request->number_of_nurses_single,
            'number_of_midwives_single' => $request->number_of_midwives_single,
            'number_of_nurse_midwife_double' => $request->number_of_nurse_midwife_double,
            'number_of_community_health_officer' => $request->number_of_community_health_officer,
            'number_of_junior_community_health_extension_worker' => $request->number_of_junior_community_health_extension_worker,
            'number_of_environmental_health_officers' => $request->number_of_environmental_health_officers,
            'number_of_pharmacists' => $request->number_of_pharmacists,
            'number_of_pharmacy_technicians' => $request->number_of_pharmacy_technicians,
            'number_of_laboratory_scientists' => $request->number_of_laboratory_scientists,
            'number_of_laboratory_technicians' => $request->number_of_laboratory_technicians,
            'number_of_health_record_officers' => $request->number_of_health_record_officers,
            'number_of_community_health_extension_worker' => $request->number_of_community_health_extension_worker,
            'number_of_dental_technicians' => $request->number_of_dental_technicians,
            'onsite_pharmacy' => $request->onsite_pharmacy,
            'onsite_laboratory' => $request->onsite_laboratory,
            'onsite_imaging_center' => $request->onsite_imaging_center,
            'mortuary_services' => $request->mortuary_services
        ];
        $user = User::where('id', $id)->first();
        $facility_id = $user->facility_id;
        HospitalClass::where('facility_id', $facility_id)->update($data);
        /*
            Add service for the medical service
            if the hospital tick the service
            The function below helps to had the service
            if the services has not been added before
        */
        function addService($service, $facility_id){
            //check if the service has not been added before
            $services = DB::table('medical_services')
                                ->where([
                                    ['name', '=', $service],
                                    ['facility_id', '=', $facility_id]
                                ])->get();

            if (count($services) == 0) {
                MedicalService::create([
                    'facility_id' => $facility_id,
                    'name' => $service,
                ]);
            }
        }
        if(isset($request->cardiology) && $request->cardiology == true){
            addService('Cardiology', $facility_id);
        }
        if (isset($request->gastroenterology) && $request->gastroenterology == true) {
            addService('Gastroenterology', $facility_id);
        }
        if (isset($request->nephrology) && $request->nephrology == true) {
            addService('Nephrology', $facility_id);
        }
        if (isset($request->dermatology) && $request->dermatology == true) {
            addService('Dermatology', $facility_id);
        }
        if (isset($request->hematology) && $request->hematology == true) {
            addService('Hematology', $facility_id);
        }
        if (isset($request->endocrinology) && $request->endocrinology == true) {
            addService('Endocrinology', $facility_id);
        }
        if (isset($request->geriatrics) && $request->geriatrics == true) {
            addService('Geriatrics', $facility_id);
        }
        if (isset($request->psychiatry) && $request->psychiatry == true) {
            addService('Psychiatry / Behavioral Medicine', $facility_id);
        }
        if (isset($request->pulmonology) && $request->pulmonology == true) {
            addService('Pulmonology', $facility_id);
        }
        if (isset($request->neurology) && $request->neurology == true) {
            addService('Neurology', $facility_id);
        }
        if (isset($request->infectious_diseases) && $request->infectious_diseases == true) {
            addService('Infectious Diseases', $facility_id);
        }
        if (isset($request->family_medicine) && $request->family_medicine == true) {
            addService('Family Medicine', $facility_id);
        }
        if (isset($request->nuclear_medicine) && $request->nuclear_medicine == true) {
            addService('Nuclear Medicine', $facility_id);
        }
        if (isset($request->ophthalmology) && $request->ophthalmology == true) {
            addService('Ophthalmology', $facility_id);
        }
        if (isset($request->general_surgery) && $request->general_surgery == true) {
            addService('General Surgery', $facility_id);
        }
        if (isset($request->cardiothoracic_surgery) && $request->cardiothoracic_surgery == true) {
            addService('Cardiothoracic Surgery', $facility_id);
        }
        if (isset($request->neuro_surgery) && $request->neuro_surgery == true) {
            addService('Neuro Surgery', $facility_id);
        }
        if (isset($request->orthopedic_surgery) && $request->orthopedic_surgery == true) {
            addService('Orthopedic Surgery', $facility_id);
        }
        if (isset($request->urology) && $request->urology == true) {
            addService('Urology', $facility_id);
        }
        if (isset($request->otorhinolaryngology) && $request->otorhinolaryngology == true) {
            addService('Otorhinolaryngology (ENT)', $facility_id);
        }
        if (isset($request->anesthesia) && $request->anesthesia == true) {
            addService('Anesthesia', $facility_id);
        }
        if (isset($request->oncology) && $request->oncology == true) {
            addService('Oncology / Radiotheraphy', $facility_id);
        }
        if (isset($request->radiology) && $request->radiology == true) {
            addService('Radiology', $facility_id);
        }
        if (isset($request->vascular_surgery) && $request->vascular_surgery == true) {
            addService('Vascular Surgery', $facility_id);
        }
        if (isset($request->pediatric_surgery) && $request->pediatric_surgery == true) {
            addService('Pediatric Surgery', $facility_id);
        }
        if (isset($request->plastic_surgery) && $request->plastic_surgery == true) {
            addService('Plastic Surgery', $facility_id);
        }
        if (isset($request->pathology) && $request->pathology == true) {
            addService('Pathology', $facility_id);
        }
        if (isset($request->obstetrics) && $request->obstetrics == true) {
            addService('Obstetrics', $facility_id);
        }
        if (isset($request->gynecology) && $request->gynecology == true) {
            addService('Gynecology', $facility_id);
        }
        if (isset($request->fertility_reproductive_techniques) && $request->fertility_reproductive_techniques == true) {
            addService('Fertility Reproductive Techniques', $facility_id);
        }
        if (isset($request->p_gastroenterology) && $request->p_gastroenterology == true) {
            addService('Pediatric Gastroenterology', $facility_id);
        }
        if (isset($request->p_pulmonology) && $request->p_pulmonology == true) {
            addService('Pediatric Pulmonology', $facility_id);
        }
        if (isset($request->p_nephrology) && $request->p_nephrology == true) {
            addService('Pediatric Nephrology', $facility_id);
        }
        if (isset($request->p_neonatology) && $request->p_neonatology == true) {
            addService('Pediatric Neonatology', $facility_id);
        }
        if (isset($request->child_psychiatry) && $request->child_psychiatry == true) {
            addService('Child Psychiatry / Behavioral Medicine', $facility_id);
        }
        if (isset($request->p_oncology) && $request->p_oncology == true) {
            addService('Pediatric Oncology', $facility_id);
        }
        if (isset($request->p_endocrinology) && $request->p_endocrinology == true) {
            addService('Pediatric Endocrinology', $facility_id);
        }
        if (isset($request->oral_and_maxilo_facial_surgery) && $request->oral_and_maxilo_facial_surgery == true) {
            addService('Oral and Maxilo-Facial Surgery', $facility_id);
        }
        if (isset($request->periodontics) && $request->periodontics == true) {
            addService('Periodontics', $facility_id);
        }
    }
    public function medicalServices($id)
    {
        $user = User::where('id', $id)->first();
        $services = DB::table('medical_services')
                        ->where([
                            ['facility_id', '=', $user->facility_id]
                        ])->get();
        return response()->json($services);
    }
    public function updateMedicalService($user_id, $id, $price)
    {
        if (is_numeric($price) && $price >= 1) {
            $user  = User::where('id', $user_id)->first();
            MedicalService::where(['facility_id' => $user->facility_id, 'id' => $id])->update([
                'price' => $price
            ]);
        } else {
            return response()->json(['error' => 'You have entered an invalid price'], 401);
        }


    }
    public function patients($patient_id)
    {
        return response()->json(DB::table('patients')->where('id', '!=', $patient_id)->get());
    }


}
