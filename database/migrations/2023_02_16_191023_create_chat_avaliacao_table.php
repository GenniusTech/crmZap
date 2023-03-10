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
       
        Schema::create('chat_avaliacao', function (Blueprint $table) {
            $table->id();
            $table->string('chatId',255);
            $table->string('avaliação',255);
            $table->string('atendente',255);
            $table->string('origemAtendimento',255);
            $table->string('tipoAvaliação',255);
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
        Schema::dropIfExists('chat_avaliacao');
    }
};
