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
        Schema::create('odcs', function (Blueprint $table) {
            $table->id('id_odc'); // Primary Key kustom sesuai pola project Anda
            $table->string('nama_odc'); // Contoh: ODC-KOTA-01
            $table->text('lokasi'); // Alamat atau deskripsi letak ODC
            $table->integer('kapasitas')->nullable(); // <-- TAMBAHKAN INI DI SINI
            $table->string('koordinat')->nullable(); // Titik koordinat GPS (latitude, longitude) jika diperlukan
            $table->text('keterangan')->nullable(); // Catatan tambahan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('odcs');
    }
};