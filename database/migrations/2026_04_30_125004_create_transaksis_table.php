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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();

            $table->foreignId('member_id')->constrained();
            $table->foreignId('user_id')->constrained();

            $table->date('tgl');
            $table->date('batas_waktu');

            $table->double('total');

            $table->enum('status', [
                'baru',
                'proses',
                'selesai',
                'diambil'
            ]);

            $table->enum('dibayar', [
                'dibayar',
                'belum_dibayar'
            ]);

            $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
