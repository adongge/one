<?php

namespace Adong\One\Console;

use Adong\One\Scaffold\ControllerCreator;
use Dcat\Admin\Scaffold\LangCreator;
use Dcat\Admin\Scaffold\ModelCreator;
use Dcat\Admin\Scaffold\RepositoryCreator;
use Dcat\Admin\Support\Helper;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PublishCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'adong:publish 
    {--force : Overwrite any existing files}
    {--migrations : Publish migrations files}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'one helper for dcat-admin with publish file to local project';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $options['--tag'] = 'adong-one-config';
        $this->call('vendor:publish', $options);
        // $options['--tag'] = 'adong-one-migrations';
        // $this->call('vendor:publish', $options);
    }
}
