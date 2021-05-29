<?php

namespace App\Http\Queries;

use Closure;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\QueryBuilder\QueryBuilder;

abstract class BaseQuery
{
    protected QueryBuilder $query;
    protected $export;
    protected string $resource;

    public function paginate(): self
    {
        $this->query->paginate(min(100, request()->get('perPage', 15)));

        return $this;
    }

    abstract public function get(): array;

    public function paginateOrExport(Closure $response)
    {
        if (request()->get('export')) {
            $fileName = trans_choice("crud.{$this->resource}.name", 10);
            $date = date('Ymd-His');

            return Excel::download($this->export, "export-{$fileName}-{$date}.xlsx");
        }

        return $response($this->get());
    }
}
