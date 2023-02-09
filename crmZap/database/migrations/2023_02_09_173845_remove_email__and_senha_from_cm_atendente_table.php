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
        Schema::table('crm_atendente', function (Blueprint $table) {
            $table->dropColumn('email');
            $table->dropColumn('senha');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('crm_atendente', function (Blueprint $table) {
            $table->string('email')->after('nome');
            $table->string('senha')->after('email');
        });
    }
};
