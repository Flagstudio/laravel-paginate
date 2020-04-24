<?php

namespace Flagstudio\PaginateMacros\CollectionMacros;

use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Paginate the given collection and take all records from first page to current.
 *
 * @param int $perPage
 * @param string $pageName
 * @param int|null $page
 * @param int|null $total
 * @param array $options
 *
 * @mixin \Illuminate\Support\Collection
 *
 * @return \Illuminate\Pagination\LengthAwarePaginator
 */
class PaginateWithPrevious
{
    public function __invoke()
    {
        return function (int $perPage = 15, string $pageName = 'page', int $page = null, int $total = null, array $options = []): LengthAwarePaginator {
            $total = $total ?: $this->count();

            $page = $page ?: LengthAwarePaginator::resolveCurrentPage($pageName);

            $options += [
                'path' => LengthAwarePaginator::resolveCurrentPath(),
                'pageName' => $pageName,
            ];

            $items = $this->take($page * $perPage);

            return new LengthAwarePaginator(
                $items,
                $total,
                $perPage,
                $page,
                $options
            );
        };
    }
}