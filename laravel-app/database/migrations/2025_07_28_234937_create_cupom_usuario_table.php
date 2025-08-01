<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cupom_usuario', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('cupom_id')->constrained('cupons')->onDelete('cascade');
            $table->integer('usos')->default(0);
            $table->timestamps();

            $table->unique(['usuario_id', 'cupom_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cupom_usuario');
    }
};
