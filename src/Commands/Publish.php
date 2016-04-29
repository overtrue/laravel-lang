<?php

/*
 * This file is part of the overtrue/laravel-lang.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Overtrue\LaravelLang\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class Publish extends Command
{
    protected $signature = 'lang:publish
                            {locales=all : Comma-separated list of, eg: zh_CN,tk,th}
                            {--force : override existing files.}';

    protected $description = 'publish language files to resources directory.';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $locale = $this->argument('locales');
        $force = $this->option('force') ? 'f' : 'n';

        $sourcePath = app()->basePath().'/vendor/caouecs/laravel-lang/src';
        $targetPath = app()->basePath().'/resources/lang/';

        if (!is_dir($targetPath) || !is_writable($targetPath)) {
            return $this->error('The lang path "resources/lang/" does not exist or not writable.');
        }

        $files = [];
        $published = [];

        if ($locale == 'all') {
            $files = $sourcePath.'/*';
            $message = 'all';
        } else {
            foreach (explode(',', $locale) as $filename) {
                $file = $sourcePath.'/'.trim($filename);

                if (!file_exists($file)) {
                    $this->error("lang '$filename' not found.");
                    continue;
                }

                $published[] = $filename;
                $files[] = $file;
            }

            $files = implode(' ', $files);
            $message = json_encode($published);
        }

        $process = new Process("cp -r{$force} $files $targetPath");

        $process->run(function ($type, $buffer) {
            if (Process::ERR === $type) {
                return $this->error(trim($buffer));
            }
        });

        $type = ($force == 'f') ? 'no overwrite' : 'overwrite';

        $this->info("published languages <comment>({$type})</comment>: {$message}.");
    }
}
