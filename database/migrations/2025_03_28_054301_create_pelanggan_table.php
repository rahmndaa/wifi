<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up() {
        Schema::create('pelanggan', function (Blueprint $table) {
            $table->id('id_pelanggan');
            $table->foreignId('id_paket')->nullable()->constrained('paket_wifi','id_paket')->onDelete('cascade');
            $table->foreignId('id_odp')->nullable(); // Pastikan id_odp ada untuk relasi
            $table->string('nama_pelanggan');
            $table->string('paket')->nullable(); 
            $table->string('username')->nullable();
            $table->string('password')->nullable();
            $table->string('no_whatsapp')->nullable();
            $table->string('alamat')->nullable();
            $table->date('tanggal_gabung')->nullable();
            $table->enum('status_pelanggan', ['aktif', 'arsip'])->default('aktif');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelanggan');
    }
};