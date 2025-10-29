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
            $table->foreignId('related_location_id')->nullable()->constrained('products_locations')->nullOnDelete(); // origem/destino
            $table->enum('type', ['in', 'out', 'transfer', 'adjustment']);
            $table->integer('quantity'); // quantidade movimentada
            $table->bigInteger('previous_quantity')->nullable(); // saldo antes da operacao 
            $table->bigInteger('new_quantity')->nullable(); // saldo atual
            $table->string('reference')->nullable();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('location_id')->references('id')->on('products_locations')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sotck_movements');
    }
};
