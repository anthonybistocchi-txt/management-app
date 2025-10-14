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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('email', 80);
            $table->string('phone', 20);
            $table->string('cpf', 14)->unique()->nullable();
            $table->string('cnpj', 20)->unique()->nullable();
            $table->string('city', 50);
            $table->string('state', 2);
            $table->string('address', 100);
            $table->boolean('is_customer')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
