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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->string('contract_number')->unique();
            $table->enum('party_type', ['cliente', 'fornecedor']);
            $table->unsignedBigInteger('party_id');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->enum('status', ['ativo', 'encerrado', 'pendente'])->default('pendente');
            $table->integer('value_in_cents')->nullable();
            $table->string('file_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
