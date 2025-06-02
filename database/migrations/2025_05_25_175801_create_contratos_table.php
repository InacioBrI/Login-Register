<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('contratos', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->string('tipo_contrato');
            $table->integer('tempo_empresa')->nullable();
            $table->decimal('salario', 10, 2)->nullable();
            $table->decimal('outras_rendas', 10, 2)->nullable();
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('contratos');
    }
};
