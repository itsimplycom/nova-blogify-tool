<?php

namespace Its\NovaBlogifyTool\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PostTranslation extends Model
{
    public function getTable()
    {
        return config('nova-blogify.table_prefix').parent::getTable();
    }

    public $translationModel = 'Its\NovaBlogifyTool\Models\PostTranslation';

    /**
     * Fillable properties.
     *
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
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
