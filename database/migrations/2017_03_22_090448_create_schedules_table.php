<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSchedulesTable extends Migration {

	public function up()
	{
		Schema::create('schedules', function(Blueprint $table) {
			$table->increments('id');
			$table->smallInteger('places')->default('1');
			$table->softDeletes();
			$table->datetime('start');
			$table->datetime('finish');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('schedules');
	}
}