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
        Schema::create('vouchers', function (Blueprint $table) {
            // $table->id();
            $table->string('nama_pelatihan');
            $table->string('judul_voucher');
            $table->string('voucher',20)->primary();
            $table->integer('nilai_diskon');
            $table->timestamp('tgl_expired');
            $table->enum('status', ['issued', 'none'])->default('none');
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
        Schema::dropIfExists('vouchers');
    }
};
