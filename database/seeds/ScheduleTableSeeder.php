<?php

use Illuminate\Database\Seeder;
use App\Schedule;
use Carbon\Carbon;

class ScheduleTableSeeder extends Seeder {

	public function run()
	{
		DB::table('schedules')->delete();
        DB::table('schedules')->truncate();


        for ($k=0;$k<50;$k++)
        {
            $date = Carbon::create(2015, 5, 28, 0, 0, 0);

            // ScheduleSeeder
            Schedule::create(array(
                'places' => 2,
                'start' => $this->beginDate(),
                'finish' => $this->endDate(),
                'event_id'=>rand(1,2),
                'room_id'=>rand(1,25),
            ));
        }

	}
    public function beginDate()
    {

        return Carbon::today('Europe/London');
    }
    public function endDate()
    {
        $date = Carbon::create(2017, 5, 28, 0, 0, 0);
        return   $date->addWeeks(rand(1, 52))->format('Y-m-d H:i:s');
    }
}