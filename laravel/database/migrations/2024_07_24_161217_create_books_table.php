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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("slug")->unique();
            $table->longText("description")->nullable();
            $table->string("author")->nullable();
            $table->date("date");
            $table->foreignId("books_category_id")
                ->nullable()
                ->constrained()
                ->nullOnDelete();
            $table->foreignId("user_id")->nullable()->index()->constrained()->OnDelete('cascade');
            $table->boolean("is_visible")->default(false);
            $table->string("photo")->nullable();
            $table->string("pdf")->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};