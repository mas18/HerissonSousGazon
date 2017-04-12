<?php
/**
 * Created by PhpStorm.
 * User: teuft
 * Date: 12.04.2017
 * Time: 10:29
 */

namespace App\Mailer;


use Illuminate\Support\Facades\Mail;

class Mailer
{

    private  $sender='isaline.bruchez@gmail.com';



    public function sendMailToSubscribed($title,$content, $receiver)
    {
        $data = array( 'title' => $title, 'content' => $content );

        Mail::send('mail.subscrib_confirm', $data, function ($message) use ($receiver, $title) {
            $message->from($this->sender, 'Herrisson sous gazon');

            $message->to($receiver)->subject($title);
        });

    }


    public function sendstandartMail($title,$content, $receiver)
    {
        $data = array( 'title' => $title, 'content' => $content );

        Mail::send('mail.subscrib_confirm', $data, function ($message) use ($receiver, $title) {
            $message->from($this->sender, 'Herrisson sous gazon');

            $message->to($receiver)->subject($title);
        });

    }





}