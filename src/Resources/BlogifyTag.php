<?php

namespace Its\NovaBlogifyTool\Resources;

use App\Nova\Resource;
use Its\Nova\Translatable\Translatable;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\BelongsToMany;

class BlogifyTag extends Resource {
	/**
	 * The model the resource corresponds to.
	 * @var string
	 */
	public static $model = 'Its\NovaBlogifyTool\Models\Tag';

	/**
	 * The single value that should be used to represent the resource when being displayed.
	 * @var string
	 */
	public static $title = 'name';

	/**
	 * Hide resource from Nova's standard menu.
	 * @var bool
	 */
	public static $displayInNavigation = false;

	/**
	 * Get the searchable columns for the resource.
	 * @return array
	 */
	public static function searchableColumns() {
		return config( 'nova-blogify.resources.tags.search' );
	}

	/**
	 * Get the fields displayed by the resource.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return array
	 */
	public function fields( Request $request ) {
		return [
			ID::make()->sortable(),

			Translatable::make( 'Name' )
			            ->rules( [ 'required', 'max:255' ] )
			            ->creationRules( [ 'unique:' . config( 'nova-blogify.table_prefix' ) . 'tag_translations,name' ] )
			            ->updateRules( [ 'unique:' . config( 'nova-blogify.table_prefix' ) . 'tag_translations,name,{{resourceId}}' ] ),

			Number::make( 'Count', 'tagged_count' )->hideWhenCreating()->hideWhenUpdating(),

			Translatable::make( 'Description' ),

			BelongsToMany::make( 'Posts' ),
		];
	}

	/**
	 * Get the cards available for the request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return array
	 */
	public function cards( Request $request ) {
		return [];
	}

	/**
	 * Get the filters available for the resource.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return array
	 */
	public function filters( Request $request ) {
		return [];
	}

	/**
	 * Get the lenses available for the resource.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return array
	 */
	public function lenses( Request $request ) {
		return [];
	}

	/**
	 * Get the actions available for the resource.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return array
	 */
	public function actions( Request $request ) {
		return [];
	}
}