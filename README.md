# Set of Laravel Builder and Collection macros for pagination

## Installation

You can pull in the package via composer:

```bash
composer require flagstudio/laravel-collection-paginate
```

The package will automatically register itself.

## Macros

These macros are used for Eloquent Builder and Collection. The main difference in using pagination on a collection or builder is that
builder has not yet perform the database request, i.e. paginate will perform request to get needed amount of records from database. Collection already have all elements and paginate will not perform any database requests.

- [`paginate`](#paginate)
- [`paginateFirstDifferent`](#paginateFirstDifferent)
- [`paginateWithPrevious`](#paginateFirstDifferent)

### `paginate`

Create a `LengthAwarePaginator` instance from Builder or Collection.

```php
collect($posts)->paginate(5); // From Collection instance
Post::orderBy('created_at', 'desc')->get()->paginate(5); // From Collection instance
Post::orderBy('created_at', 'desc')->paginate(5); // From Builder instance
```

This paginates the contents of `$posts` with 5 items per page. `paginate` accept some options, head over to [the Laravel docs](https://laravel.com/docs/7.x/pagination) for an in-depth guide.

### `paginateFirstDifferent`

Create a `FirstDifferentLengthAwarePaginator.php` instance which extend `LengthAwarePaginator` from Builder or Collection.

```php
collect($posts)->paginateFirstDifferent(10, 5); // From Collection instance
Post::orderBy('created_at', 'desc')->get()->paginateFirstDifferent(5); // From Collection instance
Post::orderBy('created_at', 'desc')->paginateFirstDifferent(5); // From Builder instance
```

This paginates the contents of `$posts` with 10 items at first page and 5 items for next pages. `paginateFirstDifferent` accepts same options as [`paginate`](#paginate) but instead of `$perPage` accepts two parameters `$firstPerPage` and `$nextPerPage`

### `paginateWithPrevious`

Create a `LengthAwarePaginator` instance from Builder or Collection.

```php
collect($posts)->paginateWithPrevious(5); // From Collection instance
Post::orderBy('created_at', 'desc')->get()->paginateWithPrevious(5); // From Builder instance
Post::orderBy('created_at', 'desc')->paginateWithPrevious(5); // From Builder instance
```

This paginates the contents of `$posts` with 5 items per page but takes all posts from first to current page. At example if current page equals 5 then `paginateWithPrevious` will return 25 posts (5 per each page). It useful if you want load all posts for current page after reloading page or share link with pagination (https://website.com/posts?page=5). `paginateWithPrevious` accepts same options as [`paginate`](#paginate)