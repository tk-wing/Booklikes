<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookshelvesHasBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookshelves_has_books', function (Blueprint $table) {
            $table->bigInteger('bookshelf_id')->reference('id')->on('bookshelves')->unsigned();
            $table->bigInteger('book_id')->reference('id')->on('book_id')->unsigned();
            $table->primary(['bookshelf_id', 'book_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookshelves_has_books');
    }
}
