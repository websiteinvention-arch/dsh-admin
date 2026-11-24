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
        Schema::create('pages', function (Blueprint $table) {
               $table->id();

        // Website this page belongs to
        $table->unsignedBigInteger('website_id');

        // Page details
        $table->string('page_name');
        $table->string('slug');

        // Content
        $table->longText('page_content')->nullable();

        // SEO
        $table->string('browser_title')->nullable();
        $table->text('meta_keywords')->nullable();
        $table->string('page_keyword')->nullable();
        $table->text('meta_description')->nullable();

        // Page image
        $table->string('page_image')->nullable();

        // Additional page fields
        $table->text('text_variable')->nullable();
        $table->longText('include_in_head')->nullable();
        $table->longText('include_in_footer')->nullable();

        // Template
        $table->string('template_file')->nullable();

        // Status
        $table->tinyInteger('status')->default(1);

        $table->timestamps();

        // Website relationship
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
        Schema::dropIfExists('pages');
    }
};
