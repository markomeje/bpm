<?php

namespace App\Providers;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Models\Sanctum\Token;
use Illuminate\Pagination\{Paginator, LengthAwarePaginator};
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\URL;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (!$this->app->environment('production')) {
            $this->app->register('App\Providers\FakerServiceProvider');
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (in_array(env('APP_ENV'), ['production', 'review'])) {
            $this->app['request']->server->set('HTTPS','on');
            URL::forceScheme('https');
            \Event::listen(App\Console\Commands\PrefixCommand::class);
        }

        Sanctum::usePersonalAccessTokenModel(Token::class);
        Schema::defaultStringLength(191);
        Paginator::useBootstrap();

        Collection::macro('paginate', function($perPage, $total = null, $page = null, $pageName = 'page') {
            $page = $page ?: LengthAwarePaginator::resolveCurrentPage($pageName);
            return new LengthAwarePaginator(
                $this->forPage($page, $perPage), $total ?: $this->count(), $perPage, $page, ['path' => LengthAwarePaginator::resolveCurrentPath(), 'pageName' => $pageName]
            );
        });

        Builder::macro('search', function ($attributes, string $searchTerm) {
            $this->where(function (Builder $query) use ($attributes, $searchTerm) {
                foreach (Arr::wrap($attributes) as $attribute) {
                    $query->when(
                        str_contains($attribute, '.'), function (Builder $query) use ($attribute, $searchTerm) {
                            [$relationName, $relationAttribute] = explode('.', $attribute);

                            $query->orWhereHas($relationName, function (Builder $query) use ($relationAttribute, $searchTerm) {
                                $query->where($relationAttribute, 'LIKE', "%{$searchTerm}%");
                            });
                        }, function (Builder $query) use ($attribute, $searchTerm) {
                            $query->orWhere($attribute, 'LIKE', "%{$searchTerm}%");
                        }
                    );
                }
            });

            return $this;
        });

    }
}