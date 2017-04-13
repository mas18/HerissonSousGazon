<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScheduleRequest;
use App\Http\Requests\ScheduleSubscribeUser;
use App\Http\Requests\UnsubscribeRequest;
use App\Mailer\Mailer;
use App\Repository\ScheduleRepository;
use App\Repository\UserRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscribeController extends Controller
{
     public $scheduleRepository;


    /** @var UserRepository $userRepository */
     public $userRepository;

    //
    public function __construct(ScheduleRepository $repository, UserRepository $userRepository)
    {
        $this->scheduleRepository=$repository;
        $this->userRepository=$userRepository;

    }

    public function action($scheduleId)
    {
        $userID=Auth::user()->id;
        $this->scheduleRepository->isUserSubscribe($userID,$scheduleId) ? $this->unSubscribe($userID,$scheduleId) : $this->subscribe($userID,$scheduleId);
        return back()->withInput();
    }


    private  function subscribe($userID, $scheduleId)
    {
        //check if the schedule has enought place to add a new user
        $schedule=$this->scheduleRepository->getByIdWithUsers($scheduleId);
        $userID=Auth::user()->id;
        if  (count($schedule->users)>=$schedule->places)
        {
            return back();
        }
        //check if the times laps is not on another schedule
         if ($this->scheduleRepository->isTimeWithThisHourExiste($userID,$schedule))
         {
             // create the session message to display to the user
         session(['error_msg'=>'Vous participez déjà à une activité durant ce laps de temps']) ;
             return back();
         }
         //get the current user

        $this->scheduleRepository->subscribuUserToSchedule($userID,$scheduleId);
        $user=$this->userRepository->getById($userID);

        $this->sendConfirmMail($user,$schedule);
        return true;
    }
    private function sendConfirmMail($user, $schedule)
    {



        $mailer=new Mailer();
        $startCaron=new Carbon($schedule->start);
        $endCarbon=new Carbon($schedule->finish);



        //localization
        setlocale(LC_TIME, 'French');
        $startDate=$startCaron->formatLocalized('%A %d %B %Y');
        $endDate=$endCarbon->formatLocalized('%A %d %B %Y');
        $startHour=$startCaron->hour;
        $startMinute=$startCaron->minute<10 ? '00' : $startCaron->minute;

        $endHour=$endCarbon->hour;
        $endMinute=$endCarbon->minute <10 ? '00' : $endCarbon->minute;






        $message="Bonjour, ".$user->firstname.". Nous vous confirmons votre inscription à l'horaire suivant : Début :"
        . $startDate. " à ".$startHour."h".$startMinute.". Fin : ".$endDate ." à ".$endHour.'h'.$endMinute;




        $mailer->confirmSubscription("Confirmation d'inscription",$message,$user->email);

    }


    private function unSubscribe($userID, $scheduleId)
    {
       $this->scheduleRepository->unSubscribeUserSchedule($userID,$scheduleId);
    }

    public function unsubscribeRequest(UnsubscribeRequest $request){
        print($request['schedule']);
        print($request['user']);
        print($request['message']);
        exit;
    }







}
