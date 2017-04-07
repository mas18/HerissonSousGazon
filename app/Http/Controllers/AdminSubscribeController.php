<?php

namespace App\Http\Controllers;

use App\Repository\UserRepository;
use Illuminate\Http\Request;

class AdminSubscribeController extends Controller
{
    public $repository;

    public function __construct(UserRepository $repository)
    {
        $this->middleware('admin');
        $this->repository=$repository;
    }

    //
    public function sendUserListofSchedule($id_schedule="")
    {


        $userSubscribedList=$this->repository->findUserWithSubscibedID($id_schedule);

        $arrayID=array();
        foreach ($userSubscribedList as $aUser)
        {
            array_push($arrayID,$aUser->id);
        }

        $userNotInList=$this->repository->findUserWhereIdIsNot($arrayID);

       $response=array($userSubscribedList,$userNotInList);







        return response()->json($response);
    }
}
