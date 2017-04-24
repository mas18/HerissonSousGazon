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
use App\User;
use App\Repository\DateRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use League\Flysystem\Exception;
use Yajra\Datatables\Contracts\DataTableEngineContract;

class ScheduleRepository
{
    protected $schedule;
    protected $room;
    protected $dateRepository;

    public function __construct(Schedule $schedule, Room $room, DateRepository $dateRepository)
    {
        $this->schedule = $schedule;
        $this->room=$room;
        $this->dateRepository = $dateRepository;
    }


    function copy(Event $eventOld, Event $eventNew)
    {
        $new = Carbon::parse($eventNew->starting);
        $old = Carbon::parse($eventOld->starting);
        $diff = $new->diffInDays($old);
        $schedules = Schedule::where('event_id', '=', $eventOld->id)->get();

        if($old->lt($new)){
            $add = true;
        } else {
            $add = false;
        }

        foreach ($schedules as $s) {
            $schedule = new $this->schedule;
            $this->saveCopy($schedule, $s, $eventNew, $diff, $add);
        }
    }

    function saveCopy(Schedule $schedule, Schedule $s, Event $event, $diff, $add)
    {
        $start = Carbon::parse($s->start);
        $finish = Carbon::parse($s->finish);

        $schedule->places = $s->places;
        if($add){
            $schedule->start = $start->addDays($diff);
            $schedule->finish = $finish->addDays($diff);
        } else {
            $schedule->start = $start->subDays($diff);
            $schedule->finish = $finish->subDays($diff);
        }

        $schedule->event_id = $event->id;
        $schedule->room_id = $s->room_id;

        $schedule->save();
    }

    function getDates(Event $event)
    {
        $dates = [];

        $start = Carbon::parse($event->starting);
        $end = Carbon::parse($event->ending);

        for ($date = $start; $date->lte($end); $date->addDay()) {
            $dates[] = $date->format('Y-m-d');
        }

        return $dates;
    }

    function saveNew(schedule $schedule, $inputs, $timeFrom, $timeTo)
    {
        $date = $this->dateRepository->parseDate_y_m_d($inputs['date_edit']);

        $start = $date . ' ' . $timeFrom;
        $finish = $date . ' ' . $timeTo;

        $schedule->places = $inputs['number'];
        $schedule->room_id = $inputs['place'];
        $schedule->event_id = $inputs['eventId'];
        $schedule->start = $start;
        $schedule->finish = $finish;
        $schedule->save();
    }


    //subscribe user
    function subscribeuser(Schedule $schedule, User $user)
    {
        $user->getById('id');
        $schedule->getById('id');

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

    function store(Array $inputs, $timeFrom, $timeTo)
    {

        $schedule = new $this->schedule;

        $this->saveNew($schedule, $inputs, $timeFrom, $timeTo);

        return $schedule;
    }

    function getById($id)
    {
        return $this->schedule->findOrFail($id);
    }

    function getByIdWithUsers($schedule_id)
    {
        $schedules = Schedule::
        with('users')
            ->with('rooms')
            ->find($schedule_id);

        return $schedules;
    }

    function getAllWithRelation($event_id = 1)
    {
        $schedules = Schedule::
        with('rooms')
            ->with('users')
            ->where('schedules.event_id', '=', $event_id)
            ->get();

        return $schedules;
    }

    function getByIdWithRelation($scheduleID)
    {
        return $this->schedule->with('users')->find($scheduleID);
    }

    function placesTotal($eventID)
    {
        return $this->schedule->where('schedules.event_id', '=', $eventID)->sum('places');
    }

    function placesOccupied($eventID)
    {
        $schedules = $this->getAllWithRelation($eventID);
        $counter = 0;

        foreach ($schedules as $s) {
            $counter += count($s->users);
        }

        return $counter;
    }

    function getVolonteers($eventID)
    {
        $schedules = $this->getAllWithRelation($eventID);
        $users = collect();

        foreach ($schedules as $s) {
            foreach ($s->users as $user) {
                $users->push($user);
            }
        }

        $unique = $users->unique('id');

        return $unique;
    }

    function update($id, $inputs)
    {
        $schedule = $this->getById($id);

        $date = $this->dateRepository->parseDate_y_m_d($inputs['date_edit']);


        $start = $date . ' ' . $inputs['timeFrom_edit'];
        $finish = $date . ' ' . $inputs['timeTo_edit'];

        $schedule->places = $inputs['number_edit'];
        $schedule->room_id = $inputs['place_edit'];
        $schedule->event_id = $inputs['eventId'];
        $schedule->start = $start;
        $schedule->finish = $finish;

        $schedule->save();
    }

    function destroy($id)
    {

        $this->getById($id)->delete();
    }


    function getPlacedUsedOnSchedule($scheduleId)
    {
        $schedule = $this->getByIdWithRelation($scheduleId);
        $counter = 0;
        try {
            $counter = count($schedule->users);
        } catch (Exception $ex) {
            return 0;
        }

        return $counter;

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
        $room = new $this->room;
        $this->saveRoom($room, $inputs);
        return $room;
    }

    function saveRoom(Room $room, $inputs)
    {
        $room->name = $inputs['roomName'];
        $room->save();
    }

    function isUserSubscribe($userId, $scheduleId)
    {
        $exist = false;
        try {

            $exist = DB::table('schedule_user')
                    ->where('schedule_id', '=', $scheduleId)
                    ->where('user_id', '=', $userId)
                    ->count() > 0;
        } catch (Exception $ex) {
            return false;
        }
        return $exist;
    }

    function subscribuUserToSchedule($userId, $scheduleId)
    {
        try {
            $currentCchedule = $this->schedule->findOrFail($scheduleId);
            $currentCchedule->users()->attach($userId);

        } catch (Exception $ex) {

        }
    }

    function unSubscribeUserSchedule($userId, $scheduleId)
    {
        try {
            $currentCchedule = $this->schedule->findOrFail($scheduleId);
            $currentCchedule->users()->detach($userId);

        }
        catch (Exception $ex)
        {

        }
    }

    function hasUserSchedule($schedule, $userId)
    {
        try {
            foreach ($schedule->users as $aUser) {
                if ($aUser->id == $userId)
                    return true;
            }
        } catch (Exception $ex) {

        }
        return false;
    }

    public function isTimeWithThisHourExiste($userID, $schedule)
    {
        $startDate = new Carbon($schedule->start);
        $endDate = new Carbon($schedule->finish);


        return Schedule::
            //query inside the other table (n to n relation)
            whereHas('users', function ($query) use ($userID) {
                $query->where('user_id', '=', $userID);
            })
            ->where(function ($query) use ($startDate, $endDate) {
                $query->where(function ($query) use ($startDate, $endDate) {
                    $query
                        ->where('start', '>=', $startDate)
                        ->where('start', '<=', $endDate);
                }); //nested where instead the or where statement
                $query->OrWhere(function ($query) use ($startDate, $endDate) {
                    $query
                        ->where('start', '<', $startDate)
                        ->where('finish', '>', $startDate);
                });
            })
                ->get()
                ->count() > 0;
    }


    public function detachUser($scheduleId){

        $currentCchedule = $this->schedule->findOrFail($scheduleId);
        $currentCchedule->users()->detach();
    }


    //subscription or unsubscription by administrator
    public function subscribeByAdmin($scheduleId, $id)
    {
        $currentCchedule = $this->schedule->findOrFail($scheduleId);

        if (!empty($id)) {


                try {
                    $currentCchedule->users()->attach($id);
                } catch (Exception $ex) {
                }

        }
    }

}