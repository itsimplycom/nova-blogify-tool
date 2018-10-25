<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
	    Schema::create(config('nova-blogify.table_prefix').'categories', function (Blueprint $table) {
		    $table->increments('id');
		    $table->string('name');
		    $table->string('slug')->unique();
		    $table->text('description')->nullable();
		    $table->timestamps();
	    });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
	    Schema::dropIfExists(config('nova-blogify.table_prefix').'categories');
    }
}
