<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function setEmailAttribute($value){
        $this->attributes['email'] = ucfirst(strtolower($value) );
    }

//    protected function email(){
//     return Attribute::make(
//         get: fn($value) => strtoupper($value),
//         set: fn ($value) => strtolower($value)
//     );

//     }

public function classrooms(){
    return $this->belongsToMany(Classroom::class, //Related model
    'classroom_user',// pivot table
    'user_id',//FK for current model to the pivot table
    'classroom_id',// FK for related model to the pivot table
    'id',// PK for current model
    'id'// PK for related model
)->withPivot(['role','created_at']);
// ->as('join');
}

public function createdClassrooms(){
   return $this->hasMany(Classroom::class,'user_id');
}

public function classworks(){
    return $this->belongsTo(Classwork::class);

}
}
