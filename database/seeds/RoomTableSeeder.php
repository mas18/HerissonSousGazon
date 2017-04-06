<?php

use Illuminate\Database\Seeder;
use App\Room;

class RoomTableSeeder extends Seeder {

	public function run()
	{
		DB::table('rooms')->delete();
        DB::table('rooms')->truncate();

		// RoomSeeders
        Room::create(array('name'=>'bar Hérisson'));
        Room::create(array('name'=>'cuisine'));
        Room::create(array('name'=>'bar cuisine'));
        Room::create(array('name'=>'glaces'));
        Room::create(array('name'=>'grande salle'));
        Room::create(array('name'=>'chapiteau'));
        Room::create(array('name'=>'scène extérieure'));
        Room::create(array('name'=>'manège'));
        Room::create(array('name'=>'big air'));
        Room::create(array('name'=>'rangement'));
	}
}