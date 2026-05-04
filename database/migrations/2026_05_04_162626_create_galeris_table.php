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
        Schema::create('galeris', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('cagar_budaya_id')->nullable()->constrained('cagar_budayas')->onDelete('set null');
            $table->foreignUuid('user_id')->constrained('users')->onDelete('restrict');
            $table->string('judul');
            $table->string('file_path');
            $table->string('file_type')->default('image');
            $table->unsignedBigInteger('file_size')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galeris');
    }
};
