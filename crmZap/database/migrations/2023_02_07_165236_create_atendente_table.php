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
        Schema::create('atendente', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 100);
            $table->string('email', 100);
            $table->string('tell', 100);
            $table->string('senha', 255);
            $table->integer('dep');
            $table->integer('tipo');
            $table->integer('status')->unsigned()->default(0)->comment('0: inactive, 1: active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('atendente');
    }
};
