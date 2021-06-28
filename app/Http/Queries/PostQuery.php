<?php

namespace App\Http\Queries;

use App\Exports\PostExport;
use App\Http\Resources\Admin\PostResource;
use App\Models\Post;
use App\Support\GlobalSearchFilter;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class PostQuery extends BaseQuery
{
    public function make(): self
    {
        $this->query = QueryBuilder::for(Post::class)
            ->allowedFilters([
                AllowedFilter::custom('q', new GlobalSearchFilter(['title', 'summary', 'body'])),
                AllowedFilter::partial('title'),
                AllowedFilter::partial('summary'),
                AllowedFilter::partial('body'),
                AllowedFilter::exact('id'),
                AllowedFilter::exact('category', 'category_id'),
                AllowedFilter::exact('status'),
                AllowedFilter::exact('pin'),
                AllowedFilter::exact('promote'),
                AllowedFilter::scope('published_at', 'publishedBetween'),
            ])
            ->allowedSorts(['id', 'title', 'published_at', 'created_at', 'updated_at'])
            ->with('category')
            ->orderByDesc('id')
        ;

        $this->export = new PostExport($this->query);
        $this->resource = 'posts';

        return $this;
    }

    public function get(): array
    {
        return [
            'sort' => request()->get('sort', '-id'),
            'filter' => request()->get('filter'),
            'posts' => fn () => PostResource::collection($this->paginate()),
        ];
    }
}
