<?php

namespace App\Providers;

use App\Services\FileStorageService;
use App\Services\MahasiswaService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(FileStorageService::class, function () {
            return new FileStorageService(storage_path('app/Data/mahasiswa.json'));
        });

        $this->app->singleton(MahasiswaService::class, function ($app) {
            return new MahasiswaService($app->make(FileStorageService::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
