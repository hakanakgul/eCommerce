<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();

            $table->string("name");
            $table->string("slug");
            $table->longText("description");
            $table->string("image")->nullable();

            $table->string("metaTitle");
            $table->string("metaKeyword");
            $table->mediumText("metaDescription");

            $table->tinyInteger("status")->default(1)->comment("0=hidden, 1=visible");


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}