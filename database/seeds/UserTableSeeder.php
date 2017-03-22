<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder {

	public function run()
	{
		DB::table('users')->delete();
        DB::table('users')->truncate();

		// 'UserSeeder'
		User::create(array(
				'email' => 'email@email.com',
				'firstname' => 'aFirstName',
				'lastname' => 'aLastName',
				'password' => 'password',
				'street' => 'Rue de la rue 32',
				'tel' => '027 455 32 31',
				'comment' => 'Veut faire des trucs bien'
			));
	}
}