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
        Schema::create('stuff_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale')->index();
            $table->string('name')->nullable();
            $table->text('title')->nullable();
            $table->text('description')->nullable();
            $table->unique(['stuff_id', 'locale']);
            $table->unsignedBigInteger('stuff_id')->nullable();
            $table->foreign('stuff_id')->references('id')->on('stuffs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stuff_translations');
    }
};
