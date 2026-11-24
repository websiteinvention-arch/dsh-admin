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
        Schema::create('entities', function (Blueprint $table) {
            $table->id();
             $table->unsignedBigInteger('website_id');

    $table->string('name');
    $table->string('slug')->unique();
    $table->text('description')->nullable();

    $table->tinyInteger('status')->default(1);

    $table->timestamps();

    // Foreign key (optional but recommended)
    $table->foreign('website_id')
        ->references('id')
        ->on('websites')
        ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entities');
    }
};
