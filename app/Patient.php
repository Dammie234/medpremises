<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Patient extends Authenticatable implements JWTSubject
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'token', 'password', 'nin_number', 'dead', 'email_verified_at', 'remember_token', 'is_email_verified', 'prenatal', 'prenatal_admission'];

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
    /**
     * Get the verify associated with the Patient
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function verify()
    {
        return $this->hasOne(PatientVerify::class);
    }
}
