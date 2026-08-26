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
        Schema::create('odps', function (Blueprint $table) {
            $table->id('id_odp'); // Primary Key ODP
            $table->unsignedBigInteger('id_odc'); // Relasi ke tabel odcs
            $table->string('nama_odp'); // Contoh: ODP-KOTA-01
            $table->text('lokasi'); // Lokasi atau titik tiang
            $table->integer('kapasitas')->default(8); // Kapasitas port (misal 8 atau 16)
            $table->text('keterangan')->nullable();
            $table->timestamps();

            // Menghubungkan foreign key ke tabel odcs
            $table->foreign('id_odc')->references('id_odc')->on('odcs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('odps');
    }
};