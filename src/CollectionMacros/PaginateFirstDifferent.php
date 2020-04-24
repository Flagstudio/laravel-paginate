<?php

namespace Flagstudio\PaginateMacros\CollectionMacros;

use Flagstudio\PaginateMacros\Paginators\FirstDifferentLengthAwarePaginator;

/**
 * Paginate the given collection but first page has different size then others.
 *
 * @param int $firstPerPage
 * @param int $nextPerPage
 * @param string $pageName
 * @param int|null $page
 * @param int|null $total
 * @param array $options
 *
 * @mixin \Illuminate\Support\Collection
 *
 * @return FirstDifferentLengthAwarePaginator
 */
class PaginateFirstDifferent
{
    public function __invoke()
    {
        return function (int $firstPerPage, int $nextPerPage, string $pageName = 'page', int $page = null, int $total = null, array $options = []): FirstDifferentLengthAwarePaginator {
            $total = $total ?: $this->count();

            $page = $page ?: FirstDifferentLengthAwarePaginator::resolveCurrentPage($pageName);

            $options += [
                'path' => FirstDifferentLengthAwarePaginator::resolveCurrentPath(),
                'pageName' => $pageName,
            ];

            $perPage = $page === 1 ? $firstPerPage : $nextPerPage;
            $offset = ($page - 2) * $perPage + $firstPerPage;

            $items = $this->slice($offset, $perPage)->values();

            return new FirstDifferentLengthAwarePaginator(
                $items,
                $total,
                $firstPerPage,
                $nextPerPage,
                $perPage,
                $page,
                $options
            );
        };
    }
}