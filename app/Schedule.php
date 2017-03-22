<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model {

	protected $table = 'schedules';
	public $timestamps = true;

	use SoftDeletes;

	protected $dates = ['deleted_at'];
	protected $fillable = array('places', 'start', 'finish');

	public function users()
	{
		return $this->belongsToMany('User');
	}

	public function rooms()
	{
		return $this->belongsTo('Room');
	}

	public function events()
	{
		return $this->belongsTo('Event');
	}

}