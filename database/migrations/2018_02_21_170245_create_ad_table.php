<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('ad', function (Blueprint $table) {
          $table->increments('id');

        $table->integer('id_user')->unsigned()->index();
        $table->foreign('id_user')
                      ->references('id')->on('users')
                      ->onDelete('cascade')->onUpdate('cascade');

         $table->integer('id_region')->unsigned()->index();
          $table->foreign('id_region')
                ->references('id')->on('regions')
                ->onDelete('cascade')->onUpdate('cascade');

         $table->integer('id_city')->unsigned()->index();
         $table->foreign('id_city')
                ->references('id')->on('citys')
                ->onDelete('cascade')->onUpdate('cascade');

        $table->integer('id_category')->unsigned();
          $table->foreign('id_category')
                  ->references('id')->on('categorys')
                  ->onDelete('cascade')->onUpdate('cascade');

          $table->integer('id_breed')->unsigned();
          $table->foreign('id_breed')->nullable()->default(null)
                  ->references('id')->on('breeds')
                  ->onDelete('cascade')->onUpdate('cascade');

          $table->integer('id_type')->unsigned();
          $table->foreign('id_type')->nullable()->default(null)
                  ->references('id')->on('type')
                  ->onDelete('cascade')->onUpdate('cascade');

          $table->integer('id_pol')->unsigned();
          $table->foreign('id_pol')->nullable()->default(null)
                          ->references('id')->on('pol')
                          ->onDelete('cascade')->onUpdate('cascade');

          $table->integer('id_vozrast')->unsigned();
          $table->foreign('id_vozrast')->nullable()->default(null)
                          ->references('id')->on('vozrast')
                          ->onDelete('cascade')->onUpdate('cascade');

          $table->string('title');
          $table->string('url');
          $table->string('preview_foto');
          $table->string('foto');
          $table->string('email');
          $table->string('phone');
          $table->text('text');
          $table->integer('status')->default(0);
          $table->timestamps();
          $table->softDeletes();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
          Schema::dropIfExists('ad');
    }
}
