<?php
/**
 * Created by PhpStorm.
 * User: sandr
 * Date: 22.03.2017
 * Time: 14:35
 */

namespace App\Repository;

use App\Schedule;
use App\Event;
use App\Room;
use Carbon\Carbon;
use Yajra\Datatables\Contracts\DataTableEngineContract;

class ScheduleRepository
{
    protected $schedule;
    protected $room;

    public function __construct(Schedule $schedule, Room $room)
    {
        $this->schedule = $schedule;
        $this->room=$room;
    }


    function copy(Event $eventOld, Event $eventNew)
    {
        $new = Carbon::parse($eventNew->starting);
        $old = Carbon::parse($eventOld->starting);
        $diff = $new->diffInDays($old);
        $schedules = Schedule::where('event_id', '=', $eventOld->id)->get();

        foreach ($schedules as $s) {
            $schedule = new $this->schedule;
            $this->saveCopy($schedule, $s, $eventNew, $diff);
        }
    }

    function saveCopy(Schedule $schedule, Schedule $s, Event $event, $diff)
    {
        $start = Carbon::parse($s->start);
        $finish = Carbon::parse($s->finish);

        $schedule->places = $s->places;
        $schedule->start = $start->addDays($diff);
        $schedule->finish = $finish->addDays($diff);
        $schedule->event_id = $event->id;
        $schedule->room_id = $s->room_id;

        $schedule->save();
    }

    function getDates(Event $event){
        $dates = [];

        $start = Carbon::parse($event->starting);
        $end = Carbon::parse($event->ending);

        for($date = $start; $date->lte($end); $date->addDay()) {
            $dates[] = $date->format('Y-m-d');
        }

        return $dates;
    }


    //admin methode
    function save(schedule $schedule, $inputs)
    {
        $schedule->places = $inputs['places'];
        $schedule->start = $inputs['start'];
        $schedule->finish = $inputs['finish'];
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

        $user = new $this->user;

        $user->password = bcrypt($inputs['password']);
        $this->save($user, $inputs);
        return $user;
    }

    function getById($id)
    {
        return $this->user->findOrFail($id);
    }

        function getAllWithRelation($event_id=1)
        {
            return $this->schedule->with('users')->where('event_id',$event_id)->with('rooms')->get();
        }

    function update($id, $input)
    {
        $this->save($this->getById($id), $input);
    }

    function destroy($id)
    {

        $this->getById($id)->delete();
    }

    function register(Array $inputs)
    {
        $user = new $this->user;
        $user->password = bcrypt($inputs['password']);
        $user->email = $inputs['email'];
        $user->firstname = $inputs['firstname'];
        $user->lastname = $inputs['lastname'];
        $user->street = $inputs['street'];
        $user->city = $inputs['city'];
        $user->tel = $inputs['tel'];
        $user->comment = $inputs['comment'];

        return $user->save();
    }



    function storeRoom(Array $inputs)
    {
        $room= new $this->room;
        $this->saveRoom($room,$inputs);
        return $room;
    }

    function saveRoom(Room $room, $inputs)
    {
        $room->name=$inputs['roomName'];
        $room->save();
    }

}