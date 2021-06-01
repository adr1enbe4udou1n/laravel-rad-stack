<?php

namespace App\Http\Queries;

use App\Exports\UserExport;
use App\Http\Resources\Admin\UserResource;
use App\Models\User;
use App\Support\GlobalSearchFilter;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class UserQuery extends BaseQuery
{
    private UserExport $exporter;

    public function make(): self
    {
        $this->query = QueryBuilder::for(User::class)
            ->allowedFilters([
                AllowedFilter::custom('q', new GlobalSearchFilter(['name', 'email'])),
                AllowedFilter::partial('name'),
                AllowedFilter::partial('email'),
                AllowedFilter::exact('id'),
                AllowedFilter::exact('role'),
                AllowedFilter::exact('active'),
            ])
            ->allowedSorts(['id', 'name', 'last_login_at', 'created_at', 'updated_at'])
        ;

        $this->export = new UserExport($this->query);
        $this->resource = 'users';

        return $this;
    }

    public function get(): array
    {
        return [
            'sort' => request()->get('sort', 'id'),
            'filter' => request()->get('filter'),
            'users' => fn () => $this->paginate()->through(fn (User $user) => UserResource::make($user)),
        ];
    }
}