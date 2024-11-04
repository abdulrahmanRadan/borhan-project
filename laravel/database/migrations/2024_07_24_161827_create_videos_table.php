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
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("slug")->unique();
            $table->longText("description")->nullable();
            $table->date("date");
            $table->boolean("is_visible")->default(false);
            $table->foreignId("user_id")->nullable()->index()->constrained()->nullOnDelete();
            $table->foreignId("category_id")->nullable()->on("categories")->nullOnDelete();
            $table->string('video')->require();
            // $table->enum("type", ['showable', 'downloadable'])->default('showable');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};