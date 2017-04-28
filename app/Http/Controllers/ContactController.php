<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateContactRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ContactController extends Controller
{
    //
    private $path;
    public function __construct()
    {
        $this->path="contact_informations";
        $this->middleware('admin')->only('update');

    }

    public function index()
    {
        $contact=explode(';',File::get($this->path));
        $mail=$contact[0];
        $tel=$contact[1];


        return view('contact.contact',['mail'=>$mail,'tel'=>$tel]);
    }
    public function update(UpdateContactRequest $request)
    {

        $contact=$request['email'] .";".$request['tel'];


        File::put($this->path,$contact);



        return back();
    }
}
