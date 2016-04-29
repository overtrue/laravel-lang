<?php

namespace Overtrue\LaravelLang;

use Overtrue\LaravelLang\Commands\Publish as PublishCommand;
use Illuminate\Translation\TranslationServiceProvider as LaravelTranslationServiceProvider;

class TranslationServiceProvider extends LaravelTranslationServiceProvider
{
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
            $multiLangPath = app()->basePath().'/vendor/caouecs/laravel4-lang/src/';

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
        return [PublishCommand::class];
    }
}
