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
        Schema::create('entity_fields', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('entity_id');

    $table->string('field_name');
    $table->string('field_type'); // text, number, file, textarea, select etc
    $table->tinyInteger('is_required')->default(0);
    $table->integer('sort_order')->default(0);

    $table->tinyInteger('status')->default(1);

    $table->timestamps();

    $table->foreign('entity_id')
        ->references('id')
        ->on('entities')
        ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entity_fields');
    }
};
