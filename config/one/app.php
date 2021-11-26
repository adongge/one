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
   'menus' => [
      [
         'parent_id'     => 0,
         'order'         => 0,
         'title'         => '企业信息',
         'icon'          => 'feather icon-bar-chart-2',
         'uri'           => 'company',
         'created_at'    => \Illuminate\Support\Carbon::now()
      ]
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
         'table'        => 'service',//表名
         'class_name'   => 'Service',//实例名
         'comment'      => '预约列表',
         'primary_key'  => 'id',//主键
         'model'        => 1,
         'controller'   => 1,
         'repository'   => 1,
         'migration'    => 1,
         'migrate'      => 0,
         'timestamps'   => 0,
         'soft_deletes' => 1,
         'lang'         => 1,
         'fields' => [
            [
               'name' => 'name',
               'type' => 'string',
               'key' => '',
               'comment' => '师傅姓名',
               'translation' => '师傅姓名'
            ],
            [
               'name' => 'mobile',
               'type' => 'string',
               'key' => '',
               'comment' => '手机',
               'translation' => '手机',
               'form' => 'mobile'
            ],
            [
               'name' => 'time_start',
               'type' => 'dateTime',
               'key' => '',
               'comment' => '预约时间',
               'translation' => '预约时间',
               'form' => 'datetime'
            ],
            [
               'name' => 'total',
               'type' => 'integer',
               'key' => '',
               'default' => '0',
               'comment' => '本次服务时长',
               'translation' => '本次服务时长',
               'form' => 'number'
            ],
            [
               'name' => 'created_at',
               'type' => 'dateTime',
               'key' => '',
               'nullable' => 'on',
               'translation' => '',
               'form' => 'display'
            ],
            [
               'name' => 'updated_at',
               'type' => 'dateTime',
               'key' => '',
               'nullable' => 'on',
               'translation' => '',
               'form' => 'display'
            ]
         ]
      ],
      [
         'table'        => 'master_user',//表名
         'class_name'   => 'MasterUser',//实例名
         'comment'      => '师傅列表',
         'primary_key'  => 'id',//主键
         'model'        => 1,
         'controller'   => 1,
         'repository'   => 1,
         'migration'    => 1,
         'migrate'      => 0,
         'timestamps'   => 0,
         'soft_deletes' => 1,
         'lang'         => 1,
         'fields' => [
            [
               'name' => 'name',
               'type' => 'string',
               'key' => '',
               'comment' => '师傅名称',
               'translation' => '师傅名称'
            ],
            [
               'name' => 'mobile',
               'type' => 'string',
               'key' => '',
               'comment' => '手机',
               'translation' => '手机',
               'form' => 'mobile'
            ],
            [
               'name' => 'password',
               'type' => 'string',
               'key' => '',
               'comment' => '密码',
               'translation' => '密码',
               'form' => 'password'
            ],
            [
               'name' => 'service_id',
               'type' => 'unsignedInteger',
               'key' => '',
               'default' => '0',
               'comment' => '当前服务',
               'translation' => '当前服务',
               'form' => 'text'
            ],
            [
               'name' => 'created_at',
               'type' => 'dateTime',
               'key' => '',
               'nullable' => 'on',
               'translation' => '',
               'form' => 'display'
            ],
            [
               'name' => 'updated_at',
               'type' => 'dateTime',
               'key' => '',
               'nullable' => 'on',
               'translation' => '',
               'form' => 'display'
            ]
         ]
      ]
   ]
];
