<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ForegnKeyAutomobilesIdOnCouleurs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('automobiles', function (Blueprint $table) {
            $table->unsignedBigInteger('couleur_id')->after('marque_id');
            $table->foreign('couleur_id')
                 ->references('couleur_id')
                 ->on('couleurs')
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
        Schema::table('couleurs', function (Blueprint $table) {
            $table->dropForeign(['automobile_id']);
            $table->dropColumn('automobile_id');
        });
    }
}
