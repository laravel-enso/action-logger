<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateActionLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $usersClass = config('auth.providers.users.model');
        $usersTable = (new $usersClass())->getTable();

        Schema::create('action_logs', function (Blueprint $table) use ($usersTable) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on($usersTable)->onUpdate('cascade')->onDelete('cascade');
            $table->string('url');
            $table->string('route')->index();
            $table->string('action');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('action_logs');
    }
}
