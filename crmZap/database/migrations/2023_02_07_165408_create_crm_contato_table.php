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
        Schema::create('crm_contato', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('atendente_id');
            $table->string('nome', 100);
            $table->string('email', 100)->unique();
            $table->string('tell', 100);
            $table->string('empresa', 100);
            $table->string('profissao',100);
            $table->string('instagram',100);
            $table->string('facebook',100);
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
        Schema::dropIfExists('crm_contato');
    }
};
