<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model {
    use SoftDeletes;
    protected $dates = ['deleted_at'];

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

    public static function boot()
    {
        parent::boot();

        // cause a delete of a product to cascade to children so they are also deleted
        static::deleted(function($event)
        {
            $event->schedules()->delete();
        });
    }

}