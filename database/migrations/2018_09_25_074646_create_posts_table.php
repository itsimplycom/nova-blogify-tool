<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
	    Schema::create(config('nova-blogify.table_prefix').'posts', function (Blueprint $table) {
		    $table->increments('id');
		    $table->unsignedInteger('user_id')->index();
		    $table->unsignedInteger('category_id')->index();
		    $table->string('title')->index();
		    $table->string('slug')->unique();
		    $table->string('summary')->nullable();
		    $table->text('body');
		    $table->boolean('published')->default(false);
		    $table->boolean('featured')->default(false);
		    $table->timestamp('scheduled_for')->useCurrent();
		    $table->softDeletes();
		    $table->timestamps();
	    });

	    $usermodel =  config('nova-blogify.resources.users.model');
	    $usertable = (new $usermodel)->getTable();

	    Schema::table(config('nova-blogify.table_prefix').'posts', function (Blueprint $table) use ($usertable) {
		    $table->foreign('user_id')->references('id')->on($usertable);
		    $table->foreign('category_id')->references('id')->on(config('nova-blogify.table_prefix').'categories');
	    });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {

	    Schema::table(config('nova-blogify.table_prefix').'posts', function (Blueprint $table) {
		    $table->dropForeign([config('nova-blogify.table_prefix').'user_id']);
		    $table->dropForeign([config('nova-blogify.table_prefix').'category_id']);
	    });

	    Schema::dropIfExists(config('nova-blogify.table_prefix').'posts');
    }
}
