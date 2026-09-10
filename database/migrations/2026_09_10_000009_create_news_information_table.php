<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('news_information', function (Blueprint $table) {
            $table->id();
            $table->string('type', 20);
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('content');
            $table->text('summary');
            $table->string('image')->nullable();
            $table->string('country');
            $table->text('tags');
            $table->unsignedTinyInteger('listing')->default(2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('news_information');
    }
};
