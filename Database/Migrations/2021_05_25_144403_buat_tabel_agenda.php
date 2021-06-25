<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BuatTabelAgenda extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agenda', function (Blueprint $table) {
            $table->increments('id');

            $table->uuid('uuid');
            $table->string('judul');
            $table->string('slug')->unique();
            $table->string('waktu_awal')->nullable();
            $table->string('waktu_akhir')->nullable();
            $table->string('tempat')->nullable();
            $table->string('dihadiri_oleh')->nullable();
            $table->text('perihal')->nullable();

            $table->integer('id_operator')->nullable();
            $table->integer('komentar')->default(0);
            $table->integer('view')->default(0);

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
        Schema::dropIfExists('agenda');
    }
}
