<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InitDb extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function(Blueprint $table){
            $table->increments('id');
            $table->string('username',30)->unique();
            $table->string('password', 100);
            $table->string('nama', 50);
            $table->enum('level',['admin','user'])->default('user');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('wisata', function(Blueprint $table){
            $table->increments('id');
            $table->string('nama', 50);
            $table->text('alamat');
            $table->enum('jenis_kelamin',['L','P']);
            $table->date('tgl_lahir');
            $table->string('telp',20);
            $table->timestamps();
        });

        Schema::create('kriteria', function(Blueprint $table){
            $table->increments('id');
            $table->string('nama', 50);
            $table->enum('atribut', ['benefit', 'cost']);
            $table->double('bobot');
            $table->text('description');
            $table->timestamps();
        });

        Schema::create('nilai', function(Blueprint $table){
            $table->increments('id');
            $table->integer('wisata_id')->unsigned();
            $table->integer('kriteria_id')->unsigned();
            $table->double('nilai');
            $table->timestamps();
        });

        Schema::table('nilai', function(Blueprint $table){
            $table->foreign('wisata_id')->references('id')->on('wisata')->onDelete('cascade');;
            $table->foreign('kriteria_id')->references('id')->on('kriteria')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('nilai');
        Schema::drop('kriteria');
        Schema::drop('wisata');
        Schema::drop('users');
    }
}
