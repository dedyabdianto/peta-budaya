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
        Schema::create('kategori_beritas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama_kategori');
            $table->string('warna', 20)->default('#1A362D');
            $table->string('icon', 50)->default('article');
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori_beritas');
    }
};
