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

        for ($k=0;$k<30;$k++)
        {
            DB::table('schedule_user')->insert([
                'user_id' => rand(1,7),
                'schedule_id' => rand(1,20),
            ]);
        }


    }


}
