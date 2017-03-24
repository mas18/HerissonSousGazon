<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserProfilRequest;
use App\Repository\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    //

    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->middleware('auth');
        $this->userRepository=$userRepository;
    }
    public function display()
    {
       return  view ('profil\show_profil',['user'=>$user = Auth::user()]);
    }
    public function save(UserProfilRequest $request)
    {
        $id=Auth::user()->id;
        $this->userRepository->update($id,$request);
        return back();

    }
}
