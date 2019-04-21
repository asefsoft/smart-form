<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilledFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filled_forms', function (Blueprint $table) {
	        $table->increments('id')->unique();
            $table->integer('form_id')->unsigned();
	        $table->foreign('form_id')->references('id')->on('forms')->onDelete('cascade');
	        $table->string('title');
	        $table->json('questions');
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
        Schema::drop('filled_forms');
    }
}
