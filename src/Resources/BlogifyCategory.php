<?php

namespace Its\NovaBlogifyTool\Resources;

use App\Nova\Resource;
use Illuminate\Http\Request;
use Its\Nova\Translatable\Translatable;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Text;

class BlogifyCategory extends Resource {
	/**
	 * The model the resource corresponds to.
	 *
	 * @var string
	 */
	public static $model = 'Its\NovaBlogifyTool\Models\Category';

	/**
	 * The single value that should be used to represent the resource when being displayed.
	 *
	 * @var string
	 */
	public static $title = 'name';

	/**
	 * Hide resource from Nova's standard menu.
	 *
	 * @var bool
	 */
	public static $displayInNavigation = false;

	/**
	 * Get the searchable columns for the resource.
	 *
	 * @return array
	 */
	public static function searchableColumns() {
		return config( 'nova-blogify.resources.categories.search' );
	}

	/**
	 * Get the fields displayed by the resource.
	 *
	 * @param \Illuminate\Http\Request $request
	 *
	 * @return array
	 */
	public function fields( Request $request ) {
		return [
			Text::make( 'Slug' )
			    ->hideWhenCreating()
			    ->sortable()
			    ->rules( [ 'required' ] ),

			Translatable::make( 'Name' )
			            ->rules( [ 'required' ] ),

			Translatable::make( 'Description' )->trix(),
			HasMany::make( 'BlogifyPost', 'posts' ),
		];
	}

	/**
	 * Get the cards available for the request.
	 *
	 * @param \Illuminate\Http\Request $request
	 *
	 * @return array
	 */
	public function cards( Request $request ) {
		return [];
	}

	/**
	 * Get the filters available for the resource.
	 *
	 * @param \Illuminate\Http\Request $request
	 *
	 * @return array
	 */
	public function filters( Request $request ) {
		return [];
	}

	/**
	 * Get the lenses available for the resource.
	 *
	 * @param \Illuminate\Http\Request $request
	 *
	 * @return array
	 */
	public function lenses( Request $request ) {
		return [];
	}

	/**
	 * Get the actions available for the resource.
	 *
	 * @param \Illuminate\Http\Request $request
	 *
	 * @return array
	 */
	public function actions( Request $request ) {
		return [];
	}
}
