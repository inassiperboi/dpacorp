<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Singleton: satu baris untuk profil perusahaan
        Schema::create('company_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('nama_resmi');
            $table->string('nama_singkat')->nullable();
            $table->string('tagline')->nullable();
            $table->string('logo')->nullable();
            $table->string('logo_alt')->nullable();
            $table->string('favicon')->nullable();
            $table->text('alamat');
            $table->string('kota')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('kode_pos')->nullable();
            $table->string('telepon')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('email');
            $table->text('jam_operasional')->nullable();
            $table->decimal('lat', 10, 7)->nullable();
            $table->decimal('lng', 10, 7)->nullable();
            $table->string('instagram')->nullable();
            $table->string('tiktok')->nullable();
            $table->string('youtube')->nullable();
            $table->string('facebook')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('twitter')->nullable();
            $table->timestamps();
        });

        // Singleton: SEO global settings
        Schema::create('seo_settings', function (Blueprint $table) {
            $table->id();
            $table->string('default_meta_title')->nullable();
            $table->text('default_meta_description')->nullable();
            $table->string('og_default_image')->nullable();
            $table->string('google_site_verification')->nullable();
            $table->string('google_analytics_id')->nullable();
            $table->text('robots_txt_extra')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('company_profiles');
        Schema::dropIfExists('seo_settings');
    }
};
