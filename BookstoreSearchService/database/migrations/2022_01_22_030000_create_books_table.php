<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('product_id')->unique();
            $table->string('title');
            $table->string('author');
            $table->text('description');
            $table->string('publisher');
            $table->string('category');
            $table->string('language');
            $table->integer('edition')->unsigned();
            $table->integer('page')->unsigned();
            $table->integer('weight')->unsigned();
            $table->integer('maximum_price')->unsigned();
            $table->integer('offered_price')->unsigned();
            $table->integer('discount_pctg')->unsigned();
            $table->integer('available')->unsigned();
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
        Schema::dropIfExists('books');
    }
}
