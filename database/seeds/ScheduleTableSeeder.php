<?php

use Illuminate\Database\Seeder;
use App\Schedule;

class ScheduleTableSeeder extends Seeder {

	public function run()
	{
		DB::table('schedules')->delete();
        DB::table('schedules')->truncate();

		// ScheduleSeeder
		Schedule::create(array(
				'places' => 2,
				'start' => 2017-05-05,
				'finish' => 2017-05-07
			));
	}
}