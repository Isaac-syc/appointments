<?php

namespace Src\Agenda\Services\Application\Providers;


use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            \Src\Agenda\Services\Domain\Repositories\ServiceRepositoryInterface::class,
            \Src\Agenda\Services\Application\Repositories\Eloquent\ServiceRepository::class
        );
    }
}
