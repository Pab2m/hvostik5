<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBreedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('breeds', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->integer('id_categorys')->unsigned()->index();
                $table->foreign('id_categorys')
                      ->references('id')->on('categorys')
                      ->onDelete('cascade')->onUpdate('cascade');
                $table->string('url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
          Schema::dropIfExists('breeds');
    }
}
