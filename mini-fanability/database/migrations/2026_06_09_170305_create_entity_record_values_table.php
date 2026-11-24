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
        Schema::create('entity_record_values', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('entity_record_id');
    $table->unsignedBigInteger('entity_field_id');

    $table->longText('value')->nullable();

    $table->timestamps();

    $table->foreign('entity_record_id')
        ->references('id')
        ->on('entity_records')
        ->onDelete('cascade');

    $table->foreign('entity_field_id')
        ->references('id')
        ->on('entity_fields')
        ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entity_record_values');
    }
};
