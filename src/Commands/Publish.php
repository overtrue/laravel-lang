<?php

namespace Overtrue\LaravelLang\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class Publish extends Command
{
    /**
     * @var string
     */
    protected $signature = 'lang:publish
                            {locales=all : Comma-separated list of, eg: zh_CN,tk,th}
                            {--force : override existing files.}';

    /**
     * @var string
     */
    protected $description = 'publish language files to resources directory.';

    /**
     * Publish constructor.
     */
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
        $locale = \str_replace('_', '-', $this->argument('locales'));
        $force = $this->option('force') ? 'f' : 'n';

        $sourcePath = base_path('vendor/laravel-lang/lang/src');
        $sourceJsonPath = base_path('vendor/laravel-lang/lang/json');
        $targetPath = base_path('resources/lang/');

        if (!is_dir($targetPath) && !mkdir($targetPath)) {
            return $this->error('The lang path "resources/lang/" does not exist or not writable.');
        }

        $files = [];
        $published = [];
        $copyEnFiles = false;
        $inLumen = $this->laravel instanceof \Laravel\Lumen\Application;

        if ('all' == $locale) {
            $files = [
                \addslashes($sourcePath).'/*',
                escapeshellarg($sourceJsonPath),
            ];
            $message = 'all';
            $copyEnFiles = true;
        } else {
            foreach (explode(',', $locale) as $filename) {
                if ('en' === $locale) {
                    $copyEnFiles = true;

                    continue;
                }
                $file = $sourcePath.'/'.trim($filename);
                $jsonFile = $sourceJsonPath.'/'.trim($filename).'.json';

                if (!file_exists($file)) {
                    $this->error("'$filename' not found.");

                    continue;
                }

                $published[] = $filename;
                $files[] = escapeshellarg($file);

                if (!file_exists($jsonFile)) {
                    $this->error("'$filename' not found.");

                    continue;
                }
                $files[] = escapeshellarg($jsonFile);
            }

            if (empty($files)) {
                return;
            }

            $message = json_encode($published);
        }

        if ($inLumen && $copyEnFiles) {
            $files[] = escapeshellarg(base_path('vendor/laravel/lumen-framework/resources/lang/en'));
        }

        $files = implode(' ', $files);
        $targetPath = escapeshellarg($targetPath);
        $command = "cp -r{$force} {$files} {$targetPath}";
        $process = \method_exists(Process::class, 'fromShellCommandline') ? Process::fromShellCommandline($command) : new Process($command);

        $process->run(function ($type, $buffer) {
            if (Process::ERR === $type) {
                return $this->error(trim($buffer));
            }
        });

        $type = ('f' == $force) ? 'overwrite' : 'no overwrite';

        $this->info("published languages <comment>({$type})</comment>: {$message}.");
    }
}
