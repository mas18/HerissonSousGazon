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

    public function sendMailUnsubscribe($title, $receiver, $user, $schedule)
    {
        $data = array( 'title' => $title, 'user' => $user, 'schedule' => $schedule );

        Mail::send('mail.unsubscribe', $data, function ($message) use ($receiver, $title) {
            $message->from($this->sender, 'Herrisson sous gazon');

            $message->to($receiver)->subject($title);
        });

    }

    public function sendMailUnsubscribeRequest($title, $content, $receiver, $user, $schedule)
    {
        $data = array( 'title' => $title, 'content' => $content, 'user' => $user, 'schedule' => $schedule );

        Mail::send('mail.unsubscribe_request', $data, function ($message) use ($receiver, $title) {
            $message->from($this->sender, 'Herrisson sous gazon');

            $message->to($receiver)->subject($title);
        });

    }


    public function send_standart_mail($title, $content, $receiver)
    {
        $data = array( 'title' => $title, 'content' => $content );

        Mail::send('mail.subscrib_confirm', $data, function ($message) use ($receiver, $title) {
            $message->from($this->sender, 'Herrisson sous gazon');

            $message->to($receiver)->subject($title);
        });
    }
    public function send_updated_mail($title, $message,$oldSchedule,$newSchedule, $receiver)
    {
        $data = array( 'title' => $title, 'message' => $message,'oldSchedule'=>$oldSchedule,'newSchedule'=>$newSchedule);

        Mail::send('mail.updated_schedule', $data, function ($message) use ($receiver, $title) {
            $message->from($this->sender, 'Herrisson sous gazon');

            $message->to($receiver)->subject($title);
        });
    }



}