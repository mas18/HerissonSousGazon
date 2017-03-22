<?php

use Illuminate\Database\Seeder;
use App\Schedule;
use Carbon\Carbon;

class ScheduleTableSeeder extends Seeder {

	public function run()
	{
		DB::table('schedules')->delete();
        DB::table('schedules')->truncate();

		// ScheduleSeeder
		Schedule::create(array(
				'places' => 2,
				'start' => $this->beginDate(),
				'finish' => $this->endDate(),
			));
	}
    public function beginDate()
    {
        return Carbon::today('Europe/London');
    }
    public function endDate()
    {
        return  Carbon::tomorrow('Europe/London');
    }
}