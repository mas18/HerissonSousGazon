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
            $table->integer('event_id')->unsigned();
            $table->integer('room_id')->unsigned();
			$table->timestamps();
            //relationship

            $table->foreign('event_id')
                ->references('id')
                ->on('events')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->foreign('room_id')
                ->references('id')
                ->on('rooms')
                ->onDelete('restrict')
                ->onUpdate('restrict');



        });
	}

	public function down()
	{

        Schema::drop('schedules');
	}
}