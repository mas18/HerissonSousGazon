<?php

use Illuminate\Database\Seeder;
use App\Room;

class RoomTableSeeder extends Seeder {

	public function run()
	{
		DB::table('rooms')->delete();
        DB::table('rooms')->truncate();

		// RoomSeeders
		Room::create(array(
				'name' => aroom
			));
	}
}