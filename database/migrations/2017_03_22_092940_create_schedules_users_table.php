<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchedulesUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //


        Schema::create('schedule_user', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('fk_user')->unsigned();
            $table->integer('fk_schedule')->unsigned();

            $table->foreign('fk_user')->references('id')->on('users')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->foreign('fk_schedule')->references('id')->on('schedules')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });





    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('schedule_user', function(Blueprint $table) {
            $table->dropForeign('schedule_user_schedule_id_foreign');
            $table->dropForeign('schedule_user_user_id_foreign');
        });

        Schema::drop('schedule_user');

    }
}
