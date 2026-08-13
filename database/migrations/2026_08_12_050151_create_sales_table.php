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
        Schema::create('sales', function (Blueprint $table) {
            $table->id('sale_id');
            $table->foreignId('customer_id')
                ->nullable()
                ->constrained('customers', 'customer_id')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->foreignId('user_id')
                ->constrained('users', 'user_id')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->foreignId('product_id')
                ->constrained('products', 'product_id')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->date('sale_date');
            $table->decimal('discount', 10, 2);
            $table->decimal('sub_total_dollar', 10, 2);
            $table->decimal('grand_total_dollar', 10, 2);
            $table->decimal('sub_total_riel', 10, 2);
            $table->decimal('grand_total_riel', 10, 2);
            $table->decimal('cash_receive', 10, 2);
            $table->decimal('cash_return', 10, 2);
            $table->decimal('exchange_rate', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
