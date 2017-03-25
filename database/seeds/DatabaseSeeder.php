<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	public function run()
	{
		Model::unguard();

		$this->call('UserTableSeeder');
		$this->command->info('User table seeded!');

		$this->call('RoomTableSeeder');
		$this->command->info('Room table seeded!');

		$this->call('EventTableSeeder');
		$this->command->info('Event table seeded!');

		$this->call('ScheduleTableSeeder');
		$this->command->info('Schedule table seeded!');


        $this->call('ScheduleUserTableSeeder');
        $this->command->info('Schedule_user table seeded!');
	}
}