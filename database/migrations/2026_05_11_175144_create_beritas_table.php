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
        Schema::create('beritas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignUuid('kategori_berita_id')->nullable()->constrained('kategori_beritas')->nullOnDelete();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->longText('konten')->nullable();
            $table->string('thumbnail')->nullable();
            $table->json('tags')->nullable();
            $table->string('status')->default('draft'); // draft, published, scheduled
            $table->timestamp('published_at')->nullable();
            $table->unsignedInteger('views_count')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->timestamps();

            $table->index(['status', 'published_at']);
            $table->index('is_featured');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beritas');
    }
};
