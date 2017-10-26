<?php

namespace Terrazine\ArtisanCommandHeader;

use Illuminate\Console\Events\CommandStarting;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class TerrazineArtisanCommandHeaderServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Event::listen(CommandStarting::class, function (CommandStarting $commandStarting) {
            $commandStarting->output->setDecorated(true);
        });
    }
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
