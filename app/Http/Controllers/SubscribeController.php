<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScheduleRequest;
use App\Http\Requests\ScheduleSubscribeUser;
use App\Repository\ScheduleRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscribeController extends Controller
{
     public $repository;
     public $scheduleRepository;
    //
    public function __construct(ScheduleRepository $repository, ScheduleRepository $scheduleRepository)
    {
        $this->repository=$repository;
        $this->scheduleRepository=$scheduleRepository;
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
        $userID=Auth::user()->id;
        if  (count($schedule->users)>=$schedule->places)
        {
            return false;
        }
        //check if the times laps is not on another schedule
         if ($this->repository->isTimeWithThisHourExiste($userID,$schedule))
         {
             // create the session message to display to the user
         session(['error_msg'=>'Vous participez déjà à une activité durant ce laps de temps']) ;
             return back();
         }
        $this->repository->subscribuUserToSchedule($userID,$scheduleId);
        return true;
    }


    private  function unSubscribe($userID, $scheduleId)
    {
       $this->repository->unSubscribeUserSchedule($userID,$scheduleId);
    }






}
