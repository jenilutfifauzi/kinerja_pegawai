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
        Schema::table('data_penilaians', function (Blueprint $table) {
            $table->bigInteger('nilai_total_hadir')->default(0);
            $table->bigInteger('nilai_total_izin')->default(0);
            $table->bigInteger('nilai_total_sakit')->default(0);
            $table->bigInteger('nilai_total_pekerjaan_harian')->default(0);
            $table->bigInteger('nilai_total_pekerjaan_lembur')->default(0);
            $table->bigInteger('nilai_total')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_penilaians', function (Blueprint $table) {
            //
        });
    }
};
