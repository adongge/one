<?php

namespace Adong\One\Console;

use Adong\One\Scaffold\ControllerCreator;
use Adong\One\Scaffold\OneLangCreator;
use Dcat\Admin\Models\Menu;
use Dcat\Admin\Scaffold\MigrationCreator;
use Dcat\Admin\Scaffold\ModelCreator;
use Dcat\Admin\Scaffold\RepositoryCreator;
use Dcat\Admin\Support\Helper;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

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

    private function checkMigrateFile($files, $migrationName)
    {
        if ($migrationPath = database_path('migrations')) {
            $migrationFiles = $files->glob($migrationPath.'/*'.$migrationName.'*.php');
            if($migrationFiles){
                return false;
            }
        }
        return true;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->line('one helper command');
        $files = app('files');
        $list = config('one.app.list');
        $route = [];
        foreach ($list as $item) {
            $path = [];
            $model = 'App\\Models\\'.$item['class_name'];
            $path = Helper::guessClassFileName($model);
            // $files->delete($path);
            if (!$files->exists($path) && isset($item['model']) && $item['class_name']) {
                $paths['model'] = (new ModelCreator(config('one.app.replace_prefix').$item['table'], $model))
                                ->create( $item['primary_key'], $item['timestamps'], $item['soft_deletes']);
                $this->comment('created model:'.$path);
            }
            $controller = 'App\\Admin\\Controllers\\'.$item['class_name'].'Controller';
            $route [] = [ 
                'source' => "   \$router->resource('/".$item['table']."', '".$item['class_name']."Controller');",
                'comment' => $item['comment'] ,
                'uri' => "{$item['table']}"
            ];
            $path = Helper::guessClassFileName($controller);
            // $files->delete($path);
            if (!$files->exists($path) && isset($item['controller']) && $item['controller']) {
                $paths['controller'] = (new ControllerCreator($controller))->create($item);
                $this->comment('created controller:'.$path);
            }
            if($item['lang']){
                $paths['lang'] = (new OneLangCreator($item))->create($controller, $item['comment']);
                $this->comment('created lang:'.$paths['lang']);
            }
            if($item['repository']){
                $repositories = 'App\\Admin\\Repositories\\'.$item['class_name'];
                $paths['repository'] = (new RepositoryCreator())->create($item['class_name'], $repositories);
                $this->comment('created repository');
            }
            if ($item['migration']) {
                $migrationName = 'create_'.$item['table'].'_table';
                if($this->checkMigrateFile($files, $migrationName)){
                    $paths['migration'] = (new MigrationCreator($files))->buildBluePrint(
                        $item['fields'],
                        $item['primary_key'],
                        $item['timestamps'] == 1,
                        $item['soft_deletes'] == 1
                    )->create($migrationName, database_path('migrations'), config('one.app.replace_prefix').$item['table']);
                }
            }
            // Run migrate.
            if ($item['migrate']) {
                Artisan::call('migrate');
                $message = Artisan::output();
            }
            // Make ide helper file.
            if ($item['migrate'] || $item['controller']) {
                try {
                    Artisan::call('admin:ide-helper', ['-c' => $controller]);
                    $paths['ide-helper'] = 'dcat_admin_ide_helper.php';
                } catch (\Throwable $e) {
                }
            }
        }
        $this->info('create success');
        $menu = [];
        $createdAt = date('Y-m-d H:i:s');
        foreach ($route as $r) {
            $this->info($r['source']);
            if(!Menu::query()->where('uri',$r['uri'])->exists()){
                $menu [] =  [
                    'parent_id'     => 0,
                    'order'         => 1,
                    'title'         => $r['comment'],
                    'icon'          => 'feather icon-bar-chart-2',
                    'uri'           => $r['uri'],
                    'created_at'    => $createdAt,
                ];
            }
        }
        if($menus = config('one.app.menus')){
            foreach ($menus as $cm) {
                if(!Menu::query()->where('uri',$cm['uri'])->exists()){
                    $this->info($cm['uri']);
                    $menu [] =  $cm;
                }
            }
        }
        if($menu){
            Menu::insert($menu);
            (new Menu())->flushCache();
        }
        
    }
}
