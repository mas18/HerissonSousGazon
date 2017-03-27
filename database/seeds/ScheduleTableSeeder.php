<?php

use Illuminate\Database\Seeder;
use App\Schedule;
use Carbon\Carbon;

class ScheduleTableSeeder extends Seeder {

	public function run()
	{
		DB::table('schedules')->delete();
        DB::table('schedules')->truncate();


        for ($k=0;$k<20;$k++)
        {
            $date = Carbon::create(2015, 5, 28, 0, 0, 0);

            // ScheduleSeeder
            $day=rand(1,28);
            $month=rand(1,12);
            Schedule::create(array(
                'places' => 2,
                'start' => $this->beginDate($day,$month),
                'finish' => $this->endDate($day,$month),
                'event_id'=>rand(1,2),
                'room_id'=>rand(1,25),
            ));
        }

	}
    public function beginDate($day,$mouth)
    {

        $date = Carbon::create(2018, $mouth, $day, rand(0,12), rand(1,60), rand(1,60));
        return   $date->format('Y-m-d H:i:s');
    }
    public function endDate($day,$mounth)
    {
        $date = Carbon::create(2018, $mounth ,$day , rand(12,24), rand(1,60), rand(1,60));
        return   $date->format('Y-m-d H:i:s');
    }
}