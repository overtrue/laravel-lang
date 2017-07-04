<?php

/*
 * This file is part of the overtrue/laravel-lang.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Overtrue\LaravelLang;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Translation\FileLoader as LaravelTranslationFileLoader;

class FileLoader extends LaravelTranslationFileLoader
{
    /**
     * @var string
     */
    protected $paths;

    /**
     * Create a new file loader instance.
     *
     * @param \Illuminate\Filesystem\Filesystem $files
     * @param array                             $path
     */
    public function __construct(Filesystem $files, $path, $paths = [])
    {
        $this->paths = $paths;

        parent::__construct($files, $path);
    }

    /**
     * Load the messages for the given locale.
     *
     * @param string $locale
     * @param string $group
     * @param string $namespace
     *
     * @return array
     */
    public function load($locale, $group, $namespace = null)
    {
        $defaults = [];

        foreach ($this->paths as $path) {
            $defaults = array_replace_recursive($defaults, $this->loadPath($path, $locale, $group));
        }

        return array_replace_recursive($defaults, parent::load($locale, $group, $namespace));
    }

    /**
     * Fall back to base locale (i.e. de) if a countries specific locale (i.e. de-CH) is not available.
     *
     * @param string $path
     * @param string $locale
     * @param string $group
     *
     * @return array
     */
    protected function loadPath($path, $locale, $group)
    {
        $result = parent::loadPath($path, $locale, $group);

        if (empty($result) && str_contains($locale, '-')) {
            return parent::loadPath($path, strstr($locale, '-', true), $group);
        }

        return $result;
    }
}
