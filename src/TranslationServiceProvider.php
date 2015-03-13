<?php

namespace Overtrue\LaravelLang;

use Illuminate\Translation\TranslationServiceProvider as LaravelTranslationServiceProvider;

class TranslationServiceProvider extends LaravelTranslationServiceProvider
{
    const MULTI_LANG_PATH = __DIR__ . '/../../../caouecs/laravel4-lang';

    /**
     * Register the translation line loader.
     *
     * @return void
     */
    protected function registerLoader()
    {
        $this->app->singleton('translation.loader', function($app)
        {
            return new FileLoader($app['files'], $app['path.lang'], self::MULTI_LANG_PATH);
        });
    }
}