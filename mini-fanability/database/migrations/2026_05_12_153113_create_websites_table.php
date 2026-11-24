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
        Schema::create('websites', function (Blueprint $table) {

    $table->id();

    // Client Details
    $table->string('client_name');

    // Project / Website Name
    $table->string('project_name');

    // Login Credentials
    $table->string('email')->unique();

    $table->string('password');

   
    // Notes / Details
    $table->text('description')->nullable();

    // Active / Inactive
    $table->tinyInteger('status')->default(1);

    // Remember Login
    $table->rememberToken();

    $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('websites');
    }
};
