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
        Schema::table('cagar_budayas', function (Blueprint $table) {
            $table->foreignUuid('distrik_id')->nullable()->constrained('distrik')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cagar_budayas', function (Blueprint $table) {
            //
        });
    }
};
