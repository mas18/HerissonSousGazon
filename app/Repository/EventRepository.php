<?php
/**
 * Created by PhpStorm.
 * User: sandr
 * Date: 22.03.2017
 * Time: 14:35
 */

namespace App\Repository;

use App\Event;
use PhpParser\Node\Scalar\String_;

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
        $this->save($event,$inputs);
    }


    function save(Event $event, $inputs)
    {
        $event->starting=$inputs['dateFrom'];
        $event->ending=$inputs['dateTo'];

        $event->save();
    }


}