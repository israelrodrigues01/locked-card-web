<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('REGISTROS', function (Blueprint $table) {
            $table->uuid('CODREGIS')->primary();

            $table->uuid('CODUSU');
            $table->foreign('CODUSU')->references('CODUSU')->on('users')->onDelete('cascade');

            $table->timestamp('ENTRADA')->nullable();
            $table->timestamp('SAIDA')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('REGISTROS');
    }
};
