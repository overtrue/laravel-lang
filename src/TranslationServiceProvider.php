<?php

namespace Overtrue\LaravelLang;

use Overtrue\LaravelLang\Commands\Publish as PublishCommand;
use Illuminate\Translation\TranslationServiceProvider as LaravelTranslationServiceProvider;

class TranslationServiceProvider extends LaravelTranslationServiceProvider
{
    /**
     * @var bool
     */
    protected $inLumen = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app instanceof \Laravel\Lumen\Application) {
            $this->inLumen = true;

            $this->app->configure('app');

            unset($this->app->availableBindings['translator']);
        }

        parent::register();

        $this->registerCommands();
    }

    /**
     * Register the translation line loader.
     *
     * @return void
     */
    protected function registerLoader()
    {
        $this->app->singleton('translation.loader', function($app)
        {
            $paths = [
                app()->basePath('vendor/caouecs/laravel-lang/src/'),
            ];

            if ($this->inLumen) {
                $this->app['path.lang'] = app()->basePath('vendor/laravel/lumen-framework/resources/lang');
                array_push($paths, app()->basePath('resources/lang/'));
            }

            return new FileLoader($app['files'], $app['path.lang'], $paths);
        });
    }

    /**
     * Register lang:publish command.
     *
     * @return void
     */
    protected function registerCommands()
    {
        $this->commands(PublishCommand::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array_merge(parent::provides(), [PublishCommand::class]);
    }
}
