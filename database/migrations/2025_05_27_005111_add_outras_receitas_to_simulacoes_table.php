<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::table('simulacoes', function (Blueprint $table) {
            $table->decimal('outras_receitas', 10, 2)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('simulacoes', function (Blueprint $table) {
            $table->dropColumn('outras_receitas');
        });
    }

};
