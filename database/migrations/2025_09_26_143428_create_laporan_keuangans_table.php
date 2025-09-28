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
    Schema::create('laporan_keuangans', function (Blueprint $table) {
        $table->id();
        $table->date('tanggal'); // tanggal transaksi
        $table->string('deskripsi'); // keterangan transaksi
        $table->decimal('pemasukan', 15, 2)->default(0); // nominal pemasukan
        $table->decimal('pengeluaran', 15, 2)->default(0); // nominal pengeluaran
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_keuangans');
    }
};
