<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('simulacoes', function (Blueprint $table) {
            $table->decimal('valor_final', 10, 2)->nullable();
        });
    }

    public function down()
    {
        Schema::table('simulacoes', function (Blueprint $table) {
            $table->dropColumn('valor_final');
        });
    }

};
