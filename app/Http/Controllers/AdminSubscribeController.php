<?php

namespace App\Http\Controllers;

use App\Repository\UserRepository;
use App\Repository\ScheduleRepository;
use App\Http\Requests\ScheduleSubscribeUser;
use Illuminate\Http\Request;

class AdminSubscribeController extends Controller
{
    public $userRepository;
    public $scheduleRepository;

    public function __construct(UserRepository $repository, ScheduleRepository $scheduleRepository)
    {
        $this->middleware('admin');
        $this->userRepository=$repository;
        $this->scheduleRepository=$scheduleRepository;
    }

    //
    public function sendUserListofSchedule($id_schedule="")
    {

        $userSubscribedList=$this->userRepository->findUserWithSubscibedID($id_schedule);

        $arrayID=array();
        foreach ($userSubscribedList as $aUser)
        {
            array_push($arrayID,$aUser->id);
        }

        $userNotInList=$this->userRepository->findUserWhereIdIsNot($arrayID);

        $response=array($userSubscribedList,$userNotInList);


        return response()->json($response);
    }




    //subscription or unsubscription by administrator
    public function subscriptionadmin(ScheduleSubscribeUser $request){

        $schedule=$this->scheduleRepository->getById($request['scheduleId2']);

        $this->scheduleRepository->detachUser($request["scheduleId2"]);

        if (!$request['subscribed_user_list'])
            return back();

        //will store the users taht have an error
        $arrayErroruser=array();
        foreach ($request["subscribed_user_list"] as $aUserId){
        //check if the times laps is not on another schedule
        if ($this->scheduleRepository->isTimeWithThisHourExiste($aUserId,$schedule))
            {
                array_push($arrayErroruser,$aUserId);
                var_dump($aUserId);
            }
            else{
                $this->scheduleRepository->subscribeByAdmin($request["scheduleId2"], $aUserId);
            }
        }

        //get the user with the hour aldredy used
       if (!$arrayErroruser)
           return back();

        $errorUserList=$this->userRepository->getAllUserWithId($arrayErroruser);
        $subscribeErrorMessage=[];
        foreach ($errorUserList as $aUser)
        {
            array_push($subscribeErrorMessage,$aUser->firstname." ". $aUser->lastname.", ");
        }

        array_push($subscribeErrorMessage,"participe(ent) déjà à une activité durant ce laps de temps");

        session(['error_user_list'=>$subscribeErrorMessage]);
        return back();







    }
}
