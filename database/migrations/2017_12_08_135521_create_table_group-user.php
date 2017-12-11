<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableGroupUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups-users', function (Blueprint $table) {
            $table->integer('id_gruppo')->unsigned();
            $table->integer('id_utente')->unsigned();
            $table->timestamps();
        });

        Schema::table('groups-users', function (Blueprint $table) {
            $table->foreign('id_gruppo')
                  ->references('id')->on('groups')
                  ->onUpdate('cascade');
            $table->foreign('id_utente')
                  ->references('id')->on('users')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('groups-users');
    }
}