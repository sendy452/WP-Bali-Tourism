<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddJarakUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jarak_users', function(Blueprint $table){
            $table->increments('id');
            $table->integer('wisata_id')->unsigned();
            $table->integer('kriteria_id')->unsigned();
            $table->double('jarak');
            $table->double('nilai');
            $table->integer('user_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('jarak_users', function(Blueprint $table){
            $table->foreign('wisata_id')->references('id')->on('wisata')->onDelete('cascade');;
            $table->foreign('kriteria_id')->references('id')->on('kriteria')->onDelete('cascade');;
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('jarak_users');
    }
}
