<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('rendas', function (Blueprint $table) {
            $table->unsignedBigInteger('simulacao_id')->nullable()->after('user_id');
            $table->foreign('simulacao_id')->references('id')->on('simulacoes')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rendas', function (Blueprint $table) {
            //
        });
    }
};
