<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogifyCommentsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create(config('nova-blogify.table_prefix').'comments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('post_id')->index();
            $table->unsignedInteger('user_id')->index();
            $table->text('body');
            $table->timestamps();
            $table->softDeletes();
        });

        $usermodel = config('nova-blogify.resources.users.model');
        $usertable = ( new $usermodel() )->getTable();

        Schema::table(config('nova-blogify.table_prefix').'comments', function (Blueprint $table) use ($usertable) {
            $table->foreign('post_id')->references('id')->on(config('nova-blogify.table_prefix').'posts')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on($usertable)->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign([config('nova-blogify.table_prefix').'post_id']);
            $table->dropForeign([config('nova-blogify.table_prefix').'user_id']);
        });

        Schema::dropIfExists(config('nova-blogify.table_prefix').'comments');
    }
}
