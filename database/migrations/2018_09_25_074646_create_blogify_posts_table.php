<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogifyPostsTable extends Migration
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
            $table->string('slug')->unique();

            $table->boolean('published')->default(false);
            $table->boolean('featured')->default(false);
            $table->timestamp('scheduled_for')->useCurrent();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create(config('nova-blogify.table_prefix').'post_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('post_id')->unsigned();
            $table->string('locale')->index();
            $table->string('title')->index();
            $table->string('summary')->nullable();
            $table->text('body');
            $table->unique(['post_id', 'locale']);
            $table->foreign('post_id')->references('id')->on(config('nova-blogify.table_prefix').'posts')->onDelete('cascade');
            $table->timestamps();
        });

        $usermodel = config('nova-blogify.resources.users.model');
        $usertable = ( new $usermodel() )->getTable();

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
        Schema::dropIfExists(config('nova-blogify.table_prefix').'post_translations');
        Schema::dropIfExists(config('nova-blogify.table_prefix').'posts');
    }
}
