<?php

namespace Its\NovaBlogifyTool\Models;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model {

	use Translatable;

	public function getTable() {
		return config( 'nova-blogify.table_prefix' ) . parent::getTable();
	}

	public $translationModel = 'Its\NovaBlogifyTool\Models\TagTranslation';

	/**
	 * Fillable properties.
	 * @var array
	 */
	protected $fillable = [
		'tagged_count',
	];

	/**
	 * Model translated fields.
	 * @var array
	 */
	protected $translatedAttributes = [
		'name',
		'description',
	];

	/**
	 * The attributes that should be cast to native types.
	 * @var array
	 */
	protected $casts = [
		'tagged_count' => 'integer',
	];

	/**
	 * The attributes that should be mutated to dates.
	 * @var array
	 */
	protected $dates = [
		'created_at',
		'updated_at',
	];

	/**
	 * @return BelongsToMany
	 */
	public function posts(): BelongsToMany {
		return $this->belongsToMany( Post::class, config( 'nova-blogify.table_prefix' ) . 'post_tag' );
	}
}
