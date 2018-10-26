<?php

namespace Its\NovaBlogifyTool\Resources;

use App\Nova\Resource;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\BelongsTo;

class BlogifyComment extends Resource
{
    /**
     * The model the resource corresponds to.
     * @var string
     */
    public static $model = 'Its\NovaBlogifyTool\Models\Comment';

    /**
     * The single value that should be used to represent the resource when being displayed.
     * @var string
     */
    public static $title = 'title';

    /**
     * Hide resource from Nova's default menu.
     * @var bool
     */
    public static $displayInNavigation = false;

    /**
     * Get the searchable columns for the resource.
     * @return array
     */
    public static function searchableColumns()
    {
        return config('nova-blogify.resources.comments.search');
    }

    /**
     * Get the fields displayed by the resource.
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('Post', 'post', BlogifyPost::class)
                ->sortable()
                ->rules('required'),

            BelongsTo::make('Author', 'author', config('nova-blogify.resources.users.resource'))
                ->sortable()
                ->rules('required'),

            Markdown::make('Body')
                ->rules(['required', 'string']),
        ];
    }

    /**
     * Get the cards available for the request.
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}