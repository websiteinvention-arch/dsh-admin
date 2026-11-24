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
        Schema::create('website_settings', function (Blueprint $table) {
            
            $table->id();

            // Website this setting belongs to
            $table->unsignedBigInteger('website_id');

            // Website branding
            $table->string('logo')->nullable();
            $table->string('white_logo')->nullable();
            $table->string('favicon')->nullable();

            // Contact details
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();

            // Website URLs
            $table->string('domain')->nullable();
            $table->string('destination_url')->nullable();

            // Social media
            $table->string('youtube')->nullable();
            $table->string('instagram')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();

            $table->timestamps();

            // Relationship with websites
            $table->foreign('website_id')
                ->references('id')
                ->on('websites')
                ->onDelete('cascade');

            // One settings record per website
            $table->unique('website_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_settings');
    }
};
