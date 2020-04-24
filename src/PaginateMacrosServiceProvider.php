<?php


namespace Flagstudio\PaginateMacros;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class PaginateMacrosServiceProvider extends ServiceProvider
{
    public function register()
    {
        Collection::make(glob(__DIR__ . '/CollectionMacros/*.php'))
            ->map(function ($path) {
                return pathinfo($path, PATHINFO_FILENAME);
            })
            ->reject(function ($macro) {
                return Collection::hasMacro($macro);
            })
            ->each(function ($macro) {
                $macroClass = 'Flagstudio\\PaginateMacros\\CollectionMacros\\' . $macro;
                Collection::macro(Str::camel($macro), app($macroClass)());
            });

        Collection::make(glob(__DIR__ . '/BuilderMacros/*.php'))
            ->map(function ($path) {
                return pathinfo($path, PATHINFO_FILENAME);
            })
            ->reject(function ($macro) {
                return Builder::hasGlobalMacro($macro);
            })
            ->each(function ($macro) {
                $macroClass = 'Flagstudio\\PaginateMacros\\BuilderMacros\\' . $macro;
                Builder::macro(Str::camel($macro), app($macroClass)());
            });
    }
}
