<?php
use App\User;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'WelcomeController@index');
Route::get('/events', 'EventController@index')->name('event.show');
Route::post('/events', 'EventController@store')->name('event.store');
Route::resource('user', 'userController');
Route::get('profil','ProfilController@display');
Route::post('profil','ProfilController@save');
Route::post('/events/new', 'EventController@store')->name('event.store');
Route::post('/events/update', 'EventController@edit')->name('event.update');

//Route::resource('schedule/{schedule?}', 'SchedulesController');


Route::get("test",function ()
{

    $user=User::with('schedules')->find(1);
    foreach ($user->schedules as $aSched)
    {
        echo "De ".$aSched->start." jusqu'au ".$aSched->finish ."<br/>";
    }


    return view('teste');
});



