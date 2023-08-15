<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'nin_number', 'role', 'facility_id', 'practice_type', 'job_type', 'mdcn_number', 'pcn_number', 'employment_type', 'token', 'is_email_verified', 'pin', 'pin_usability', 'active', 'dead'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
     // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
    
    public function facility_signature()
    {
        return $this->hasOne(FacilitySignature::class, 'facility_id');
    }

    public function hospital_class()
    {
        return $this->hasOne(HospitalClass::class, 'facility_id');
    }

    public function medical_services()
    {
        return $this->hasMany(MedicalService::class, 'facility_id');
    }
    public function deliveries()
    {
        return $this->hasMany(Delivery::class, 'facility_id');
    }
    public function drugs()
    {
        return $this->hasMany(Drug::class, 'facility_id');
    }
    
    public function items()
    {
        return $this->hasMany(Item::class, 'facility_id');
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class, 'facility_id');
    }
   
    public function educations()
    {
        return $this->hasMany(Education::class, 'user_id');
    }
    public function qualifications()
    {
        return $this->hasMany(ProfessionalQualification::class, 'user_id');
    }
    public function experiences()
    {
        return $this->hasMany(ProfessionalExperience::class, 'user_id');
    }
    public function verify()
    {
        return $this->hasOne(UserVerify::class);
    }
}
