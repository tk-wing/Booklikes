<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesHasCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles_has_categories', function (Blueprint $table) {
            $table->bigInteger('profile_id')->references('id')->on('profiles')->unsigned();
            $table->tinyInteger('category_id')->references('id')->on('categories')->unsigned();
            $table->primary(['profile_id', 'category_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles_has_categories');
    }
}
