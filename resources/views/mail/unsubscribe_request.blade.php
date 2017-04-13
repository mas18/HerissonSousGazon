<?php ?>


<p>Vous avez reçu une demande de désinscription de la part de <strong>{{ $user->firstname }} {{ $user->lastname}}</strong>, qui veut se désinscrire du plage horaire suivant:</p>
<ul>
    <li>Endroit: {{ $schedule->rooms->name }}</li>
    <li>Horaire: {{ $schedule->start }} - {{ $schedule->finish }}</li>
</ul>

<div>
    <p><strong>Message du volontaire:</strong></p>
    <p>{{$content}}</p>
</div>

<div>

    <div><!--[if mso]>
        <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="http://localhost/herissonsousgazon/public/schedule/{{ $schedule->event_id }}/{{ $user->id }}/{{ $schedule->id }}" style="height:40px;v-text-anchor:middle;width:200px;" arcsize="10%" strokecolor="#1e3650" fillcolor="#009907">
            <w:anchorlock/>
            <center style="color:#ffffff;font-family:sans-serif;font-size:13px;font-weight:bold;">Accepter</center>
        </v:roundrect>
        <![endif]--><a href="http://localhost/herissonsousgazon/public/schedule/{{ $schedule->event_id }}/{{ $user->id }}/{{ $schedule->id }}"
                       style="background-color:#009907;border:1px solid #1e3650;border-radius:4px;color:#ffffff;display:inline-block;font-family:sans-serif;font-size:13px;font-weight:bold;line-height:40px;text-align:center;text-decoration:none;width:200px;-webkit-text-size-adjust:none;mso-hide:all;">Accepter!</a></div>
</div>

<div>
    <p><strong>Contact:</strong><br />{{ $user->tel }}<br />{{ $user->email }}</p>
</div>
