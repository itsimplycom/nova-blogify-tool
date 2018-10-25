<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogifyCategoriesTable extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up() {
		Schema::create( config( 'nova-blogify.table_prefix' ) . 'categories', function ( Blueprint $table ) {
			$table->increments( 'id' );
			$table->string( 'slug' )->unique();
			$table->timestamps();
		} );

		Schema::create( config( 'nova-blogify.table_prefix' ) . 'category_translations', function ( Blueprint $table ) {
			$table->increments( 'id' );
			$table->integer( 'category_id' )->unsigned();
			$table->string( 'locale' )->index();
			$table->string( 'name' );
			$table->text( 'description' )->nullable();
			$table->unique( [ 'category_id', 'locale' ] );
			$table->foreign( 'category_id' )->references( 'id' )->on( config( 'nova-blogify.table_prefix' ) . 'categories' )->onDelete( 'cascade' );
			$table->timestamps();
		} );
	}

	/**
	 * Reverse the migrations.
	 */
	public function down() {
		Schema::dropIfExists( config( 'nova-blogify.table_prefix' ) . 'category_translations' );
		Schema::dropIfExists( config( 'nova-blogify.table_prefix' ) . 'categories' );
	}
}
