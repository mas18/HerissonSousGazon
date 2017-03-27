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

//affichage de la view
Route::get('schedule/{number?}', 'ScheduleController@datatables');
//data query Ajax
Route::get('schedule_data', 'ScheduleController@scheduledata');


Route::get("test",function ()
{

    $repository=new \App\Repository\ScheduleRepository(new \App\Schedule());
    $schedule=$repository->getAllWithRelation();
    foreach ($schedule as $aSched)
    {
        echo  $aSched->users;
    }




    return view('teste');
});



