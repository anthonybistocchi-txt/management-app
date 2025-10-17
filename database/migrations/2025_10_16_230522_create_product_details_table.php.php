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
        Schema::create('product_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->unique()->constrained('products')->onDelete('cascade');
            $table->foreignId('unit_of_measure_id')->constrained('units_of_measure');

            $table->string('color', 50)->nullable();
            $table->string('size', 20)->nullable();
            $table->string('material', 50)->nullable();
            $table->unsignedInteger('weight')->nullable(); // Armazenará o peso em gramas
            $table->unsignedInteger('height')->nullable(); // Armazenará a altura em milímetros
            $table->unsignedInteger('width')->nullable();  // Armazenará a largura em milímetros
            $table->unsignedInteger('length')->nullable(); // Armazenará o comprimento em milímetros
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
