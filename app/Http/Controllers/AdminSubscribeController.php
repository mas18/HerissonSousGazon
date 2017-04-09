<?php

namespace App\Http\Controllers;

use App\Repository\UserRepository;
use App\Repository\ScheduleRepository;
use App\Http\Requests\ScheduleSubscribeUser;
use Illuminate\Http\Request;

class AdminSubscribeController extends Controller
{
    public $repository;
    public $scheduleRepository;

    public function __construct(UserRepository $repository, ScheduleRepository $scheduleRepository)
    {
        $this->middleware('admin');
        $this->repository=$repository;
        $this->scheduleRepository=$scheduleRepository;
    }

    //
    public function sendUserListofSchedule($id_schedule="")
    {

        $userSubscribedList=$this->repository->findUserWithSubscibedID($id_schedule);

        $arrayID=array();
        foreach ($userSubscribedList as $aUser)
        {
            array_push($arrayID,$aUser->id);
        }

        $userNotInList=$this->repository->findUserWhereIdIsNot($arrayID);

       $response=array($userSubscribedList,$userNotInList);


        return response()->json($response);
    }




    //subscription or unsubscription by administrator
    public function subscriptionadmin(ScheduleSubscribeUser $request){

        var_dump($request["subscribed_user_list"]);
        $this->scheduleRepository->subscribeByAdmin($request["scheduleId2"], $request["subscribed_user_list"]);

        return redirect()->route('schedule.show', $request->eventId);
    }

}
