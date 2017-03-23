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
            $table->integer('fk_event')->unsigned();
            $table->integer('fk_room')->unsigned();
			$table->timestamps();
            //relationship

            $table->foreign('fk_event')
                ->references('id')
                ->on('events')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->foreign('fk_room')
                ->references('id')
                ->on('rooms')
                ->onDelete('restrict')
                ->onUpdate('restrict');



        });
	}

	public function down()
	{
        Schema::table('schedules', function(Blueprint $table) {
            $table->dropForeign('posts_user_id_foreign');
        });


        Schema::drop('schedules');
	}
}