<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gastos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->decimal('moradia', 10, 2)->nullable();
            $table->decimal('alimentacao', 10, 2)->nullable();
            $table->decimal('transporte', 10, 2)->nullable();
            $table->decimal('saude', 10, 2)->nullable();
            $table->decimal('assinaturas', 10, 2)->nullable();
            $table->decimal('lazer', 10, 2)->nullable();
            $table->decimal('educacao', 10, 2)->nullable();
            $table->decimal('investimento', 10, 2)->nullable();
            $table->decimal('outros', 10, 2)->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gastos');
    }
};
