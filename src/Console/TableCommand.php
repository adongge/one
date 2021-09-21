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

class TableCommand extends Command
{
    public $dbTypes = [
        'string', 'integer', 'text', 'float', 'double', 'decimal', 'boolean', 'date', 'time',
        'dateTime', 'timestamp', 'char', 'mediumText', 'longText', 'tinyInteger', 'smallInteger',
        'mediumInteger', 'bigInteger', 'unsignedTinyInteger', 'unsignedSmallInteger', 'unsignedMediumInteger',
        'unsignedInteger', 'unsignedBigInteger', 'enum', 'json', 'jsonb', 'dateTimeTz', 'timeTz',
        'timestampTz', 'nullableTimestamps', 'binary', 'ipAddress', 'macAddress',
    ];

    public $dataTypeMap = [
        'int'                => 'integer',
        'int@unsigned'       => 'unsignedInteger',
        'tinyint'            => 'tinyInteger',
        'tinyint@unsigned'   => 'unsignedTinyInteger',
        'smallint'           => 'smallInteger',
        'smallint@unsigned'  => 'unsignedSmallInteger',
        'mediumint'          => 'mediumInteger',
        'mediumint@unsigned' => 'unsignedMediumInteger',
        'bigint'             => 'bigInteger',
        'bigint@unsigned'    => 'unsignedBigInteger',

        'date'      => 'date',
        'time'      => 'time',
        'datetime'  => 'dateTime',
        'timestamp' => 'timestamp',

        'enum'   => 'enum',
        'json'   => 'json',
        'binary' => 'binary',

        'float'   => 'float',
        'double'  => 'double',
        'decimal' => 'decimal',

        'varchar'    => 'string',
        'char'       => 'char',
        'text'       => 'text',
        'mediumtext' => 'mediumText',
        'longtext'   => 'longText',
    ];
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'adong:tables';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'one helper for dcat-admin with database tables';

     /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->line('one helper command');
        $db = config('database.connections.mysql.database');
        $tables =  $this->tableList($db, config('one.except'));
        foreach ($tables as $name) {
            $fields = $this->tableData($db, $name);
            $modelName = ucfirst(Str::of($name)->camel());
            $item = [
                'table'        => $name,
                'model'        => 'App\\Models\\'.$modelName,
                'controller'   => 'App\\Admin\\Controllers\\'.$modelName.'Controller',
                'repository'   => 'App\\Admin\\Repositories\\'.$modelName,
                'migration'    => '',
                'migrate'      => '',
                'primary_key'  => 'id',
                'timestamps'   => 1,
                'soft_deletes' => 1,
                'lang'         => 1
            ];
            $files = app('files');
            $item['fields'] = $fields;
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
            $paths['lang'] = (new LangCreator($fields))->create($item['controller']);
            $paths['repository'] = (new RepositoryCreator())->create($item['model'], $item['repository']);
        }
        $this->info('success');
    }

     /**
     * @return array
     */
    private function tableList($db,$except=[])
    {
        $tmp = DB::table('information_schema.columns')
            ->where('table_schema', $db)
            ->whereNotIn('TABLE_NAME', $except)
            ->groupBy('TABLE_NAME')
            ->pluck('TABLE_NAME')
            ->toArray();
        return $tmp;
    }

    /**
     * @return array
     */
    private function tableData($db, $table)
    {
        if (! $table || ! $db) {
            return false;
        }
        $tables = collect($this->getDatabaseColumns($db, $table))
            ->filter(function ($v, $k) use ($db) {
                return $k == $db;
            })
            ->map(function ($v) use ($table) {
                return Arr::get($v, $table);
            })
            ->filter()
            ->first();
        $res = [];
        foreach ($tables as $key => $item) {
            $tc = new TableCommand();
            $temp = [];
            if(isset($item['type']))
                $temp['type'] = $tc->dataTypeMap[$item['type']];
            $temp['name'] = $key;
            $temp['key'] = $item['key'];
            $temp['nullable'] = $item['nullable'];
            $temp['comment'] = $item['comment'];
            $temp['default'] = $item['default'];
            $temp['translation'] = $item['comment'];
            $res [] = $temp;
        }
        return $res;
    }

     /**
     * @return array
     */
    private function getDatabaseColumns($db = null, $tb = null)
    {
        $databases = Arr::where(config('database.connections', []), function ($value) {
            $supports = ['mysql'];

            return in_array(strtolower(Arr::get($value, 'driver')), $supports);
        });

        $data = [];

        try {
            foreach ($databases as $connectName => $value) {
                if ($db && $db != $value['database']) {
                    continue;
                }

                $sql = sprintf('SELECT * FROM information_schema.columns WHERE table_schema = "%s"', $value['database']);

                if ($tb) {
                    $p = Arr::get($value, 'prefix');

                    $sql .= " AND TABLE_NAME = '{$p}{$tb}'";
                }

                $tmp = DB::connection($connectName)->select($sql);

                $collection = collect($tmp)->map(function ($v) use ($value) {
                    if (! $p = Arr::get($value, 'prefix')) {
                        return (array) $v;
                    }
                    $v = (array) $v;

                    $v['TABLE_NAME'] = Str::replaceFirst($p, '', $v['TABLE_NAME']);

                    return $v;
                });

                $data[$value['database']] = $collection->groupBy('TABLE_NAME')->map(function ($v) {
                    return collect($v)->keyBy('COLUMN_NAME')->map(function ($v) {
                        $v['COLUMN_TYPE'] = strtolower($v['COLUMN_TYPE']);
                        $v['DATA_TYPE'] = strtolower($v['DATA_TYPE']);

                        if (Str::contains($v['COLUMN_TYPE'], 'unsigned')) {
                            $v['DATA_TYPE'] .= '@unsigned';
                        }

                        return [
                            'type'     => $v['DATA_TYPE'],
                            'default'  => $v['COLUMN_DEFAULT'],
                            'nullable' => $v['IS_NULLABLE'],
                            'key'      => $v['COLUMN_KEY'],
                            'id'       => $v['COLUMN_KEY'] === 'PRI',
                            'comment'  => $v['COLUMN_COMMENT'],
                        ];
                    })->toArray();
                })->toArray();
            }
        } catch (\Throwable $e) {

        }
        return $data;
    }

}
