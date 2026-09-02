<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subsidiaries', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('slug')->unique();
            $table->string('logo')->nullable();
            $table->string('logo_alt')->nullable();
            $table->string('cover_image')->nullable();
            $table->string('cover_alt')->nullable();
            $table->text('deskripsi_singkat')->nullable();
            $table->longText('deskripsi_lengkap')->nullable();
            $table->date('tanggal_pendirian')->nullable();
            $table->string('no_akta')->nullable();
            $table->string('no_sk_kemenkumham')->nullable();
            $table->text('alamat')->nullable();
            $table->string('website_url')->nullable(); // nullable → tampilkan modal jika null
            $table->string('instagram')->nullable();
            $table->string('tiktok')->nullable();
            $table->string('youtube')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('email')->nullable();
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('order')->default(0);
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->timestamps();
        });

        Schema::create('subsidiary_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subsidiary_id')->constrained('subsidiaries')->cascadeOnDelete();
            $table->string('nama_layanan');
            $table->string('icon')->nullable();
            $table->unsignedInteger('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subsidiary_services');
        Schema::dropIfExists('subsidiaries');
    }
};
