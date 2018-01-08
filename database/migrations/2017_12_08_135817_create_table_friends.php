<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableFriends extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('friends', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_utente1')->unsigned();
            $table->integer('id_utente2')->unsigned();
            $table->integer('type');
            $table->timestamps();
        });

        Schema::table('friends', function (Blueprint $table) {
            $table->foreign('id_utente1')
                  ->references('id')->on('users')
                  ->onUpdate('cascade');
            $table->foreign('id_utente2')
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
        Schema:dropIfExist('friends');
    }
}