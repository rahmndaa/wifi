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
            $table->foreignId('id_paket')->constrained('paket_wifi','id_paket')->onDelete('cascade');
            $table->string('nama_pelanggan')->notNull();
            $table->string('username')->unique();
            $table->string('password')->notNull();
            $table->string('no_whatsapp')->notNull();
            $table->date('tanggal_gabung')->notNull();
            $table->enum('status_pelanggan', ['aktif', 'arsip'])->notNull();
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
