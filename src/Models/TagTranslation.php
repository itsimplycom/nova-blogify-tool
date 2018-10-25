<?php

namespace Its\NovaBlogifyTool\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class TagTranslation extends Model {

	public function getTable() {
		return config( 'nova-blogify.table_prefix' ) . parent::getTable();
	}


	/**
	 * Fillable properties.
	 * @var array
	 */
	protected $fillable = [
		'name',
		'description',
	];

	/**
	 * The attributes that should be cast to native types.
	 * @var array
	 */
	protected $casts = [
		'name'        => 'string',
		'description' => 'string',
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
	 * @return BelongsTo
	 */
	public function tag(): BelongsTo {
		return $this->belongsTo( Tag::class );
	}
}
