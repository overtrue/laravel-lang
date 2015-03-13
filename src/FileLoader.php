<?php

namespace Overtrue\LaravelLang;

use Illuminate\Translation\FileLoader as LaravelTranslationFileLoader;
use Illuminate\Filesystem\Filesystem;

class FileLoader extends LaravelTranslationFileLoader
{
    /**
     * 37 languages dir.
     *
     * @var string
     */
    protected $multiLangPath;


    /**
     * Create a new file loader instance.
     *
     * @param  \Illuminate\Filesystem\Filesystem  $files
     * @param  string  $path
     * @return void
     */
    public function __construct(Filesystem $files, $path, $multiLangPath)
    {
        $this->multiLangPath = $multiLangPath;

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
        $defaults = $this->loadPath($this->multiLangPath, $locale, $group);

        return array_replace_recursive($defaults, parent::load($locale, $group, $namespace));
    }
}