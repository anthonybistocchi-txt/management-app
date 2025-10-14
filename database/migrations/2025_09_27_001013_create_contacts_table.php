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
    Schema::create('contact', function (Blueprint $table) {
        $table->id();
        $table->string('name', 50);
        $table->string('email', 80);
        $table->string('phone', 14); 
        $table->text('message');
        $table->boolean('is_user')->default(false);
        $table->bigInteger('user_id')->nullable()->unsigned();
        $table->bigInteger('reason_id')->nullable()->unsigned();
        
        $table->foreign('reason_id')->references('id')->on('reasons')->onDelete('set null');
        $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact');
    }
};
