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
        Schema::create('cagar_budayas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('kategori_budaya_id')->constrained('kategori_budayas')->onDelete('restrict');
            $table->foreignUuid('user_id')->constrained('users')->onDelete('restrict');
            $table->string('nama_cagar_budaya');
            $table->text('deskripsi')->nullable();
            $table->string('alamat')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('sk_penetapan')->nullable();
            $table->year('tahun_penemuan')->nullable();
            $table->string('status_pelestarian')->nullable();
            $table->enum('status',['draft', 'published'])->default('draft');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cagar_budayas');
    }
};
