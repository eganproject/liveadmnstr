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
        Schema::table('pendapatan_harians', function (Blueprint $table) {
            $table->time('jam_mulai')->change();
            $table->time('jam_selesai')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pendapatan_harians', function (Blueprint $table) {
            $table->dateTime('jam_mulai')->change();
            $table->dateTime('jam_selesai')->change();
        });
    }
};