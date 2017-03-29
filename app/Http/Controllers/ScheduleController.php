<?php

namespace App\Http\Controllers;

use App\Repository\ScheduleRepository;
use App\Repository\EventRepository;
use App\Schedule;
use Illuminate\Http\Request;
//use datatables
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
    public function datatables()
    {
        $event = $this->eventRepository->getById(1);
        $dates = $this->scheduleRepository->getDates($event);
        return view('schedule.index_schedule')->with('dates', $dates);
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


            //on spécifie le filtre
            ->filterColumn('start', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(start,'%d/%m/%Y') LIKE ?", ["%$keyword%"]);
            })
            ->make(true);
    }
}
