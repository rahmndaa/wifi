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
        Schema::create('komplain', function (Blueprint $table) {
            $table->id('id_komplain');
            $table->foreignId('id_pelanggan')->constrained('pelanggan','id_pelanggan')->onDelete('cascade');
            $table->text('deskripsi')->notNull();
            $table->date('tanggal_komplain')->notNull();
            $table->enum('status', ['menunggu', 'proses', 'selesai'])->notNull();
            $table->date('tanggal_komplain_selesai')->nullable();
            $table->string('bukti_komplain')->nullable();
            $table->text('balasan_admin')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('komplain');
    }
};
