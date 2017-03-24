<?php
/**
 * Created by PhpStorm.
 * User: sandr
 * Date: 22.03.2017
 * Time: 14:35
 */

namespace App\Repository;

use App\Event;

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

    function store(Array $inputs)
    {

        $event=new $this->event;
        $this->save($event,$inputs);
    }

    function update(Array $inputs)
    {
        $this->save($this->getById($inputs['eventId']), $inputs);
    }


    function save(Event $event, $inputs)
    {
        $event->starting=$inputs['dateFrom'];
        $event->ending=$inputs['dateTo'];

        $event->save();
    }

}