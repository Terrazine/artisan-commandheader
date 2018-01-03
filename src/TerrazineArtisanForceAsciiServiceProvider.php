<?php

namespace Terrazine\ArtisanCommandHeader;

use Illuminate\Console\Command;
use Illuminate\Console\Events\CommandStarting;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Console\Kernel;
use Symfony\Component\Console\Helper\Table;

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

            try {
                $command = $this->getRegisteredCommands()[$commandStarting->command];

                $class = get_class($command);
            } catch (\Exception $e) {
                $class = \Artisan::class;
            }

            $table = new Table($commandStarting->output);
            $table
                ->setHeaders(array("<fg=blue>{$class}</>"))
            ;
            $table->render();

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

    /**
     * @return Command[] some:command => object instance
     */
    public function getRegisteredCommands() {
        return app(Kernel::class)->all();
    }
}
