<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableNotifies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifies', function (Blueprint $table) {
            $table->increments('id');
            $table->text('body');
            $table->string('type');
            $table->integer('from_request')->nullable();
            $table->integer('from_comment')->nullable();
            $table->integer('from_post')->nullable();
            $table->integer('from_like')->nullable();
            $table->integer('id_utente')->unsigned();
            $table->timestamps();
        });

        Schema::table('notifies', function(Blueprint $table) {
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
        Schema::dropIfExists('notifies');
    }
}