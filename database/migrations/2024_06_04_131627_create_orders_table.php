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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique(); // Unique order number
            $table->dateTime('order_date'); // Order date
            $table->dateTime('delivery_date')->nullable();; // Delivery date
            $table->unsignedBigInteger('customer_id'); // Customer ID from customers table
            $table->unsignedBigInteger('category_id'); // Laundry category ID from categories table
            $table->integer('quantity_kg'); // Quantity (kg)
            $table->integer('total_price'); // Total price
            $table->enum('status', ['queued', 'already paid', 'being picked up', 'being washed', 'being dried', 'being ironed', 'delivered', 'completed']); // Status pesanan
            $table->softDeletes();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
