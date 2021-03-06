<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ForegnKeyAutomobilesIdOnMarques extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('automobiles', function (Blueprint $table) {
            $table->unsignedBigInteger('marque_id')->after('priorite');
            $table->unsignedBigInteger('modele_id')->after('marque_id');
            $table->foreign('marque_id')
                 ->references('id')
                 ->on('marques')
                 ->onDelete('cascade')
                 ->onUpdate('cascade');

            $table->foreign('modele_id')
                 ->references('modele_id')
                 ->on('modeles')
                 ->onDelete('cascade')
                 ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('marques', function (Blueprint $table) {
            $table->dropForeign(['automobile_id']);
            $table->dropColumn('automobile_id');
        });
    }
}
