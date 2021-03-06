<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserProfilRequest;
use App\Http\Requests\UserResetPasswordRequest;
use App\Repository\UserRepository;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use League\Flysystem\Exception;

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
       return  view ('profil.show_profil',['user'=>$user = Auth::user()]);
    }


    public function save(UserProfilRequest $request)
    {
        $id=Auth::user()->id;
        $this->userRepository->userUpdate($id,$request);
        return back()->withOk("l'utilisateur a été modifié.");
    }
    public function showresetpasswordform()
    {
        return view("profil.reset_password");
    }
    public function resetPassword(UserResetPasswordRequest $request)
    {
        try{
            $this->userRepository->updatePassword($request,Auth::user()->id);
            session(['pass_message'=>'Votre mot de passe à bien été modifié']);
        }
        catch(Exception $ex)
        {
           //error message

        }
        //All is good

        return redirect()->route('profil');
    }
}
