<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ForeignActivities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('activities', function (Blueprint $table) {

        $table->foreign('classroom_id')->references('id')->on('classroom')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('studentclass_id')->references('id')->on('studentclass')->onDelete('cascade')->onUpdate('cascade');

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
