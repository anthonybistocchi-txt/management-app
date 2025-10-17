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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id')->constrained('roles'); // Referencia a tabela 'roles'
            $table->string('name', 100);
            $table->string('email', 100)->unique();
            $table->timestamp('email_verified_at')->nullable(); // Padrão do Laravel, útil para confirmação de e-mail.
            $table->string('password'); // O tamanho padrão já é 255
            $table->rememberToken(); // Padrão do Laravel para a função "Lembrar de mim".
            $table->timestamps();
            $table->softDeletes(); // Coluna 'deleted_at' para exclusão suave.
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
