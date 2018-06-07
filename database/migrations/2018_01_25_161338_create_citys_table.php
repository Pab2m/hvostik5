<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('citys', function (Blueprint $table) {
        $table->increments('id');
        $table->string('name');
          $table->integer('important')->nullable();
        $table->integer('id_region')->unsigned()->index();
        $table->foreign('id_region')
              ->references('id')->on('regions')
              ->onDelete('cascade')->onUpdate('cascade');
        $table->string('slug')->unique();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
          Schema::dropIfExists('citys');
    }
}
