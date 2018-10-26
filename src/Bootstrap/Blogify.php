<?php

namespace Its\NovaBlogifyTool\Bootstrap;

use Illuminate\Support\Facades\Schema;
use Its\NovaBlogifyTool\Resources\BlogifyCategory;
use Its\NovaBlogifyTool\Resources\BlogifyComment;
use Its\NovaBlogifyTool\Resources\BlogifyPost;
use Its\NovaBlogifyTool\Resources\BlogifyTag;
use Laravel\Nova\Nova;

class Blogify
{
    public static function isInstalled()
    {
        $prefix = config('nova-blogify.table_prefix');

        return
            Schema::hasTable($prefix.'posts') &&
            Schema::hasTable($prefix.'categories') &&
            Schema::hasTable($prefix.'comments') &&
            Schema::hasTable($prefix.'tags') &&
            Schema::hasTable($prefix.'post_tag');
    }

    public static function injectToolResources()
    {
        if (!self::isInstalled()) {
            return;
        }

        Nova::resources([
            BlogifyCategory::class,
            BlogifyPost::class,
            BlogifyComment::class,
            BlogifyTag::class,
        ]);
    }
}
