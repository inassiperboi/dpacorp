<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Singleton visi
        Schema::create('visions', function (Blueprint $table) {
            $table->id();
            $table->text('isi_visi');
            $table->timestamps();
        });

        // Poin-poin misi (sortable)
        Schema::create('mission_points', function (Blueprint $table) {
            $table->id();
            $table->text('isi_misi');
            $table->unsignedInteger('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mission_points');
        Schema::dropIfExists('visions');
    }
};
