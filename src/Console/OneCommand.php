<?php

namespace Adong\One\Console;

use Adong\One\Scaffold\ControllerCreator;
use Dcat\Admin\Scaffold\ModelCreator;
use Dcat\Admin\Support\Helper;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;

class OneCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'adong';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'one helper for dcat-admin';

     /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->line('one helper command');

        if (!file_exists(config_path('one').'.php')) {
            $this->call('vendor:publish', ['--tag' => 'adong-one-config']);
            $this->call('view:clear');
        }
        $files = app('files');

        $list = config('one.list');
        foreach ($list as $item) {
            $path = [];
            $path = Helper::guessClassFileName($item['model']);
            $files->delete($path);
            if (!$files->exists($path)) {
                $paths['model'] = (new ModelCreator($item['table'], $item['model']))
                            ->create( $item['primary_key'], $item['timestamps'], $item['soft_deletes']);
                $this->comment('created model:'.$path);
            }
            $path = Helper::guessClassFileName($item['controller']);
            $files->delete($path);
            if (!$files->exists($path)) {
                $paths['controller'] = (new ControllerCreator($item['controller']))
                                ->create($item);
                $this->comment('created controller:'.$path);
            }
        }
        $this->info('create success');
    }
}
