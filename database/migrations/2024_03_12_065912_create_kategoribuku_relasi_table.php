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
        Schema::create('kategoribuku_relasi', function (Blueprint $table) {
            $table->unsignedBigInteger('bukuID');
            $table->unsignedBigInteger('kategoriID');
            $table->foreign('bukuID')->references('id')->on('buku')->onDelete('cascade');
            $table->foreign('kategoriID')->references('id')->on('kategoribuku')->onDelete('cascade');
            $table->primary(['bukuID', 'kategoriID']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategoribuku_relasi');
    }
};
