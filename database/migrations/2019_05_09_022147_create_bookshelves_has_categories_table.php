<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookshelvesHasCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookshelves_has_categories', function (Blueprint $table) {
            $table->bigInteger('bookshelf_id')->reference('id')->on('bookshelves')->unsigned();
            $table->bigInteger('category_id')->reference('id')->on('categories')->unsigned();
            $table->primary(['bookshelf_id', 'category_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookshelves_has_categories');
    }
}
