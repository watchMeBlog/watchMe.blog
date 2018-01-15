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
<<<<<<< HEAD
            $table->string('title');
            $table->text('body');
            $table->string('slug');
=======
            $table->string('title')->unique();
            $table->text('body');
            $table->string('slug')->unique();
>>>>>>> 0bd903a789ae00d439b682e51c8d16accf9fd4d2
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
