<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->restrictOnDelete();
            $table->foreignId('author_id')->constrained()->restrictOnDelete();
            $table->string('title');
            $table->string('isbn')->nullable()->unique();
            $table->text('description')->nullable();
            $table->unsignedSmallInteger('year')->nullable();
            $table->unsignedInteger('copies_total')->default(1);
            $table->unsignedInteger('copies_available')->default(1);
            $table->string('cover_image')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
