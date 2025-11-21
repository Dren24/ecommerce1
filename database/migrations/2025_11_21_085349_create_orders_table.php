<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            
            // foreign key to users table, cascade on delete
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            
            // order totals
            $table->decimal('grand_total', 10, 2)->nullable();
            $table->string('currency')->nullable()->default(null);
            
            // payment info
            $table->string('payment_method')->nullable();
            $table->string('payment_status')->nullable();
            
            // shipping info
            $table->decimal('shipping_amount', 10, 2)->nullable();
            $table->string('shipping_method')->nullable();
            
            // order notes
            $table->text('notes')->nullable();
            
            // order status
            $table->enum('status', ['new','processing','shipped','delivered','canceled'])->default('new');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
