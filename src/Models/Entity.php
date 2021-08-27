<?php

namespace App\Permacrunch\Base\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

use Spatie\Tags\HasTags;

use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;

class Entity extends Model implements HasMedia, Feedable
{
    use HasFactory, HasSlug, InteractsWithMedia, HasTags;

    protected $table = 'pc_entities';
    protected $fillable = ['name', 'description'];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->usingLanguage('de');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function toFeedItem(): FeedItem
    {
        return self::create()
            ->id($this->id)
            ->title($this->name)
            ->summary($this->description)
            ->updated($this->updated_at)
            ->link($this->link)
            ->authorName(env('AUTHOR_NAME'))
            ->authorEmail(env('AUTHOR_EMAIL'));
    }

    public static function getFeedItems()
    {
        return self::all();
    }
}
