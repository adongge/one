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
         'title'         => '企业基础信息',
         'uri'           => 'company',
         'parent_id'     => 0,
         'order'         => 0,
         'icon'          => 'feather icon-book',
         'created_at'    => \Illuminate\Support\Carbon::now()
      ],
      [
         'title'         => '投入品管理',
         'uri'           => 'inputs',
         'parent_id'     => 0,
         'order'         => 0,
         'icon'          => 'feather icon-box',
         'created_at'    => \Illuminate\Support\Carbon::now()
      ],
      [
         'title'         => '生产管理',
         'uri'           => 'produce',
         'parent_id'     => 0,
         'order'         => 0,
         'icon'          => 'feather icon-grid',
         'created_at'    => \Illuminate\Support\Carbon::now()
      ],
      [
         'title'         => '加工管理',
         'uri'           => 'process',
         'parent_id'     => 0,
         'order'         => 0,
         'icon'          => 'feather icon-shopping-cart',
         'created_at'    => \Illuminate\Support\Carbon::now()
      ],
      [
         'title'         => '销售流向',
         'uri'           => 'sale',
         'parent_id'     => 0,
         'order'         => 0,
         'icon'          => 'feather icon-file-text',
         'created_at'    => \Illuminate\Support\Carbon::now()
      ],
      [
         'title'         => '企业内审管理',
         'uri'           => 'check',
         'parent_id'     => 0,
         'order'         => 0,
         'icon'          => 'feather icon-edit',
         'created_at'    => \Illuminate\Support\Carbon::now()
      ],
      [
         'title'         => '检测信息',
         'uri'           => 'testing',
         'parent_id'     => 0,
         'order'         => 0,
         'icon'          => 'feather icon-file',
         'created_at'    => \Illuminate\Support\Carbon::now()
      ],
      [
         'title'         => '产品召回',
         'uri'           => 'recall',
         'parent_id'     => 0,
         'order'         => 0,
         'icon'          => 'feather icon-rotate-cw',
         'created_at'    => \Illuminate\Support\Carbon::now()
      ],
      [
         'title'         => '追溯信息',
         'uri'           => 'review',
         'parent_id'     => 0,
         'order'         => 0,
         'icon'          => 'feather icon-search',
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
