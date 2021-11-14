<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolePoliceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_police', function (Blueprint $table) {
            $table->id();
            $table->integer('role_id');
            $table->tinyInteger('data_siswa');
            $table->tinyInteger('data_fasilitas');
            $table->tinyInteger('data_sekolah');
            $table->tinyInteger('data_guru');
            $table->tinyInteger('role_permission');
            $table->tinyInteger('user');
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
        Schema::dropIfExists('role_police');
    }
}
