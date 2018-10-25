<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogifyTagsTable extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up() {
		Schema::create( config( 'nova-blogify.table_prefix' ) . 'tags', function ( Blueprint $table ) {
			$table->increments( 'id' );
			$table->unsignedInteger( 'tagged_count' )->nullable()->default( 0 );
			$table->timestamps();
		} );
		Schema::create( config( 'nova-blogify.table_prefix' ) . 'tag_translations', function ( Blueprint $table ) {
			$table->increments( 'id' );
			$table->integer( 'tag_id' )->unsigned();
			$table->string( 'locale' )->index();
			$table->string( 'name' );
			$table->text( 'description' )->nullable();
			$table->unique( [ 'tag_id', 'locale' ] );
			$table->foreign( 'tag_id' )->references( 'id' )->on( config( 'nova-blogify.table_prefix' ) . 'tags' )->onDelete( 'cascade' );
			$table->timestamps();
		} );
	}

	/**
	 * Reverse the migrations.
	 */
	public function down() {
		Schema::dropIfExists( config( 'nova-blogify.table_prefix' ) . 'tags' );
		Schema::dropIfExists( config( 'nova-blogify.table_prefix' ) . 'tag_translations' );
	}
}
