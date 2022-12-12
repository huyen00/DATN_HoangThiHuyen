<?php

namespace App\Providers;

use App\Services\ACLService\ACLRepository;
use App\Services\ConfigService\ConfigRepository;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;
use Illuminate\Http\Resources\Json\JsonResource;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            ConfigRepository::class,
            config('file-manager.configRepository')

        );


        // // ACL Repository
        $this->app->bind(
            ACLRepository::class,
            $this->app->make(ConfigRepository::class)->getAclRepository()
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        JsonResource::withoutWrapping();
        Inertia::share([
            'locale' => function () {
                return app()->getLocale();
            },
            'language' => function () {
                return translations(
                    resource_path('lang/' . app()->getLocale() . '.json')
                );
            },
        ]);
    }
}
