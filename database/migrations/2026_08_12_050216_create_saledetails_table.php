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
        Schema::create('saledetails', function (Blueprint $table) {
            $table->id('saleDetail_id');
            $table->foreignId('sale_id')
                ->constrained('sales', 'sale_id')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->foreignId('product_id')
                ->constrained('products', 'product_id')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->integer('qty')->default(0);
            $table->decimal('price', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saledetails');
    }
};
