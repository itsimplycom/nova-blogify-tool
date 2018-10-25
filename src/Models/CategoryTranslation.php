<?php

namespace Mattmangoni\NovaBlogifyTool\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Mattmangoni\NovaBlogifyTool\Traits\Sluggable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CategoryTranslation extends Model {
	public function getTable() {
		return config( 'nova-blogify.table_prefix' ) . parent::getTable();
	}

	/**
	 * Model fillable fields.
	 * @var array
	 */
	protected $fillable = [
		'name',
		'description',
	];

	/**
	 * @return belongsTo
	 */
	public function category(): BelongsTo {
		return $this->belongsTo( Category::class );
	}

}
