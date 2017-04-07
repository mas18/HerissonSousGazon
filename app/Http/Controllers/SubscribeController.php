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
        $this->repository->subscribuUserToSchedule($userID,$scheduleId);
    }
    private  function unSubscribe($userID, $scheduleId)
    {
       $this->repository->unSubscribeUserSchedule($userID,$scheduleId);
    }



    public function subscriptionadmin(ScheduleSubscribeUser $request){


        //$this->scheduleRepository->subscribeByAdmin($request->scheduleId, $request->all());
        $this->scheduleRepository->subscribeByAdmin(1, $request->all());

        return redirect()->route('schedule.show', $request->eventId);
    }



}
