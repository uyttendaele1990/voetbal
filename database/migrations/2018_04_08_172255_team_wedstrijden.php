<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TeamWedstrijden extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams_wedstrijden', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('team_id')->unsigned()->index();
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');

            $table->integer('wedstrijden_id')->unsigned()->index();
            $table->foreign('wedstrijden_id')->references('id')->on('wedstrijdens')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
