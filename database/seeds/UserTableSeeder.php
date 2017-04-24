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
            'email' => 'loriane_bussard@hotmail.com',
            'firstname' => 'Laurianne',
            'lastname' => 'Bussard',
            'password' => bcrypt('password'),
            'street' => 'chemin du Chalet-Mignon 3',
            'tel' => '079 455 32 31 ',
            'city'=>'1008 Prilly',
            'birth' => Carbon::createFromDate(1990, 7, 4),
            'level'=>0
        ,   'comment' => 'Aucun',
        ));

        User::create(array(
            'email' => 'fournier.sabine@bluewin.ch',
            'firstname' => 'Sabine',
            'lastname' => 'Fournier',
            'password' => bcrypt('password'),
            'street' => 'Petit Clos 1',
            'tel' => '079 455 32 31 ',
            'birth' => Carbon::createFromDate(1988, 10, 10),
            'city'=>'1904 Vernayaz',
            'level'=>0
        ,   'comment' => 'Aucun',
        ));

        User::create(array(
            'email' => 'philippe_pignat@netplus.ch',
            'firstname' => 'Philippe',
            'lastname' => 'Pignat ',
            'password' => bcrypt('password'),
            'street' => 'Av de la Gare 35',
            'tel' => '079 455 32 31 ',
            'city'=>'1906 charrat',
            'birth' => Carbon::createFromDate(1985, 3, 17),
            'level'=>0
        ,   'comment' => 'Aucun',
        ));

        User::create(array(
            'email' => 'Rita.pante@bluewin.ch',
            'firstname' => 'Rita',
            'lastname' => 'Pante ',
            'password' => bcrypt('password'),
            'street' => 'Rossettan 13',
            'tel' => '079 455 32 31 ',
            'city'=>'1920 martigny',
            'birth' => Carbon::createFromDate(1982, 4, 15),
            'level'=>0
        ,   'comment' => 'Aucun',
        ));

        User::create(array(
            'email' => 'gig_78@yahoo.fr',
            'firstname' => 'Michael',
            'lastname' => 'Gigon ',
            'password' => bcrypt('password'),
            'street' => 'Rue des Marronniers 30',
            'tel' => '079 455 32 31 ',
            'city'=>'1906 Charrat',
            'birth' => Carbon::createFromDate(1978, 10, 10),
            'level'=>0
        ,   'comment' => 'Aucun',
        ));

        User::create(array(
            'email' => 'olivier.bourgeois@novelis.com',
            'firstname' => 'Olivier',
            'lastname' => 'Bourgeois',
            'password' => bcrypt('password'),
            'street' => 'Rue jeu de quille 10',
            'tel' => '079 455 32 31 ',
            'city'=>'1906 Charrat',
            'birth' => Carbon::createFromDate(1988, 6, 12),
            'level'=>0
        ,   'comment' => 'Aucun',
        ));


	}
}