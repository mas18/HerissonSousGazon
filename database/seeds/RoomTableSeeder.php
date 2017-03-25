<?php

use Illuminate\Database\Seeder;
use App\Room;

class RoomTableSeeder extends Seeder {

	public function run()
	{
		DB::table('rooms')->delete();
        DB::table('rooms')->truncate();

		// RoomSeeders
        for($k=0;$k<25;$k++)
        {
            Room::create(array(
                'name' => 'aRooms'.$k
            ));
        }

	}
}