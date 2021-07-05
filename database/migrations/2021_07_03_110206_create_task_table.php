<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 200)->nullable(false);
            $table->text('description')->nullable(false);
            $table->integer('priority')->nullable(false);
            $table->enum('status', ['TODO', 'DOING', 'DONE'])->nullable(false)->default('TODO');
            $table->unsignedBigInteger('user_id')->nullable(false);
            $table->foreign('user_id')->references('id')->on('user');
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
        Schema::dropIfExists('task');
    }
}
