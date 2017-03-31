<?php

namespace App\Http\Controllers;

use App\Repository\ScheduleRepository;
use App\Repository\EventRepository;
use App\Schedule;
use App\Room;
use Illuminate\Http\Request;
use App\Http\Requests\ScheduleRequest;
//use datatables
use Tests\Unit\scheduleTest;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;


class ScheduleController extends Controller
{
    protected $scheduleRepository;
    protected $eventRepository;

    public function __construct(ScheduleRepository $scheduleRepository, EventRepository $eventRepository)
    {
       $this->scheduleRepository=$scheduleRepository;
       $this->eventRepository=$eventRepository;
    }

    //
    // affichage de la view
    public function datatables($number)
    {
        $event = $this->eventRepository->getById($number);
        $dates = $this->scheduleRepository->getDates($event);
        $rooms = Room::all();
        return view('schedule.index_schedule')->with('dates', $dates)->with('event', $event)->with('rooms', $rooms);
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
                return count($schedule->users);
            })

            ->editColumn('start', function ($schedule) {
                $carbonDate =new Carbon($schedule->start);
                return [
                    'display' => e(//on spécifie l'affichange
                       $schedule->start=Carbon::parse($schedule->start)->format('  d/m/Y  -  H:i')
                    ), //on spécifie comment sera ordonner nos datas
                    'timestamp' =>  $carbonDate->timestamp
                ];
            })
            ->editColumn('finish', function ($schedule) {
                $carbonDate =new Carbon($schedule->finish);
                return [
                    'display' => e(
                        $schedule->finish=Carbon::parse($schedule->finish)->format('  d/m/Y  -  H:i')
                    ),
                    'timestamp' =>  $carbonDate->timestamp
                ];
            })
            //relation
                ->editColumn('users',  function ($schedule) {
                //prepare what we want to show to the in the grid
                $arrayUser=$schedule->users;
                $arrayString=array();
                foreach ($arrayUser as $aUser)
                {
                    array_push($arrayString,$aUser->lastname.' '.$aUser->firstname);
                }
                sort($arrayString);
              $stringUser=  implode(' / ',$arrayString);

                    return [
                        'display'=>e(
                            $stringUser
                        ),
                        'alpha'=> $stringUser
                    ];

            })
            ->editColumn('rooms',  function ($schedule) {
                //prepare what we want to show to the in the grid

                return [
                    'display'=>e(
                       $schedule->rooms->name
                    ),
                    'alpha'=> $schedule->rooms->name
                ];

            })
            ->addColumn('rooms', function ($schedule) {
                return $schedule->rooms->name;
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

        /*$event = $this->eventRepository->store($request->all());

        if($request->get('copy')){
            $lastEvent = $this->eventRepository->getSecondLast();
            $this->scheduleRepository->copy($lastEvent, $event);
        }*/
        return redirect()->route('schedule.show', $request->eventId);
    }
}
