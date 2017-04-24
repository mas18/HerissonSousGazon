<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email', 80)->unique()->nullable();
            $table->string('firstname', 30);
            $table->string('lastname', 30);
            $table->string('password', 90);
            $table->string('street', 40);
            $table->string('city',40);
            $table->tinyInteger('level')->default('0');
            $table->string('tel', 20);
            $table->date('birth');
            $table->string('comment', 255)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->rememberToken();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
