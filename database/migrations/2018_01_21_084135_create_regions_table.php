<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('regions', function (Blueprint $table) {
        $table->increments('id');
        $table->string('name');
        $table->integer('id_county')->unsigned()->index()->default(1);
        $table->foreign('id_county')
               ->references('id')->on('countrys')
               ->onDelete('cascade')->onUpdate('cascade');
        $table->string('slag')->unique();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('regions');
    }
}
