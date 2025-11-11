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
        Schema::create('stock_movements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('location_id')->nullable();
            $table->unsignedBigInteger('provider_id')->nullable();
            $table->enum('type', ['in', 'out', 'transfer', 'adjustment']);
            $table->integer('quantity_moved'); // quantidade movimentada
            $table->bigInteger('quantity_before')->nullable(); // saldo antes da operacao 
            $table->bigInteger('quantity_after')->nullable(); // saldo atual
            $table->text('description')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->timestamps();
            $table->foreign('provider_id')->references('id')->on('providers')->onDelete('set null');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('location_id')->references('id')->on('products_locations')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_movements');
    }
};
