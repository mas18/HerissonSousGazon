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

Route::get('/subscribe/{idSchedule}',"SubscribeController@action");

Route::get('/adminuserslist/{idSchedule?}',"AdminSubscribeController@sendUserListofSchedule");

Route::get('/home', 'WelcomeController@index');
Route::get('/events', 'EventController@index')->name('event.show');
Route::post('/events', 'EventController@store')->name('event.store');
Route::resource('/user', 'UserController');
Route::get('profil','ProfilController@display');
Route::post('profil','ProfilController@save');
Route::post('/events/new', 'EventController@store')->name('event.store');
Route::post('/events/update', 'EventController@edit')->name('event.update');
Route::get('/events/delete/{id}', 'EventController@destroy');
Route::get('/schedule/delete/{id}', 'ScheduleController@destroy');
Route::post('/events/newRoom', 'RoomController@store')->name('room.store');

Route::post('schedule', 'ScheduleController@subscribeuser');

//affichage de la view
Route::get('schedule/{number?}', 'ScheduleController@datatables')->name('schedule.show');
//data query Ajax

Route::get('schedule_data', 'ScheduleController@scheduledata');

Route::post('/schedule/new', 'ScheduleController@store')->name('schedule.store');
Route::post('/schedule/update', 'ScheduleController@edit')->name('schedule.update');
Route::post('/schedule/subscribtion', 'AdminSubscribeController@subscriptionadmin')->name('schedule.subscriptionadmin');
Route::post('/schedule/unsubscribe', 'SubscribeController@unsubscribeRequest')->name('schedule.unsubscribe');

Route::get('schedule/{number?}/{user?}/{schedule?}', 'SubscribeController@acceptUnsubscribe');



Route::get("test",function ()
{


    $mailer=new \App\Mailer\Mailer();
    $mailer->sendMail('Vilaine','Fille','clothrie@gmail.com');

    return view ('teste');

});






