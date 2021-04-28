<?php

namespace Overtrue\LaravelLang;

use Illuminate\Translation\TranslationServiceProvider as LaravelTranslationServiceProvider;

class TranslationServiceProvider extends LaravelTranslationServiceProvider
{
    /**
     * Publish the translation files into project directory.
     */
    public function boot()
    {
        $this->publishes([
                app_path('../vendor') . '/laravel-lang/lang/src' => app_path('resources/lang/'),
            ], 'resource');
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
            $multiLangPath = app_path('../vendor') . '/laravel-lang/lang/src';

            return new FileLoader($app['files'], $app['path.lang'], $multiLangPath);
        });
    }
}
