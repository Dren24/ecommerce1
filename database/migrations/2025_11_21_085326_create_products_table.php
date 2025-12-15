<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->foreignId('brand_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('supplier_id')->nullable()->constrained()->nullOnDelete();

            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();

            $table->integer('quantity')->default(0);
            $table->integer('minimum_quantity')->default(1);

            $table->string('part_number')->nullable();
            $table->string('motorcycle_brand')->nullable();
            $table->string('fit_to_model')->nullable();

            $table->decimal('cost_price', 10, 2)->nullable();
            $table->decimal('selling_price', 10, 2);

            $table->string('image')->nullable();
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
