<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScheduleSubscribeUser;
use App\Mailer\Mailer;
use App\Repository\DateRepository;
use App\Repository\ScheduleRepository;
use App\Repository\EventRepository;
use App\Repository\UserRepository;
use App\Schedule;
use App\Room;
use Illuminate\Http\Request;
use App\Http\Requests\ScheduleRequest;
//use datatables
use Illuminate\Support\Facades\Auth;
use League\Flysystem\Exception;
use Tests\Unit\scheduleTest;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;


class ScheduleController extends Controller
{
    protected $scheduleRepository;
    protected $eventRepository;
    protected $userRepository;
    protected $dateRepository;
    protected $mailer;

    public function __construct(ScheduleRepository $scheduleRepository, EventRepository $eventRepository, UserRepository $userRepository, DateRepository $dateRepository,
Mailer $mailer)
    {

        //define the right of the user

       $this->middleware('admin', ['only'=>'datatables, scheduledata','index']);
       $this->middleware('auth');
       $this->scheduleRepository=$scheduleRepository;
       $this->eventRepository=$eventRepository;
       $this->userRepository=$userRepository;
       $this->dateRepository=$dateRepository;
       $this->mailer=$mailer;
    }

    public function subscribeuser($idschedule, $iduser, $request){

        $schedule=$this->ScheduleRepository->getById($idschedule);
        $user=$this->userReporitory->getById($iduser);

        //$this->scheduleRepository->subscribeuser($schedule,$user);

        return redirect()->route('schedule.show', $request->eventId)->withOk("l'utilisateur ".$user->lastname." a été ajouté");
    }

    //
    // affichage de la view
    public function datatables($number=-1)
    {
        $latest = $this->eventRepository->getLast()->id;

        if($number== -1){
            $number = $latest;
            return redirect()->route('schedule.show', $number);
        }

        if(Auth::user()->level<1 && $number !=$latest){
            $number = $latest;
            return redirect()->route('schedule.show', $number);
        }

        $users=$this->userRepository->getUsers();
        $event = $this->eventRepository->getById($number);
        $dates = $this->scheduleRepository->getDates($event);
        foreach($dates as $key => $d){
            $dates[$key] = $this->dateRepository->parseDate_d_m_y($d);
        }

        $rooms = Room::orderBy('name')->get();
        return view('schedule.index_schedule')->with('dates', $dates)->with('event', $event)->with('rooms', $rooms)->with('users',$users);
    }

    //rendu de la table via Ajax en JSON
    public function scheduledata(Request $request)
    {       // retourne l'objet sous forme de data table
        //on selectionne l'object que l'on veut retourner(model de la BDD)

        //--------------------------------------------------INIT THE PARAMS--------------------------------------------
        $event_id=1;
        if ( $request->get('event_id'))
             $event_id=$request->get('event_id');

        $schedule=$this->scheduleRepository->getAllWithRelation($event_id);



        //----------------------------------------------------------SPCECIFIE COLUMN------------------------------------

        //on spécifie si il y'a des changements a faire dahs les columns avec editColumn
        return Datatables::of($schedule)

            //ajouter une column
            ->addColumn('occuped', function ($schedule) {
                return ($schedule->places)-(count($schedule->users));
            })

            ->addColumn('action', function ($schedule) {
                //check if the user is already subscribed or not
                if (Auth::user()->level>0)
                    return null;

                return $this->format_column_action($schedule, $this);
            })

            ->addColumn('date', function ($schedule) {
                return $this->format_column_date($schedule);
            })

            ->addColumn('rooms', function ($schedule) {
                return $schedule->rooms->name;
            })

            // this will display the date of schedule
            ->addColumn('day',function($schedule)
            {
                return $this->format_column($schedule, $this);
            })

            ->editColumn('start', function ($schedule) {

                return $this->format_column_start($schedule);
            })

            ->editColumn('finish', function ($schedule) {

                return $this->format_column_finish($schedule);
            })

            //relation
                ->editColumn('users',  function ($schedule) {
                return $this->format_column_user($schedule);
            })

            ->editColumn('rooms',  function ($schedule) {
                return $this->format_column_rooms($schedule);
            })

            //on spécifie le filtre
            ->filterColumn('start', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(start,'%d/%m/%Y') LIKE ?", ["%$keyword%"]);
            })
            ->make(true);
    }

    public function store(ScheduleRequest $request)
    {

        if(isset($_POST["timeFrom"]) && is_array($_POST["timeFrom"])){
            foreach ($_POST["timeFrom"] as $key => $value){
                $timeFrom = $value;
                $timeTo = $_POST["timeTo"][$key];

                $this->scheduleRepository->store($request->all(), $timeFrom, $timeTo);
            }
        }
        return redirect()->route('schedule.show', $request->eventId);
    }

    public function edit(ScheduleRequest $request)
    {
        $oldSchedule=$this->scheduleRepository->getByIdWithUsers($request->scheduleId);

        $this->scheduleRepository->update($request->scheduleId, $request->all());

        //send the mail to users subscribed in the schedule
        try{
            //get the new schedule
            $newSchedule=$this->scheduleRepository->getById($oldSchedule->id);

            //get the mails of all users subscribed
            $mails=$oldSchedule->users->pluck('email')->toArray();
            //get the informations to send in the mails
            $number=$oldSchedule->id;
            $oldDate=$this->dateRepository->parse_date_localized_dddd_mmmm_yyyy($oldSchedule->start);
            $newDate=$this->dateRepository->parse_date_localized_dddd_mmmm_yyyy($newSchedule->start);

            $oldStart=$this->dateRepository->getHourOfDate($oldSchedule->start);
            $newStart=$this->dateRepository->getHourOfDate($newSchedule->start);

            $oldFinish=$this->dateRepository->getHourOfDate($oldSchedule->finish);
            $newFinish=$this->dateRepository->getHourOfDate($newSchedule->finish);


            $oldRoom=$oldSchedule->rooms->name;
            $newRoom=$newSchedule->rooms->name;

            for ($k=0;$k<count($mails);$k++)
            {
                if (!$mails[$k])
                unset($mails[$k]);
            }



            $messages="Une plage horaire dans laquelle vous êtes inscrit(e) à été modifiée par l'administrateur : 
             Numéro de la plage horaire : " .$number;


            $oldSchedule_information=
                " Anciennement :   "
            ."  Date : " .$oldDate
            ." ; Poste : ".$oldRoom
            ." ; Heure de départ : ".$oldStart
            ." ; Heure de fin : ".$oldFinish;

            $newSchedule_information=" Après modification :"
            ."  Date : " .$newDate
            ." ; Poste : ".$newRoom
            ." ; Heure de départ : ".$newStart
            ." ; Heure de fin : ".$newFinish;


            $this->send_mails_schedule_is_updated($mails,$messages,$oldSchedule_information,$newSchedule_information);
        }
        catch (Exception $ex)
        {
            echo $ex->getTrace();
        }



        return redirect()->route('schedule.show', $request->eventId);
    }

    public function destroy($id)
    {
        $this->scheduleRepository->destroy($id);
        return back();
    }


    public static function getSchedule($id)
    {
        return Schedule::find($id);
    }

    //-------------------------COLUMN FORMAT -------------------------------

    /**
     * @param $schedule
     * @param $accessor
     * @return string
     */
    function format_column_action($schedule, $accessor)
    {
        $userId = auth()->user()->id;
        $userIsSubscribed = $accessor->scheduleRepository->hasUserSchedule($schedule, $userId);

        $date = Carbon::parse($schedule->start);
        $now = Carbon::now();
        $diff = $now->diffInDays($date);

        $buttonColor = "btn-danger";
        $displayText = 'Desinscription';
        $disable = '';
        $element = "a";


        if (!$userIsSubscribed) {
            $buttonColor = "btn-primary";
            $displayText = 'Inscription';
            //disable button if the places are full
            if (count($schedule->users) >= $schedule->places) {
                $buttonColor = 'btn-primary disabled';
                $disable = 'disabled';
                $element = 'span';
            }
        } elseif ($diff < 22 || $date->lt($now)) {
            $buttonColor = "btn-danger disabled";
            $displayText = 'Desinscription';
            $disable = 'disabled';
            $element = 'span';
        }


        return '<' . $element . ' href="#inscription-' . $schedule->id . '" ' . $disable . ' class="btn btn-sm ' . $buttonColor . '">' . $displayText . '</' . $element . '>';
    }
    /**
     * @param $schedule
     * @return array
     */
    function format_column_start($schedule)
    {
        $carbonDate = new Carbon($schedule->start);
        return [
            'display' => e(//on spécifie l'affichange
                $this->dateRepository->parseTime_h_m($schedule->start)
            ), //on spécifie comment sera ordonner nos datas
            'timestamp' => $carbonDate->timestamp
        ];
    }
    /**
     * @param $schedule
     * @return array
     */
    function format_column_finish($schedule)
    {
        $carbonDate = new Carbon($schedule->finish);
        return [
            'display' => e(
               $this->dateRepository->parseTime_h_m($schedule->finish)
            ),
            'timestamp' => $carbonDate->timestamp
        ];
    }
    function format_column_date($schedule)
    {
        $carbonDate = new Carbon($schedule->start);
        return [
            'display' => e(//on spécifie l'affichange
                $this->dateRepository->parseDate_d_m_y($schedule->start)
            ), //on spécifie comment sera ordonner nos datas
            'timestamp' => $carbonDate->timestamp
        ];
    }

    /**
     * @param $schedule
     * @return array
     */
    function format_column_user($schedule)
    {
        //prepare what we want to show to the in the grid
        $arrayUser = $schedule->users;
        $arrayString = array();
        foreach ($arrayUser as $aUser) {
            array_push($arrayString, $aUser->lastname . ' ' . $aUser->firstname);
        }
        sort($arrayString);
        $stringUser = implode(' / ', $arrayString);

        return [
            'display' => e(
                $stringUser
            ),
            'alpha' => $stringUser
        ];
    }
    /**
     * @param $schedule
     * @return array
     */
    function format_column_rooms($schedule)
    {
//prepare what we want to show to the in the grid

        return [
            'display' => e(
                $schedule->rooms->name
            ),
            'alpha' => $schedule->rooms->name
        ];
    }
    private function getDayOfWeek($day)
    {
        switch ($day) {
            case 0:
                return  "Dimanche";
                break;
            case 1:
                return  "Lundi";
                break;
            case 2:
                return  "Mardi";
                break;
            case 3:
                return  "Mercredi";
                break;
            case 4:
                return  "Jeudi";
                break;
            case 5:
                return  "Vendredi";
                break;
            case 6:
                return  "Samedi";
                break;
        }
        return "Lundi";
    }
    function format_column($schedule, $accessor)
    {
        $carbonDate = new Carbon($schedule->start);
        $carbonDay = $carbonDate->dayOfWeek;
        $dayOfWeek = $accessor->getDayOfWeek($carbonDay);

        return [
            'display' => $dayOfWeek,
            'number' => $carbonDay
        ];
    }
    private function send_mails_schedule_is_updated($emails, $message,$oldSchedule,$newSchedule)
    {

        $this->mailer->send_updated_mail("Modification d'une plage horaire dont vous êtes inscrit(e)",$message,$oldSchedule,$newSchedule,$emails);
    }
}
