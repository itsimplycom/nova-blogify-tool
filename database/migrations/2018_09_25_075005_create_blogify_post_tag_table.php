<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogifyPostTagTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create(config('nova-blogify.table_prefix').'post_tag', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('post_id');
            $table->unsignedInteger('tag_id');
        });

        Schema::table(config('nova-blogify.table_prefix').'post_tag', function (Blueprint $table) {
            $table->foreign('post_id')->references('id')->on(config('nova-blogify.table_prefix').'posts');
            $table->foreign('tag_id')->references('id')->on(config('nova-blogify.table_prefix').'tags');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists(config('nova-blogify.table_prefix').'post_tag');
    }
}
