<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Sejarah timeline
        Schema::create('history_timelines', function (Blueprint $table) {
            $table->id();
            $table->string('year', 10);
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('image_alt')->nullable();
            $table->unsignedInteger('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Dokumen legalitas (akta, SK, NIB, NPWP, dll)
        Schema::create('legal_documents', function (Blueprint $table) {
            $table->id();
            $table->string('jenis'); // akta_pendirian | sk_kemenkumham | npwp | nib | izin_usaha | dll
            $table->string('label'); // Label tampil di frontend, misal "Akta Pendirian"
            $table->string('nomor')->nullable();
            $table->date('tanggal')->nullable();
            $table->string('notaris')->nullable();
            $table->string('file')->nullable();
            $table->string('keterangan')->nullable();
            $table->unsignedInteger('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // KBLI codes
        Schema::create('kbli_items', function (Blueprint $table) {
            $table->id();
            $table->string('kode_kbli', 20);
            $table->string('judul_kbli');
            $table->unsignedInteger('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kbli_items');
        Schema::dropIfExists('legal_documents');
        Schema::dropIfExists('history_timelines');
    }
};
