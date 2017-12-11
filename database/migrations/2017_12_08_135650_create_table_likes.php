<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableLikes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->integer('id_post')->unsigned()->nullable();
            $table->integer('id_commento')->unsigned()->nullable();
            $table->integer('id_utente')->unsigned();
            $table->timestamps();
        });

        Schema::table('likes', function (Blueprint $table) {
            $table->foreign('id_post')
                  ->references('id')->on('posts')
                  ->onUpdate('cascade');
            $table->foreign('id_commento')
                  ->references('id')->on('comments')
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
        Schema::dropIfExists('likes');
    }
}