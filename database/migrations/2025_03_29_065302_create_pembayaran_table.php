<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up() {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id('id_pembayaran');
            $table->foreignId('id_tagihan')->constrained('tagihan', 'id_tagihan')->onDelete('cascade');
            $table->enum('metode_pembayaran', ['transfer', 'tunai'])->notNull();
            $table->string('bukti_transfer')->nullable();
            $table->timestamp('tanggal_bayar')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
