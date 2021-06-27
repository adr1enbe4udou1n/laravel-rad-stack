<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * App\Models\PostCategory.
 *
 * @property int         $id
 * @property string      $name
 * @property null|int    $order_column
 * @property string      $slug
 * @property null|Carbon $created_at
 * @property null|Carbon $updated_at
 *
 * @method static \Database\Factories\PostCategoryFactory factory(...$parameters)
 * @method static Builder|PostCategory newModelQuery()
 * @method static Builder|PostCategory newQuery()
 * @method static Builder|PostCategory query()
 * @method static Builder|PostCategory whereCreatedAt($value)
 * @method static Builder|PostCategory whereId($value)
 * @method static Builder|PostCategory whereName($value)
 * @method static Builder|PostCategory whereOrderColumn($value)
 * @method static Builder|PostCategory whereSlug($value)
 * @method static Builder|PostCategory whereUpdatedAt($value)
 * @method static Builder|PostCategory ordered(string $direction = 'asc')
 * @mixin \Eloquent
 */
class PostCategory extends Model implements Sortable
{
    use HasFactory;
    use HasSlug;
    use SortableTrait;

    protected $guarded = [];

    protected $hidden = [
        'order_column',
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
        ;
    }
}
