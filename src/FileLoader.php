<?php

namespace Overtrue\LaravelLang;

use Illuminate\Translation\FileLoader as LaravelTranslationFileLoader;
use Illuminate\Filesystem\Filesystem;

class FileLoader extends LaravelTranslationFileLoader
{
    /**
     * @var string
     */
    protected $paths;

    /**
     * Create a new file loader instance.
     *
     * @param  \Illuminate\Filesystem\Filesystem  $files
     * @param  array  $path
     * @return void
     */
    public function __construct(Filesystem $files, $path, $paths = [])
    {
        $this->paths = $paths;

        parent::__construct($files, $path);
    }

    /**
     * Load the messages for the given locale.
     *
     * @param  string  $locale
     * @param  string  $group
     * @param  string  $namespace
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
}