<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Contracts\Validation\Validator as ValidatorContract;
use Illuminate\Support\Facades\Validator;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
        'created_at' => 'datetime',
    ];

    /*******************
     * MUTATOR FUNCTIONS
     ******************
     */

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    /*******************
     * VALIDATION FUNCTIONS
     ******************
     */

    /**
     * @param $input
     * @return ValidatorContract|null
     */
    public function getValidatorRegistration($input): ?ValidatorContract
    {
        return Validator::make($input, [
            'name' => 'string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|max:10|confirmed'
        ]);
    }

    /*******************
     * ENTITIY FUNCTIONS
     ******************
     */

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /*******************
     * RELATIONSHIP FUNCTIONS
     ******************
     */

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

}
