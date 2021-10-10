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
   'list' => [
      [
         'table'        => 'adong_table',
         'model'        => 'App\Models\AdongTable',
         'controller'   => 'App\Admin\Controllers\AdongTableController',
         'repository'     => '',
         'migration'    => '',
         'migrate'      => '',
         'primary_key'  => 'id',
         'timestamps'   => 1,
         'soft_deletes' => 1,
         'lang'         => 1,
         'fields' => [
            [
               'name' => 'id',
               'type' => 'unsignedBigInteger',
               'key' => 'PRI',
               'nullable' => 'NO',
               'comment' => '',
               'default' => '',
               'translation' => ''
            ],
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
               'name' => 'order',
               'type' => 'integer',
               'key' => '',
               'nullable' => 'NO',
               'comment' => '',
               'default' => '0',
               'translation' => ''
            ],
            [
               'name' => 'title',
               'type' => 'string',
               'key' => '',
               'nullable' => 'NO',
               'comment' => '',
               'default' => '',
               'translation' => ''
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
            ],
            [
               'name' => 'uri',
               'type' => 'string',
               'key' => '',
               'nullable' => 'YES',
               'comment' => '',
               'default' => '',
               'translation' => ''
            ],
            [
               'name' => 'created_at',
               'type' => 'timestamp',
               'key' => '',
               'nullable' => 'YES',
               'comment' => '',
               'default' => '',
               'translation' => ''
            ],
            [
               'name' => 'updated_at',
               'type' => 'timestamp',
               'key' => '',
               'nullable' => 'YES',
               'comment' => '',
               'default' => '',
               'translation' => ''
            ]
         ]
      ]
   ]
];
