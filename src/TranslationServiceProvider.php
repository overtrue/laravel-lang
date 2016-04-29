<?php

namespace Overtrue\LaravelLang;

use Overtrue\LaravelLang\Commands\Publish as PublishCommand;
use Illuminate\Translation\TranslationServiceProvider as LaravelTranslationServiceProvider;

class TranslationServiceProvider extends LaravelTranslationServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
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
            $multiLangPath = app()->basePath().'/vendor/caouecs/laravel-lang/src/';

            return new FileLoader($app['files'], $app['path.lang'], $multiLangPath);
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
