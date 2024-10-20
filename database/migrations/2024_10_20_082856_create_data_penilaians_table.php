<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('data_penilaians', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pegawai_id')->unsigned();
            $table->bigInteger('jumlah_hadir')->default(0);
            $table->bigInteger('jumlah_izin')->default(0);
            $table->bigInteger('jumlah_sakit')->default(0);
            // periode bulan dan tahun
            $table->string('periode')->default( date('Y-m') );
            $table->integer('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_penilaians');
    }
};
