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

        //check if the schedule has enought place to add a new user
        $schedule=$this->repository->getByIdWithUsers($scheduleId);
        if  (count($schedule->users)>=$schedule->places)
        {
            return false;
        }
        //check if the times laps is not on another schedule


        $this->repository->subscribuUserToSchedule($userID,$scheduleId);
        return true;
    }
    private  function unSubscribe($userID, $scheduleId)
    {
       $this->repository->unSubscribeUserSchedule($userID,$scheduleId);
    }

}
