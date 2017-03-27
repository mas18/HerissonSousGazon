<?php
/**
 * Created by PhpStorm.
 * User: teuft
 * Date: 27.03.2017
 * Time: 11:19
 */

namespace App\Repository;


use App\Schedule;
use Yajra\Datatables\Contracts\DataTableEngineContract;

class ScheduleRepository
{
    protected $schedule;

    public function __construct(Schedule $schedule)
    {
        $this->schedule=$schedule;
    }

    //admin methode
    function save(schedule $schedule, $inputs)
    {
        $schedule->places=$inputs['places'];
        $schedule->start=$inputs['start'];
        $schedule->finish=$inputs['finish'];
        $schedule->save();
    }


    function getPaginate($nbPerPage)
    {
        // return $this->user->orderBy('lastname', 'ASC')->orderBy('firstname', 'ASC')->paginate($nbPerPage);

    }
    function getDataTable()
    {
        return DataTableEngineContract::of(Schedule::all())->make(true);
    }

    function store(Array $inputs)
    {

        $user=new $this->user;

        $user->password=bcrypt($inputs['password']);
        $this->save($user,$inputs);
        return $user;
    }

    function getById($id)
    {
        return $this->user->findOrFail($id);
    }

    function update($id, $input)
    {
        $this->save($this->getById($id),$input);
    }

    function destroy($id)
    {

        $this->getById($id)->delete();
    }

    function register(Array $inputs)
    {
        $user=new $this->user;
        $user->password=bcrypt($inputs['password']);
        $user->email=$inputs['email'];
        $user->firstname=$inputs['firstname'];
        $user->lastname=$inputs['lastname'];
        $user->street=$inputs['street'];
        $user->city=$inputs['city'];
        $user->tel=$inputs['tel'];
        $user->comment=$inputs['comment'];

        return $user->save();
    }
}