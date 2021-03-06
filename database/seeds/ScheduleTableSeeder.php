<?php

use Illuminate\Database\Seeder;
use App\Schedule;
use Carbon\Carbon;

class ScheduleTableSeeder extends Seeder {

	public function run()
	{
		DB::table('schedules')->delete();
        DB::table('schedules')->truncate();


        for ($k=0;$k<10;$k++)
        {

            // ScheduleSeeder
            $day=rand(10,11);
            $month=6;
            Schedule::create(array(
                'places' => 2,
                'start' => $this->beginDate($day,$month),
                'finish' => $this->endDate($day,$month),
                'event_id'=>1,
                'room_id'=>rand(1,6),
            ));
        }

	}
    public function beginDate($day,$mouth)
    {
        $date = Carbon::create(2017, $mouth, $day, rand(8,12), rand(1,60), rand(1,60));
        return   $date->format('Y-m-d H:i:s');
    }
    public function endDate($day,$mounth)
    {
        $date = Carbon::create(2017, $mounth ,$day , rand(12,22), rand(1,60), rand(1,60));
        return   $date->format('Y-m-d H:i:s');
    }
}