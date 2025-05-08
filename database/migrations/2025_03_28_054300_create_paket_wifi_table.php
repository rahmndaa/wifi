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
        Schema::create('paket_wifi', function (Blueprint $table) {
            $table->id('id_paket');
            $table->string('nama_paket')->notNull();
            $table->string('kecepatan')->notNull();
            $table->decimal('harga', 10, 2)->notNull();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paket_wifi');
    }
};
