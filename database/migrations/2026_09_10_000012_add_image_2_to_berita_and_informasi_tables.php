<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement('ALTER TABLE berita MODIFY image_2 LONGTEXT NULL');
        DB::statement('ALTER TABLE informasi MODIFY image_2 LONGTEXT NULL');

        Schema::table('berita', function (Blueprint $table) {
            if (! Schema::hasColumn('berita', 'image_2')) {
                $table->string('image_2')->nullable()->after('image');
            }
        });

        Schema::table('informasi', function (Blueprint $table) {
            if (! Schema::hasColumn('informasi', 'image_2')) {
                $table->string('image_2')->nullable()->after('image');
            }
        });
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE berita MODIFY image_2 VARCHAR(255) NULL');
        DB::statement('ALTER TABLE informasi MODIFY image_2 VARCHAR(255) NULL');

        Schema::table('berita', function (Blueprint $table) {
            if (Schema::hasColumn('berita', 'image_2')) {
                $table->dropColumn('image_2');
            }
        });

        Schema::table('informasi', function (Blueprint $table) {
            if (Schema::hasColumn('informasi', 'image_2')) {
                $table->dropColumn('image_2');
            }
        });
    }
};
