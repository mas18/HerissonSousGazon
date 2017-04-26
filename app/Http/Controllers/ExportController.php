<?php

namespace App\Http\Controllers;

use App\Repository\ExportRepository;
use App\Repository\UserRepository;
use App\Repository\ScheduleRepository;
use Illuminate\Http\Request;

class ExportController extends Controller
{

    private $exportRepository;
    private $userRepository;
    private $scheduleRepository;

    public function __construct(ExportRepository $exportRepository, UserRepository $userRepository, ScheduleRepository $scheduleRepository)
    {


        $this->middleware('admin');
        $this->userRepository=$userRepository;
        $this->exportRepository=$exportRepository;
        $this->scheduleRepository = $scheduleRepository;
    }

    //
    function exportAllUser()
    {
        $userList=$this->userRepository->getUsers();
        for ($k=0;$k<count($userList);$k++)
        {
            $userList[$k]->level==1 ?  $userList[$k]->level='Administrateur' : $userList[$k]->level='Membre';
        }

        $this->exportRepository->exportXLS($userList,'utilisateurs','utilisateurs');
    }

    function exportVolonteers($eventId)
    {
        $userList=$this->userRepository->getUsers();

        $users=$this->scheduleRepository->getVolonteers($eventId);

        $users = $users->pluck('id');

        $volunteers = $userList->whereIn('id', $users);

        foreach ($volunteers as $v) {
            $v->level==1 ?  $v->level='Administrateur' : $v->level='Membre';
        }

        $this->exportRepository->exportXLS($volunteers,'benevoles','liste_des_bénévoles');
    }
}
