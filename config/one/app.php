<?php

return [
   'except' => [ //排除的表
      'admin_menu',
      'admin_operation_log',
      'admin_permissions',
      'admin_role_menu',
      'admin_permission_menu',
      'admin_role_permissions',
      'admin_roles',
      'admin_role_users',
      'admin_users',
      'failed_jobs',
      'migrations',
      'password_resets',
      'personal_access_tokens',
      'users'
   ],
   'replace_prefix' => '',
   // 'int'                => 'integer', 'int@unsigned' => 'unsignedInteger','tinyint' => 'tinyInteger',
   // 'tinyint@unsigned'   => 'unsignedTinyInteger','smallint' => 'smallInteger', 'smallint@unsigned'  => 'unsignedSmallInteger',
   // 'mediumint'          => 'mediumInteger','mediumint@unsigned' => 'unsignedMediumInteger','bigint'  => 'bigInteger',
   // 'bigint@unsigned'    => 'unsignedBigInteger','date' => 'date','time' => 'time', 'datetime'  => 'dateTime', 'timestamp' => 'timestamp',
   // 'enum'   => 'enum','json'   => 'json','binary' => 'binary', 'float'   => 'float', 'double'  => 'double','decimal' => 'decimal',
   // 'varchar'    => 'string','char' => 'char','text' => 'text','mediumtext' => 'mediumText','longtext'   => 'longText',
   'list' => [
      [
         'table'        => 'adong_table',//表名
         'class_name'   => 'AdongTable',//实例名
         'primary_key'  => 'id',//主键
         'model'        => 1,
         'controller'   => 1,
         'repository'   => 1,
         'migration'    => 1,
         'migrate'      => 1,
         'timestamps'   => 1,
         'soft_deletes' => 1,
         'lang'         => 1,
         'fields' => [
            [
               'name' => 'parent_id',
               'type' => 'bigInteger',
               'key' => '',
               'nullable' => 'NO',
               'comment' => '',
               'default' => '0',
               'translation' => '',
               'form' => 'number'
            ],
            [
               'name' => 'icon',
               'type' => 'string',
               'key' => '',
               'nullable' => 'YES',
               'comment' => '',
               'default' => '',
               'translation' => '',
               'form' => 'image'
            ]
         ]
      ]
   ]
];
