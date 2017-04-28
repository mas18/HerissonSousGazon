<?php

use Illuminate\Database\Seeder;
use App\User;
use \Carbon\Carbon;

class UserTableSeeder extends Seeder {

	public function run()
	{
		DB::table('users')->delete();
        DB::table('users')->truncate();

		// 'UserSeeder'


        User::create(array(
            'email' => 'clothrie@gmail.com',
            'firstname' => 'Clothilde',
            'lastname' => 'Rieille',
            'password' => bcrypt('password'),
            'street' => 'Avenue du Bietschhorn 33',
            'tel' => '079 455 32 31 ',
            'city'=>'1950 Sion',
            'birth' => Carbon::createFromDate(1994, 6, 1),
            'level'=>1
,            'comment' => 'Aucun',
        ));

        User::create(array(
            'email' => 'teufteuf@windowslive.com',
            'firstname' => 'Christophe',
            'lastname' => 'Crettenand',
            'password' => bcrypt('password'),
            'street' => 'Rue du Manege 13',
            'tel' => '079 455 32 31 ',
            'city'=>'3960 Grone',
            'birth' => Carbon::createFromDate(1992, 1, 15),
            'level'=>1
        ,   'comment' => 'Aucun',
        ));

        User::create(array(
            'email' => 'sandromathier@hotmail.com',
            'firstname' => 'Sandro',
            'lastname' => 'Mathier',
            'password' => bcrypt('password'),
            'street' => 'Rue de Salgesh 33',
            'tel' => '079 458 32 31 ',
            'city'=>'3960 Salgesh',
            'birth' => Carbon::createFromDate(1992, 1, 10),
            'level'=>0
        ,   'comment' => 'Aucun',
        ));



        User::create(array(
            'email' => 'isaline.bruchez@gmail.com',
            'firstname' => 'Isaline',
            'lastname' => 'Burchez',
            'password' => bcrypt('herissonpassword'),
            'street' => 'Rue de Sion 21',
            'tel' => '079 458 32 31 ',
            'city'=>'1921 Martigny',
            'birth' => Carbon::createFromDate(1980, 3, 10),
            'level'=>0
        ,   'comment' => 'Aucun',
        ));





	}
}