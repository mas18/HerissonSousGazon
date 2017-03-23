<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model {

	protected $table = 'events';
	public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $fillable = array('starting', 'ending');

	public function schedules()
	{
		return $this->hasMany('App\Schedule');
	}

}