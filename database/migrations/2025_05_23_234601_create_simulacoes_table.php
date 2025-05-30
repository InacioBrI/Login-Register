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
    Schema::create('simulacoes', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id');
        $table->string('tipo_contrato'); // CLT ou Estagiário
        $table->decimal('salario', 10, 2);
        $table->decimal('outras_rendas', 10, 2)->nullable();
        $table->decimal('total_gastos', 10, 2);
        $table->text('plano');
        $table->text('analise_gastos');
        $table->timestamp('data_hora');
        $table->timestamps();

        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('simulacoes');
    }
};
