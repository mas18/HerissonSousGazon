<?php

namespace App\Http\Controllers;

use App\Repository\ExportRepository;
use App\Repository\UserRepository;
use Illuminate\Http\Request;

class ExportController extends Controller
{

   private $exportRepository;
    private $userRepository;

    public function __construct(ExportRepository $exportRepository, UserRepository $userRepository)
    {


        $this->middleware('admin');
        $this->userRepository=$userRepository;
        $this->exportRepository=$exportRepository;
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
}
