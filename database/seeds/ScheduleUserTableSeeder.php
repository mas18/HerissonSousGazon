<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
class ScheduleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('schedule_user')->delete();
        DB::table('schedule_user')->truncate();

        for ($k=0;$k<100;$k++)
        {

            // ScheduleSeeder
            $day=rand(1,28);
            $month=rand(1,12);
            DB::table('schedule_user')->insert([
                'user_id' => rand(1,20),
                'schedule_id' => rand(1,20),
            ]);
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
