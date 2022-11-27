<?php

namespace Adong\One\Console;

use Adong\One\Scaffold\ControllerCreator;
use Adong\One\Scaffold\OneLangCreator;
use Adong\One\Scaffold\V2MigrationCreator as MigrationCreator;
// use Dcat\Admin\Scaffold\MigrationCreator as OneMigrationCreator;

use Dcat\Admin\Models\Menu;
use Dcat\Admin\Models\Permission;
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
     * 创建菜单，子菜单。根据 title 和 uri 判断是否已经存在
     * @return void
     */
    private function createMenu($item)
    {
        $children = false;
        $where = ['title' => $item['title'], 'uri' => $item['uri']];
        isset($item['children']) && $children = $item['children'];
        unset($item['children']);
        $menu = Menu::query()->firstOrCreate($where, $item);
        if ($children) {
            foreach ($children as $child) {
                $child['parent_id'] = $menu->id;
                $this->createMenu($child);
            }
        }
    }

    private function runCreateMenu()
    {
        $data = config('one.app.menus');
        foreach ($data as $item) {
            $this->createMenu($item);
        }
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
        $permissions = [];
        foreach ($list as $item) {
            $path = [];
            $model = 'App\\Models\\'.$item['class_name'];
            $path = Helper::guessClassFileName($model);
            // $files->delete($path);
            //生成Model
            if (!$files->exists($path) && isset($item['model']) && $item['class_name']) {
                $paths['model'] = (new ModelCreator(config('one.app.replace_prefix').$item['table'], $model))
                                ->create( $item['primary_key'], $item['timestamps'], $item['soft_deletes']);
                $this->comment('created model:'.$path);
            }
            //生成Controller 对应路由信息、权限信息
            $controller = 'App\\Admin\\Controllers\\'.$item['class_name'].'Controller';
            if(isset($item['controller']) && $item['controller']){
                $route [] = [ 
                    'source' => "   \$router->resource('".$item['menu']."', '".$item['class_name']."Controller');",
                    'comment' => $item['comment'] ,
                    'uri' => "{$item['menu']}/{$item['table']}"
                ];
                //为Controller 添加权限
                $permissions [] = [
                    'name' => $item['comment'],
                    'slug' => $item['menu'].'.'.$item['table'],
                    'http_path' => '/'.$item['menu'].'/'.$item['table'].'*'
                ];
            }
            $path = Helper::guessClassFileName($controller);
            // $files->delete($path);
            //生成Controller
            if (!$files->exists($path) && isset($item['controller']) && $item['controller']) {
                $paths['controller'] = (new ControllerCreator($controller))->create($item);
                $this->comment('created controller:'.$path);
            }
            //生成lang
            if($item['lang']){
                $paths['lang'] = (new OneLangCreator($item))->create($controller, $item['comment']);
                $this->comment('created lang:'.$paths['lang']);
            }
            //生成 Repository
            if($item['repository']){
                $repositories = 'App\\Admin\\Repositories\\'.$item['class_name'];
                $paths['repository'] = (new RepositoryCreator())->create($item['class_name'], $repositories);
                $this->comment('created repository'.$paths['repository']);
            }
            //生成Migration
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
            // 执行 migrate.
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
        //生成菜单
        $this->runCreateMenu();
        $permission = [];
        $createdAt = date('Y-m-d H:i:s');
        // 输出路由推荐配置
        foreach ($route as $r) {
            $this->info($r['source']);
        }
        //添加权限
        foreach ($permissions as $p) {
            if(!Permission::query()->where('slug',$p['slug'])->exists()){
                $permission [] =  [
                    'parent_id'     => 0,
                    'order'         => 1,
                    'name'         => $p['name'],
                    'slug'           => $p['slug'],
                    'http_path'           => $p['http_path'],
                    'created_at'    => $createdAt,
                ];
            }
        }
        //添加权限
        if($menus = config('one.app.menus')){
            foreach ($menus as $cm) {
                $slug = $cm['uri'] ?? $cm['slug'];
                if(!Permission::query()->where('slug',$slug)->exists()){
                    $this->info('add parent permission '.$slug);
                    $permission [] =  [
                        'parent_id'     => 0,
                        'order'         => 1,
                        'name'         => $cm['title'],
                        'slug'           => $slug,
                        'http_path'           => '',
                        'created_at'    => $createdAt,
                    ];
                }
            }
        }
        if($permission){
            try {
                Permission::query()->insert($permission);
            } catch (\Throwable $e) {
                $this->error('add permission error'.$e->getMessage());
            }
        }
        
    }
}
