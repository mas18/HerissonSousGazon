<?php

use Illuminate\Database\Seeder;

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

    }
}
