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
<<<<<<<< HEAD:database/migrations/2025_10_21_220207_create_reasons_table.php
        Schema::create('reasons', function (Blueprint $table) {
            $table->id();
            $table->string('reason', 100);
            $table->timestamps();
========
        Schema::create('type_user', function (Blueprint $table) {
            $table->id();
            $table->string('name');
>>>>>>>> eea00e57d13243300d71da2bb236a01c54c44eaa:database/migrations/2025_10_20_023656_add_type_user_table.php
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
<<<<<<<< HEAD:database/migrations/2025_10_21_220207_create_reasons_table.php
      Schema::dropIfExists('reasons');
========
        //
>>>>>>>> eea00e57d13243300d71da2bb236a01c54c44eaa:database/migrations/2025_10_20_023656_add_type_user_table.php
    }
};
