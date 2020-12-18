<?php
/**
 *
 * @Project: interview-case-study
 * @Filename: User.php
 * @Author: longnc <nguyenchilong90@gmail.com>
 * @Created Date: 12/16/20 8:29 PM
 *
 * @Description: Text description here
 */


namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
	use Authenticatable,
		Authorizable,
		HasFactory,
		SoftDeletes;
	
	protected $table = 'users';
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'id',
		'name',
		'email',
		'verified_at',
		'status',
		'created_at',
		'updated_at',
		'deleted_at'
	];
	
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password',
	];
}
