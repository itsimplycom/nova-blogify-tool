<?php

namespace Its\NovaBlogifyTool\Models;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Its\NovaBlogifyTool\Traits\Sluggable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model {
	use Translatable, Sluggable;

	public function getTable() {
		return config( 'nova-blogify.table_prefix' ) . parent::getTable();
	}


	public $translationModel = 'Its\NovaBlogifyTool\Models\CategoryTranslation';

	/**
	 * Model translated fields.
	 * @var array
	 */
	protected $translatedAttributes = [
		'name',
		'description',
	];

	/**
	 * @return HasMany
	 */
	public function posts(): HasMany {
		return $this->hasMany( Post::class );
	}

	/**
	 * Get the route key for the model.
	 *
	 * @return string
	 */
	public function getRouteKeyName() {
		return 'slug';
	}
}
