<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cupom_user', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('cupom_id');
            $table->unsignedBigInteger('user_id');

            $table->timestamp('used_at')->nullable(); // quando o cupom foi usado

            // Garante que o mesmo usuário não use o mesmo cupom mais de uma vez
            $table->unique(['cupom_id', 'user_id']);

            // FK
            $table->foreign('cupom_id')->references('id')->on('cupons')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cupom_user');
    }
};
