<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ForegnKeyAutomobilesIdOnPhotos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('photos', function (Blueprint $table) {
            $table->unsignedBigInteger('automobile_id')->after('photo_profil');
            $table->foreign('automobile_id')
                 ->references('automobile_id')
                 ->on('automobiles')
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
        Schema::table('photos', function (Blueprint $table) {
            $table->dropForeign(['automobile_id']);
            $table->dropColumn('automobile_id');
        });
    }
}
