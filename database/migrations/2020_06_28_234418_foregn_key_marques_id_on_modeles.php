<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ForegnKeyMarquesIdOnModeles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('modeles', function (Blueprint $table) {
            $table->unsignedBigInteger('marque_id')->after('description');
            $table->foreign('marque_id')
                 ->references('marque_id')
                 ->on('marques')
                 ->onDelete('restrict')
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
        Schema::table('modeles', function (Blueprint $table) {
            $table->dropForeign(['marque_id']);
            $table->dropColumn('marque_id');
        });
    }
}
