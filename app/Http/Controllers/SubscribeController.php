<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScheduleRequest;
use App\Http\Requests\ScheduleSubscribeUser;
use App\Http\Requests\UnsubscribeRequest;
use App\Mailer\Mailer;
use App\Repository\DateRepository;
use App\Repository\ScheduleRepository;
use App\Repository\UserRepository;
use Carbon\Carbon;
use App\User;
use App\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscribeController extends Controller
{
     public $scheduleRepository;


    /** @var UserRepository $userRepository */
     public $userRepository;
     private $dateRepository;

    //
    public function __construct(ScheduleRepository $repository, UserRepository $userRepository,DateRepository $dateRepository)
    {
        $this->scheduleRepository=$repository;
        $this->userRepository=$userRepository;
        $this->dateRepository=$dateRepository;
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
        //the text to confirm the inscription
        $this->send_mail_confirm_subscription($user,$schedule);
        return true;
    }


    private function unSubscribe($userID, $scheduleId)
    {
        $user = User::find($userID);
        $schedule = Schedule::find($scheduleId);
        //CHECK DATE DIFF BETWEEN TODAY AND IN 3 SEM
        $dayDifference=$this->dateRepository->difference_day_from_today($schedule->start);
        if ($dayDifference>=config('Constant.deadLine'))
        {//we do the unsubscribe
            $this->scheduleRepository->unSubscribeUserSchedule($userID,$scheduleId);
            //send the mail
            $this->send_mail_confirm_unscubcription($user,$schedule);
            return back();
        }
        //else, we ask the admin for change

        return redirect()->route('schedule.show', ['number' => $schedule->event_id])->withUnsub("Votre demande a été envoyé à l'administrateur");
    }


    public function unsubscribeRequest(UnsubscribeRequest $request){

    $content = $request['message'];
    $user = User::find($request['user']);
    $schedule = Schedule::find($request['schedule']);

    $mailer=new \App\Mailer\Mailer();
    $mailer->sendMailUnsubscribeRequest('Demande de désinscription', $content, 'isaline.bruchez@gmail.com', $user, $schedule);

    return redirect()->route('schedule.show', ['number' => $schedule->event_id])->withUnsub("Votre demande a été envoyé à l'administrateur");
    }

    public function acceptUnsubscribe($eventID, $userID, $scheduleID){
        $user = User::find($userID);
        $this->scheduleRepository->unSubscribeUserSchedule($userID, $scheduleID);
        return redirect()->route('schedule.show', ['number' => $eventID])->withUnsub($user->firstname . " " . $user->lastname . " a été désinscrit.");
    }

    private function send_mail_confirm_subscription($user, $schedule)
    {

        $mailer=new Mailer();
        $startCaron=new Carbon($schedule->start);
        $endCarbon=new Carbon($schedule->finish);

        //localization
        $startDate=$this->dateRepository->parse_date_localized_dddd_mmmm_yyyy($schedule->start);
        $endDate=$this->dateRepository->parse_date_localized_dddd_mmmm_yyyy($schedule->end);
        $startHour=$startCaron->hour;
        $startMinute=$startCaron->minute<10 ? '00' : $startCaron->minute;

        $endHour=$endCarbon->hour;
        $endMinute=$endCarbon->minute <10 ? '00' : $endCarbon->minute;

        $message="Bonjour ".$user->firstname.". Nous vous confirmons votre inscription à l'horaire suivant : Début :"
            . $startDate. " à ".$startHour."h".$startMinute.". Fin : ".$endDate ." à ".$endHour.'h'.$endMinute;

        $mailer->send_standart_mail("Confirmation d'inscription",$message,$user->email);

    }

    private function send_mail_confirm_unscubcription($user, $schedule)
    {

        $mailer=new Mailer();
        $startCaron=new Carbon($schedule->start);
        $endCarbon=new Carbon($schedule->finish);

        //localization
        setlocale(LC_TIME, 'French');
        $startDate=$this->dateRepository->parse_date_localized_dddd_mmmm_yyyy($schedule->start);
        $endDate=$this->dateRepository->parse_date_localized_dddd_mmmm_yyyy($schedule->end);
        $startHour=$startCaron->hour;
        $startMinute=$startCaron->minute<10 ? '00' : $startCaron->minute;

        $endHour=$endCarbon->hour;
        $endMinute=$endCarbon->minute <10 ? '00' : $endCarbon->minute;

        $message="Bonjour ".$user->firstname.". Nous vous confirmons votre désinscription à l'horaire suivant : Début :"
            . $startDate. " à ".$startHour."h".$startMinute.". Fin : ".$endDate ." à ".$endHour.'h'.$endMinute.'.';

        $mailer->send_standart_mail("Confirmation de désinscription",$message,$user->email);
    }


}
