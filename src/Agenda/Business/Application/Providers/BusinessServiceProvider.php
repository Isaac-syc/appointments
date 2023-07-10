<?php

namespace Src\Agenda\Business\Application\Providers;


use Illuminate\Support\ServiceProvider;

class BusinessServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            \Src\Agenda\Business\Domain\Repositories\BusinessRepositoryInterface::class,
            \Src\Agenda\Business\Application\Repositories\Eloquent\BusinessRepository::class
        );
    }
}
