<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
<<<<<<< HEAD
            $table->enum('role',['admin','author','guest', 'moderator'])->default('author');
=======
<<<<<<< HEAD
            $table->enum('role',['admin','author','guest', 'moderator'])->default('author');
=======
>>>>>>> 08a55450e173585e40593a58e731a854be991121
>>>>>>> 0bd903a789ae00d439b682e51c8d16accf9fd4d2
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
