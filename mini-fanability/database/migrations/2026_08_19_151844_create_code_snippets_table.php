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
        Schema::create('code_snippets', function (Blueprint $table) {
            $table->id();
            // Website this snippet belongs to
            $table->unsignedBigInteger('website_id');

            // Snippet details
            $table->string('name');
            $table->string('slug');

            // Actual HTML / Blade / CSS / JS code
            $table->longText('code');

            // Relationship with websites
            $table->foreign('website_id')
                ->references('id')
                ->on('websites')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('code_snippets');
    }
};
