<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateActionLogsTable extends Migration
{
    public function up()
    {
        Schema::create('action_logs', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->string('url');
            $table->string('route')->index();
            $table->string('method');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('action_logs');
    }
}
