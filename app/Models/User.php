<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'user_type_id', 'user_doc_id', 'user_enterprise_id','is_active'
    ];
    protected $visible = [
        'id', 'name', 'email', 'password','user_type_id', 
        'user_doc_id', 'user_enterprise_id', 'is_active',
        'userType', 'enterprise', 'userDoc'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userType() {
        return $this->hasOne(UserType::class, 'id', 'user_type_id');
    }

    public function enterprise() {
        return $this->hasOne(Enterprise::class, 'id', 'user_enterprise_id');
    }

    public function userDoc() {
        return $this->hasOne(UserDoc::class, 'id', 'user_doc_id');
    }

}
