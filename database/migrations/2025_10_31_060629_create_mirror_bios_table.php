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
        Schema::create('mirror_bios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mirror_id')->constrained('mirrors');
            $table->text('description');
            $table->integer('order');
            $table->integer('unlock_streak');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mirror_bios');
    }
};
