<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableConversationUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conversations_users', function (Blueprint $table) {
            $table->integer('id_utente')->unsigned();
            $table->integer('id_conversazione')->unsigned();
            $table->timestamps();
        });

        Schema::table('conversations_users', function (Blueprint $table) {
            $table->foreign('id_utente')
                  ->references('id')->on('users')
                  ->onUpdate('cascade');
            $table->foreign('id_conversazione')
                  ->references('id')->on('conversations')
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
        Schema::dropIfExists('conversations_users');
    }
}