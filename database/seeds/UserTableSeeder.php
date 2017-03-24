<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder {

	public function run()
	{
		DB::table('users')->delete();
       // DB::table('users')->truncate();

		// 'UserSeeder'


        User::create(array(
            'email' => 'user@user.com',
            'firstname' => 'aFirstName',
            'lastname' => 'aLastName',
            'password' => bcrypt('password'),
            'street' => 'Rue de la rue 32 ',
            'tel' => '027 455 32 31 ',
            'city'=>'3980 grone',
            'comment' => 'Veut faire des trucs bien.',
        ));

        for ($k=0;$k<20;$k++)
        {
            User::create(array(
                    'email' => 'email@email.com'.$k,
                    'firstname' => 'aFirstName'.$k,
                    'lastname' => 'aLastName'.$k,
                    'password' => bcrypt('password'),
                    'street' => 'Rue de la rue 32 ',
                    'tel' => '027 455 32 31 ',
                    'city'=>'3980 grone',
                    'comment' => 'Veut faire des trucs bien.'.$k
                ));
        }
	}
}