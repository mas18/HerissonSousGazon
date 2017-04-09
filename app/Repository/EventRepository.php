<?php
/**
 * Created by PhpStorm.
 * User: sandr
 * Date: 22.03.2017
 * Time: 14:35
 */

namespace App\Repository;

use App\Event;
use App\Schedule;
use PhpParser\Node\Scalar\String_;
use Carbon\Carbon;


class EventRepository
{
    protected $event;

    public function __construct(Event $event)
    {
        $this->event=$event;
    }


    function getPaginate($nbPerPage)
    {
        return $this->event->orderBy('id', 'desc')->paginate($nbPerPage);
    }

    function getById($id)
    {
        return $this->event->findOrFail($id);
    }

    function getSecondLast()
    {
        return $this->event->orderBy('id', 'desc')->skip(1)->take(1)->first();
    }

    function store(Array $inputs)
    {

        $event=new $this->event;
        $this->save($event,$inputs);

        return $event;
    }

    function update(Array $inputs)
    {
        $event=$this->getById($inputs['eventId']);
        $this->updateSchedules($event, $inputs);
        $this->save($event,$inputs);
    }

    function delete($id)
    {
        $this->getById($id)->delete();
    }


    function updateSchedules($event, Array $inputs){
        $old = Carbon::parse($event->starting);
        $new = Carbon::parse($inputs['dateFrom']);
        $diff = $new->diffInDays($old);
        $schedules = Schedule::all()->where('event_id', '=', 3);

        foreach ($schedules as $s) {
            $start = Carbon::parse($s->start);
            $finish = Carbon::parse($s->finish);
            if ($old->lt($new)) {
                $s->start = $start->addDays($diff);
                $s->finish = $finish->addDays($diff);
                $s->save();
            } else {
                $s->start = $start->subDays($diff);
                $s->finish = $finish->subDays($diff);
                $s->save();
            }
        }
    }

    function save(Event $event, $inputs)
    {
        $event->starting=$inputs['dateFrom'];
        $event->ending=$inputs['dateTo'];

        $event->save();
    }


}