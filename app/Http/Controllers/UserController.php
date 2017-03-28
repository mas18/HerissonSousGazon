<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateAdmin;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateAdmin;
use App\Http\Requests\UserUpdateRequest;
use App\Repository\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $userRepository;
    protected $nbPerPage;

    public function __construct(UserRepository $userRepository)
    {

        $this->middleware('admin');

        $this->userRepository=$userRepository;
        $this->nbPerPage=10;
    }


    public function index()
    {
        //
        $users=$this->userRepository->getPaginate($this->nbPerPage);


        $links=$users->render();
        return view('user/index_user',compact('users','links'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view ('user/create_user');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateAdmin $request)
    {
        //
        $user=$this->userRepository->store($request->all());
        return redirect('user')->withOk("l'utilisateur".$user->lastname."a été créer");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $user=$this->userRepository->getById($id);
        return view('user/show_user',compact('user'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user = $this->userRepository->getById($id);
        return view('user/edit_user',  compact('user'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateAdmin $request, $id)
    {
        //
        $this->userRepository->update($id,$request->all());
        return redirect('user')->withOk("l'utilisateur".$request->input('lastname').'a àtà modifié');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $this->userRepository->destroy($id);
        return back();
    }

}
