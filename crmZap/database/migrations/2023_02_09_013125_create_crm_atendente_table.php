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
        Schema::create('crm_atendente', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 255);
            $table->unsignedBigInteger('user_id');
            $table->string('email', 255);
            $table->string('tell', 255);
            $table->string('dep')->nullable();
            $table->integer('tipo')->nullable();
            $table->integer('status')->unsigned()->default(0)->comment('0: inactive, 1: active')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('crm_atendente');
    }
};
