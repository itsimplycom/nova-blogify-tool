<?php

namespace Mattmangoni\NovaBlogifyTool\Models;

use Dimsav\Translatable\Translatable;
use Spatie\MediaLibrary\File;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Mattmangoni\NovaBlogifyTool\Traits\Sluggable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PostTranslation extends Model {

	public function getTable() {
		return config( 'nova-blogify.table_prefix' ) . parent::getTable();
	}

	public $translationModel = 'Mattmangoni\NovaBlogifyTool\Models\PostTranslation';

	/**
	 * Fillable properties.
	 * @var array
	 */
	protected $fillable = [
		'title',
		'summary',
		'body',
	];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function post(): BelongsTo {
		return $this->belongsTo( Post::class );
	}

}
