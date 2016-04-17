<?php

namespace Overtrue\LaravelLang;

use Illuminate\Translation\TranslationServiceProvider as LaravelTranslationServiceProvider;

class TranslationServiceProvider extends LaravelTranslationServiceProvider
{
    /**
     * Register the translation line loader.
     *
     * @return void
     */
    protected function registerLoader()
    {
        $this->app->singleton('translation.loader', function($app)
        {
            $multiLangPath = app_path('../vendor') . '/caouecs/laravel4-lang/src';

            return new FileLoader($app['files'], $app['path.lang'], $multiLangPath);
        });
    }
}
