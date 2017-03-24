<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model {

	protected $table = 'rooms';
	public $timestamps = true;

	use SoftDeletes;

	protected $dates = ['deleted_at'];
	protected $fillable = array('name','id');

	public function schedules()
	{
		return $this->hasMany('App\Schedule');
	}

}