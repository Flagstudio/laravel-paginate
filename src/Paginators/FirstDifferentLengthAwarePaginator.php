<?php

namespace Flagstudio\PaginateMacros\Paginators;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class FirstDifferentLengthAwarePaginator extends LengthAwarePaginator
{
    /**
     * Create a new paginator instance.
     *
     * @param  Collection  $items
     * @param  int  $total
     * @param  int  $firstPage
     * @param  int  $nextPerPage
     * @param  int  $perPage
     * @param  int|null  $currentPage
     * @param  array  $options (path, query, fragment, pageName)
     *
     * @return void
     */
    public function __construct(Collection $items, int $total, int $firstPage, int $nextPerPage, int $perPage, int $currentPage = null, array $options = [])
    {
        parent::__construct($items, $total, $perPage, $currentPage, $options);

        $this->lastPage = max((int) ceil(($total - $firstPage) / $nextPerPage + 1), 1);
    }
}
