<?php

namespace Its\NovaBlogifyTool\Resources;

use App\Nova\Resource;
use Illuminate\Http\Request;
use Its\Nova\Translatable\Translatable;
use Its\NovaBlogifyTool\Metrics\Posts\NewPosts;
use Its\NovaBlogifyTool\Metrics\Posts\PostsTrend;
use Kingsley\NovaMediaLibrary\Fields\Image;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Text;

class Post extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'Its\NovaBlogifyTool\Models\Post';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

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
    public static function searchableColumns()
    {
        return config('nova-blogify.resources.posts.search');
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            Text::make('Slug')
                ->hideWhenCreating()
                ->sortable()
                ->rules(['required']),

            BelongsTo::make('Author', 'author', config('nova-blogify.resources.users.resource'))
                ->sortable()
                ->rules(['required']),

            Image::make('Image', config('nova-blogify.image_settings.collection'))
                ->usingConversion('thumb'),

            BelongsTo::make('Category', 'category', Category::class)
                ->sortable()
                ->rules(['required']),

            HasMany::make('Comments', 'comments', Comment::class)
                ->sortable()
                ->rules(['required']),

            Translatable::make('Title')
                ->rules(['required']),

            Translatable::make('Summary')->hideFromIndex()->trix(),

            Translatable::make('Body')->rules(['required'])->trix(),

            Boolean::make('Featured')->sortable(),

            DateTime::make('Scheduled For'),

            Boolean::make('Published', function () {
                return $this->published;
            })->exceptOnForms(),

            BelongsToMany::make('Tags', 'tags', Tag::class)
                ->searchable(true),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function cards(Request $request)
    {
        return [
            (new NewPosts())->width('1/2'),
            (new PostsTrend())->width('1/2'),
        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
