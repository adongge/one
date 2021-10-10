<?php

namespace Adong\One\Console;

use Adong\One\Scaffold\ControllerCreator;
use Dcat\Admin\Scaffold\LangCreator;
use Dcat\Admin\Scaffold\MigrationCreator;
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
        $list = config('one.app.list');
        foreach ($list as $item) {
            $path = [];
            $model = 'App\\Models\\'.$item['class_name'];
            $path = Helper::guessClassFileName($model);
            // $files->delete($path);
            if (!$files->exists($path) && isset($item['model']) && $item['class_name']) {
                $paths['model'] = (new ModelCreator($item['table'], $model))
                                ->create( $item['primary_key'], $item['timestamps'], $item['soft_deletes']);
                $this->comment('created model:'.$path);
            }
            $controller = 'App\\Admin\\Controllers\\'.$item['class_name'].'Controller';
            $path = Helper::guessClassFileName($controller);
            // $files->delete($path);
            if (!$files->exists($path) && isset($item['controller']) && $item['controller']) {
                $paths['controller'] = (new ControllerCreator($controller))->create($item);
                $this->comment('created controller:'.$path);
            }
            if($item['lang']){
                $paths['lang'] = (new LangCreator($item['fields']))->create($controller);
                $this->comment('created lang');
            }
            if($item['repository']){
                $repositories = 'App\\Admin\\Repositories\\'.$item['class_name'];
                $paths['repository'] = (new RepositoryCreator())->create($item['class_name'], $repositories);
                $this->comment('created repository');
            }
            if ($item['migration']) {
                $migrationName = 'create_'.$item['table'].'_table';
                $paths['migration'] = (new MigrationCreator(app('files')))->buildBluePrint(
                    $item['fields'],
                    $item['primary_key'],
                    $item['timestamps'] == 1,
                    $item['soft_deletes'] == 1
                )->create($migrationName, database_path('migrations'), config('one.app.replace_prefix').$item['table']);
            }
        }
        $this->info('create success');
    }
}
