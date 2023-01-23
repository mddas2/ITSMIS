<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'address',
        'post',
        'email',
        'office_id',
        'contact',
        'upload_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function hierarchy()
    {
        return $this->hasOne('App\Models\UserHierarchy','user_id','id');
    }

    public function office()
    {
        return $this->belongsTo('App\Models\Office','office_id','id');
    }

    public function role()
    {
        return $this->belongsTo('App\Models\Role','role_id','id');
    }

    public function uploads()
    {
        return $this->belongsTo('App\Models\Upload','upload_id','id');
    }
    
    public function getUserProvience()
    {
        return $this->belongsTo('App\Models\Province','provience_id','id');
    }
    public function getUserDistrict()
    {
        return $this->belongsTo('App\Models\District','district_id','id');
    }
    public function getUserMunicipality()
    {
        return $this->belongsTo('App\Models\Municipality','municipality_id','municipality_id');
    }

    // public function role()
    // {
    //     return $this->belongsTo('App\Models\Role', 'role_id', 'id');
    // }
}
