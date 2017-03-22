<?php

use Illuminate\Database\Seeder;
use \Event;

class EventTableSeeder extends Seeder {

	public function run()
	{
		DB::table('events')->delete();
        DB::table('events')->truncate();

		// event1
		Event::create(array(
				'starting' => 2017-05-05,
				'ending' => 2017-05-07
			));
	}
}