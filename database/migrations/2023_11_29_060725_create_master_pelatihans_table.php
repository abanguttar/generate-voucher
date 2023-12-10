<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_pelatihans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pelatihan');
            $table->string('jadwal');
            $table->string('jam_pelatihan');
            // Define 'tipe' column with two options: daring and luring
            $table->enum('tipe', ['daring', 'luring']);
            $table->integer('harga_kelas');
            $table->enum('status', ['Y', 'N'])->default('Y');
            $table->timestamps();
            $table->integer('user_create');
            $table->integer('user_update');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_pelatihans');
    }
};
