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
        Schema::create('pendapatan_harians', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->foreignId('karyawan_id')->constrained('karyawans')->onDelete('cascade');
            $table->foreignId('toko_id')->constrained('tokos')->onDelete('cascade');
            $table->integer('sesi');
            $table->dateTime('jam_mulai');
            $table->dateTime('jam_selesai');
            $table->integer('jumlah_like');
            $table->integer('jumlah_komentar');
            $table->integer('jumlah_ditonton');
            $table->decimal('jumlah_penjualan', 20,places: 2)->default(0);
            $table->mediumText('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendapatan_harians');
    }
};
