<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {        
            $table->increments('id');
            $table -> integer('author_id') -> unsigned() -> default(0);
            $table->foreign('author_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->string('title');
            $table->text('body');
            $table->string('slug');
            $table->boolean('active');
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
        Schema::dropIfExists('reviews');
    }
}
