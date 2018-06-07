<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategorysTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('categorys_type', function (Blueprint $table) {
        $table->integer('id_categorys')->unsigned()->index();
        $table->foreign('id_categorys')
              ->references('id')->on('categorys')
              ->onDelete('cascade')->onUpdate('cascade');
        $table->integer('id_type')->unsigned()->index();
        $table->foreign('id_type')
              ->references('id')->on('type')
              ->onDelete('cascade')->onUpdate('cascade');
        $table->string('slag')->unique();
        $table->boolean('pol')->default(false);
        $table->boolean('vozrast')->default(false);
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
