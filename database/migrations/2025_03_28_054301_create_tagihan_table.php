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
        Schema::create('tagihan', function (Blueprint $table) {
            $table->id('id_tagihan');
            $table->foreignId('id_pelanggan')->constrained('pelanggan','id_pelanggan')->onDelete('cascade');
            $table->year('periode_tahun')->notNull();
            $table->integer('periode_bulan')->notNull();
            $table->enum('status', ['lunas', 'pending','belum lunas'])->notNull();
            // $table->decimal('total_tagihan', 10, 2)->notNull();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tagihan');
    }
};
