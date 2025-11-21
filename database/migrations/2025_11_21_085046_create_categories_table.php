<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // lowercase, no capital 'N'
            $table->string('slug')->unique(); // fixed arrow placement
            $table->string('image')->nullable(); // fixed arrow placement
            $table->boolean('is_active')->default(true); // fixed arrow placement
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
