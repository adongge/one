<?php

namespace Adong\One\Console;

use Adong\One\Scaffold\ControllerCreator;
use Dcat\Admin\Scaffold\LangCreator;
use Dcat\Admin\Scaffold\ModelCreator;
use Dcat\Admin\Scaffold\RepositoryCreator;
use Dcat\Admin\Support\Helper;
use Illuminate\Console\Command;

class ConfigCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'adong:config';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'one helper for dcat-admin with one config';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->line('one helper command');
        $files = app('files');
        $list = config('one/app.list');
        foreach ($list as $item) {
            $path = [];
            $path = Helper::guessClassFileName($item['model']);
            // $files->delete($path);
            if (!$files->exists($path) && isset($item['model']) && $item['model']) {
                $paths['model'] = (new ModelCreator($item['table'], $item['model']))
                                ->create( $item['primary_key'], $item['timestamps'], $item['soft_deletes']);
                $this->comment('created model:'.$path);
            }
            $path = Helper::guessClassFileName($item['controller']);
            // $files->delete($path);
            if (!$files->exists($path) && isset($item['controller']) && $item['controller']) {
                $paths['controller'] = (new ControllerCreator($item['controller']))->create($item);
                $this->comment('created controller:'.$path);
            }
            if($item['lang']){
                $paths['lang'] = (new LangCreator($item['fields']))->create($item['controller']);
                $this->comment('created lang');
            }
            if($item['repository']){
                $paths['repository'] = (new RepositoryCreator())->create($item['model'], $item['repository']);
                $this->comment('created repository');
            }
        }
        $this->info('create success');
    }
}
