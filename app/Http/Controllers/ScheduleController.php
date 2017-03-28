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
    public function datatables($number="")
    {
        $event = $this->eventRepository->getById(25);
        $dates = $this->scheduleRepository->getDates($event);
        return view('schedule.index_schedule')->with('dates', $dates);
    }
    //rendu de la table via Ajax en JSON
    public function scheduledata()
    {       // retourne l'objet sous forme de data table
        //on selectionne l'object que l'on veut retourner(model de la BDD)
        $schedule=Schedule::all();
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
            }) //on spécifie le filtre
            ->filterColumn('start', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(start,'%d/%m/%Y') LIKE ?", ["%$keyword%"]);
            })
            ->make(true);
    }
}
