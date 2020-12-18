<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
	/**
	 * @var bool
	 */
	public $timestamps = false;
	
	/**
	 * @var string
	 */
	protected $table = 'order_details';
	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'id',
		'order_id',
		'product_id',
		'price',
		'qty'
	];
	
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];
}
