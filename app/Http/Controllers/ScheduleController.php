<?php

namespace App\Http\Controllers;

use App\Repository\ScheduleRepository;
use App\Schedule;
use Illuminate\Http\Request;
//use datatables
use Yajra\Datatables\Datatables;
use Carbon\Carbon;


class ScheduleController extends Controller
{
   // protected $scheduleRepository;

   // public function __construct(ScheduleRepository $scheduleRepository)
  //  {
     //   $this->scheduleRepository=$scheduleRepository;
  //  }

    //
    public function datatables()
    {
        return view('schedule.index_schedule');
    }
    public function scheduledata()
    {       // retourne l'objet sous forme de data table
        $schedule=Schedule::all();
        return Datatables::of($schedule)
            ->editColumn('start', function ($schedule) {
                $carbonDate =new Carbon($schedule->start);


                return [
                    'display' => e(
                       $schedule->start=Carbon::parse($schedule->start)->format('  d/m/Y  -  H:i')
                    ),
                    'timestamp' =>  $carbonDate->timestamp
                ];
            })
            ->filterColumn('start', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(start,'%d/%m/%Y') LIKE ?", ["%$keyword%"]);
            })
            ->make(true);
    }
}
