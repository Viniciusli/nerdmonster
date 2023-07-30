<?php

namespace App\Providers;

use App\Interfaces\TicketInterface;
use App\Repositories\TicketRespository;
use App\Services\TicketService;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $model = \App\Models\Ticket::class;

        $this->app->bind('App\Repositories\TicketRepository', function () use ($model) {
            return new TicketRespository(new $model);
        });

        $this->app->bind('App\Services\TicketService', function () use ($model) {
            return new TicketService(new TicketRespository(new $model));
        });
    }
}
