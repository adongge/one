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
   'replace_prefix' => 'dasf_',
   // 'integer',
   // 'unsignedInteger',
   // 'tinyInteger',
   // 'unsignedTinyInteger',
   // 'smallInteger',
   // 'unsignedSmallInteger',
   // 'mediumInteger',
   // 'unsignedMediumInteger',
   // 'bigInteger',
   // 'unsignedBigInteger',
   // 'date',
   // 'time',
   // 'dateTime',
   // 'timestamp',
   // 'enum',
   // 'json',
   // 'binary',
   // 'float',
   // 'double',
   // 'decimal',
   // 'string',
   // 'char',
   // 'text',
   // 'mediumText',
   // 'longText'
   'list' => [
      [
         'table'        => 'dasf_user',//表名
         'class_name'   => 'DUser',//实例名
         'primary_key'  => 'id',//主键
         'model'        => 1,
         'controller'   => 1,
         'repository'   => 1,
         'migration'    => 1,
         'migrate'      => 0,
         'timestamps'   => 1,
         'soft_deletes' => 1,
         'lang'         => 1,
         // $table->string('name')->comment('预约人');
         // $table->string('mobile')->unique()->comment('手机');
         // $table->dateTime('time_start')->comment('预约时间');
         // $table->integer('total')->comment('本次服务');
         // $table->dateTime('created_at')->nullable();
         // $table->dateTime('updated_at')->nullable();
         // $table->dateTime('deleted_at')->nullable();
         'fields' => [
            [
               'name' => 'name',
               'type' => 'string',
               'key' => '',
               'nullable' => 'NO',
               'comment' => '预约人',
               'translation' => '预约'
            ],
            [
               'name' => 'mobile',
               'type' => 'string',
               'key' => '',
               'nullable' => 'NO',
               'comment' => '手机',
               'translation' => '手机',
               'form' => 'mobile'
            ]
         ]
      ]
   ]
];
