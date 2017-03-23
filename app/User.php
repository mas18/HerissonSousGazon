<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = array('email', 'firstname', 'lastname', 'street', 'tel', 'comment','password','tel','city');

    protected $table = 'users';
    public $timestamps = true;
    use SoftDeletes;
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function schedules()
    {
        return $this->belongsToMany('App\Schedule');
    }
}
