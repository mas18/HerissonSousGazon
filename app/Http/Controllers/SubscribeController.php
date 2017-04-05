<?php

namespace App\Http\Controllers;

use App\Repository\ScheduleRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscribeController extends Controller
{
     public $repository;
    //
    public function __construct(ScheduleRepository $repository)
    {
        $this->repository=$repository;
    }

    public function action($scheduleId)
    {
        $userID=Auth::user()->id;
        $this->repository->isUserSubscribe($userID,$scheduleId) ? $this->unSubscribe($userID,$scheduleId) : $this->subscribe($userID,$scheduleId);
        return back()->withInput();



    }
    private  function subscribe($userID, $scheduleId)
    {
        $this->repository->subscribuUserToSchedule($userID,$scheduleId);
    }
    private  function unSubscribe($userID, $scheduleId)
    {
       $this->repository->unSubscribeUserSchedule($userID,$scheduleId);
    }

}
