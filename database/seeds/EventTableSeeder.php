<?php

use Illuminate\Database\Seeder;
use \App\Event;
use \Carbon\Carbon;

class EventTableSeeder extends Seeder {

	public function run()
	{
		DB::table('events')->delete();
        DB::table('events')->truncate();

        for ($k=0;$k<2;$k++)
        {
            // event1
            Event::create(array(
                'starting' => $this->beginDate(),
                'ending' => $this->endDate(),
            ));
        }

	}
	public function beginDate()
    {
        return Carbon::createFromDate(null, rand(1, 6), rand(1, 28));
    }
    public function endDate()
    {
        return Carbon::createFromDate(null, rand(7, 12), rand(1, 28));
    }
}