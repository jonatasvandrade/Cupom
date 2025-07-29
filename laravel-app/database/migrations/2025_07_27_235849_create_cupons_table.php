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
        Schema::create('cupons', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique(); // Ex: PROMO10
            $table->enum('tipo_desconto', ['fixo', 'percentual']);
            $table->decimal('valor_desconto', 8, 2);
            $table->integer('max_uso')->nullable(); // null = ilimitado
            $table->integer('usos')->default(0);
            $table->date('validade')->nullable();
            $table->boolean('ativo')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cupons');
    }
};
