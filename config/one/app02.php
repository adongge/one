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
        // [
        //    'title'         => '产品召回',
        //    'uri'           => 'recall',
        //    'parent_id'     => 0,
        //    'order'         => 0,
        //    'icon'          => 'feather icon-rotate-cw',
        //    'created_at'    => \Illuminate\Support\Carbon::now()
        // ],
        [
            'title'         => '追溯信息',
            'uri'           => 'review',
            'parent_id'     => 0,
            'order'         => 0,
            'icon'          => 'feather icon-search',
            'created_at'    => \Illuminate\Support\Carbon::now()
        ]
    ],
    'replace_prefix' => 'zs_',
    'list' => [
        //工作组和地块问题？？？
        //检测信息 ** 要做关联关联批次？？？： 抑制率/抑制率标准 50%/检测结论/名称/检测类型/定性检测/检测时间/检测人/样品基数/处理结果/产地/备注 /质检单位/质检报告(img)/农残检测报告(img)
        //作业列表管理 **

        //企业基础信息管理
        [
            'table'        => 'company', 'class_name'   => 'Company', //表名，实例名
            'comment'      => '企业基础信息', 'primary_key'  => 'id', //主键
            'model'        => 1, 'controller'   => 1, 'repository'   => 1,
            'migration'    => 1, 'migrate'      => 0, 'timestamps'   => 1,
            'soft_deletes' => 1, 'lang'         => 1, 'menu' => 'company',
            'fields' => [
                //['name' => 'name',     'type' => 'string',       'key' => '',     'comment' => '企业名称',         'translation' => '企业名称'],
                ['name' => 'name',                       'nullable' => 'off', 'type' => 'string',           'form' => '', 'key' => '',     'comment' => '企业名称',         'translation' => '企业名称'],
                ['name' => 'short_name',                 'nullable' => 'on',  'type' => 'string',           'form' => '', 'key' => '',     'comment' => '企业简称',         'translation' => '企业简称'],
                ['name' => 'fax',                        'nullable' => 'on',  'type' => 'string',           'form' => '', 'key' => '',     'comment' => '传真',             'translation' => '传真'],
                ['name' => 'email',                      'nullable' => 'on',  'type' => 'string',           'form' => 'email', 'key' => '',     'comment' => '企业邮箱',         'translation' => '企业邮箱'],
                ['name' => 'contacts',                   'nullable' => 'on',  'type' => 'string',           'form' => '', 'key' => '',     'comment' => '联系人',           'translation' => '联系人'],
                ['name' => 'contacts_tel',               'nullable' => 'on',  'type' => 'string',           'form' => 'mobile', 'key' => '',     'comment' => '联系电话',          'translation' => '联系电话'],
                ['name' => 'industry',                   'nullable' => 'on',  'type' => 'string',           'form' => '', 'key' => '',     'comment' => '涉及行业',          'translation' => '涉及行业'],
                ['name' => 'address',                    'nullable' => 'on',  'type' => 'string',           'form' => '', 'key' => '',     'comment' => '地址',             'translation' => '地址'],
                ['name' => 'nature',                     'nullable' => 'on',  'type' => 'unsignedInteger',  'form' => 'select', 'key' => '',     'comment' => '产地性质',          'translation' => '产地性质'],
                ['name' => 'trademark',                  'nullable' => 'on',  'type' => 'string',           'form' => '', 'key' => '',     'comment' => '注册商标',          'translation' => '注册商标'],
                ['name' => 'director',                   'nullable' => 'on',  'type' => 'string',           'form' => '', 'key' => '',     'comment' => '负责人',           'translation' => '负责人'],
                ['name' => 'director_tel',               'nullable' => 'on',  'type' => 'string',           'form' => '', 'key' => '',     'comment' => '负责人电话',        'translation' => '负责人电话'],
                ['name' => 'licence',                    'nullable' => 'on',  'type' => 'string',           'form' => '', 'key' => '',     'comment' => '许可证',            'translation' => '许可证'],
                ['name' => 'standard',                   'nullable' => 'on',  'type' => 'string',           'form' => '', 'key' => '',     'comment' => '执行标准',          'translation' => '执行标准'],
                ['name' => 'is_record',                  'nullable' => 'on',  'type' => 'unsignedInteger',  'form' => 'switch', 'key' => '',     'comment' => '是否备案',          'translation' => '是否备案'],
                ['name' => 'record_number',              'nullable' => 'on',  'type' => 'string',           'form' => '', 'key' => '',     'comment' => '备案号',            'translation' => '备案号'],
                ['name' => 'net_shop',                   'nullable' => 'on',  'type' => 'string',           'form' => '', 'key' => '',     'comment' => '网店地址',          'translation' => '网店地址'],
                ['name' => 'auth_image',                 'nullable' => 'on',  'type' => 'string',           'form' => 'image', 'key' => '',     'comment' => '证件图片',          'translation' => '证件图片'],
                ['name' => 'company_image',              'nullable' => 'on',  'type' => 'string',           'form' => 'image', 'key' => '',     'comment' => '企业图片',          'translation' => '企业图片'],
                ['name' => 'director_image',             'nullable' => 'on',  'type' => 'string',           'form' => 'image', 'key' => '',     'comment' => '负责人照片',        'translation' => '负责人照片'],
                ['name' => 'organization_image',         'nullable' => 'on',  'type' => 'string',           'form' => 'image', 'key' => '',     'comment' => '组织架构',          'translation' => '组织架构'],
                ['name' => 'organization_code_image',    'nullable' => 'on',  'type' => 'string',           'form' => 'image', 'key' => '',     'comment' => '组织机构代码证',     'translation' => '组织机构代码证'],
                ['name' => 'business_license_image',     'nullable' => 'on',  'type' => 'string',           'form' => 'image', 'key' => '',     'comment' => '营业执照',          'translation' => '营业执照'],
                ['name' => 'description',                'nullable' => 'on',  'type' => 'string',           'form' => '', 'key' => '',     'comment' => '描述',             'translation' => '描述']
            ]
        ],
        //产品类型 名称/描述
        [

            'table'        => 'product_type', 'class_name'   => 'ProductType', //表名，实例名
            'comment'      => '产品类型', 'primary_key'  => 'id', //主键
            'model'        => 1, 'controller'   => 1, 'repository'   => 1,
            'migration'    => 1, 'migrate'      => 0, 'timestamps'   => 1,
            'soft_deletes' => 0, 'lang'         => 1, 'menu' => 'company',
            'fields' => [
                ['name' => 'name', 'type' => 'string', 'key' => '', 'comment' => '名称', 'translation' => '名称'],
                ['name' => 'description', 'nullable' => 'on',  'type' => 'string', 'form' => '', 'key' => '', 'comment' => '描述', 'translation' => '描述']
            ]
        ],
        //客户管理 名称/地址/电话/联系人/手机号
        [
            'table'        => 'customer', 'class_name'   => 'Customer', //表名，实例名
            'comment'      => '客户管理', 'primary_key'  => 'id', //主键
            'model'        => 1, 'controller'   => 1, 'repository'   => 1,
            'migration'    => 1, 'migrate'      => 0, 'timestamps'   => 1,
            'soft_deletes' => 0, 'lang'         => 1, 'menu' => 'company',
            'fields' => [
                ['name' => 'name',    'form' => '', 'nullable' => 'off', 'type' => 'string', 'key' => '', 'comment' => '名称', 'translation' => '名称'],
                ['name' => 'address', 'form' => '', 'nullable' => 'on', 'type' => 'string', 'key' => '', 'comment' => '地址', 'translation' => '地址'],
                ['name' => 'tel',     'form' => '', 'nullable' => 'on', 'type' => 'string', 'key' => '', 'comment' => '电话', 'translation' => '电话'],
                ['name' => 'contact', 'form' => '', 'nullable' => 'on', 'type' => 'string', 'key' => '', 'comment' => '联系人', 'translation' => '联系人'],
                ['name' => 'mobile',  'form' => 'mobile', 'nullable' => 'on', 'type' => 'string', 'key' => '', 'comment' => '手机号', 'translation' => '手机号']
            ]
        ],
        //产品管理 名称/产品类型/生长周期/产品图片/产品认证图片/产品简介/指标描述/           库存要增加一个表
        [
            'table'        => 'product', 'class_name'   => 'Product', //表名，实例名
            'comment'      => '产品管理', 'primary_key'  => 'id', //主键
            'model'        => 1, 'controller'   => 1, 'repository'   => 1,
            'migration'    => 1, 'migrate'      => 0, 'timestamps'   => 1,
            'soft_deletes' => 0, 'lang'         => 1, 'menu' => 'company',
            'fields' => [
                ['name' => 'name', 'form' => '', 'nullable' => 'off', 'type' => 'string', 'key' => '', 'comment' => '名称', 'translation' => '名称'],
                ['name' => 'type_id', 'form' => '', 'nullable' => 'off', 'type' => 'unsignedInteger', 'key' => '', 'comment' => '产品类型', 'translation' => '产品类型'],
                ['name' => 'grow_cycle', 'form' => '', 'nullable' => 'on', 'type' => 'string', 'key' => '', 'comment' => '生长周期', 'translation' => '生长周期'],
                ['name' => 'image', 'form' => 'image', 'nullable' => 'on', 'type' => 'string', 'key' => '', 'comment' => '产品图片', 'translation' => '产品图片'],
                ['name' => 'auth_image', 'form' => 'image', 'nullable' => 'on', 'type' => 'string', 'key' => '', 'comment' => '产品认证图片', 'translation' => '产品认证图片'],
                ['name' => 'description', 'form' => 'textarea', 'nullable' => 'on', 'type' => 'string', 'key' => '', 'comment' => '产品简介', 'translation' => '产品简介'],
                ['name' => 'index_describe', 'form' => '', 'nullable' => 'on', 'type' => 'string', 'key' => '', 'comment' => '指标描述', 'translation' => '指标描述']
            ]
        ],
        //员工管理 用户名/年龄/性别/电话/工作组/手机号/照片/身份证号码/职位/员工编号/工作年限/出生日期/文化程度/入职时间/是否组长/擅长工作/健康证/描述
        [
            'table'        => 'employee', 'class_name'   => 'Employee', //表名，实例名
            'comment'      => '员工管理', 'primary_key'  => 'id', //主键
            'model'        => 1, 'controller'   => 1, 'repository'   => 1,
            'migration'    => 1, 'migrate'      => 0, 'timestamps'   => 1,
            'soft_deletes' => 0, 'lang'         => 1, 'menu' => 'company',
            'fields' => [
                ['name' => 'name', 'form' => '', 'nullable' => 'off', 'type' => 'string', 'key' => '', 'comment' => '用户名', 'translation' => '用户名'],
                ['name' => 'age', 'form' => '', 'nullable' => 'on', 'type' => 'unsignedInteger', 'key' => '', 'comment' => '年龄', 'translation' => '年龄'],
                ['name' => 'gender', 'form' => 'radio', 'nullable' => 'on', 'type' => 'unsignedInteger', 'key' => '', 'comment' => '性别', 'translation' => '性别'],
                ['name' => 'is_captain', 'form' => '', 'nullable' => 'on', 'type' => 'unsignedInteger', 'key' => '', 'comment' => '是否组长', 'translation' => '是否组长'],
                ['name' => 'group_id', 'form' => '', 'nullable' => 'on', 'type' => 'unsignedInteger', 'key' => '', 'comment' => '工作组', 'translation' => '工作组'],
                ['name' => 'mobile', 'form' => 'mobile', 'nullable' => 'on', 'type' => 'string', 'key' => '', 'comment' => '手机号', 'translation' => '手机号'],
                ['name' => 'image', 'form' => 'image', 'nullable' => 'on', 'type' => 'string', 'key' => '', 'comment' => '照片', 'translation' => '照片'],
                ['name' => 'id_card', 'form' => 'switch', 'nullable' => 'on', 'type' => 'string', 'key' => '', 'comment' => '身份证号码', 'translation' => '身份证号码'],
                ['name' => 'position', 'form' => '', 'nullable' => 'on', 'type' => 'string', 'key' => '', 'comment' => '职位', 'translation' => '职位'],
                ['name' => 'employee_no', 'form' => '', 'nullable' => 'on', 'type' => 'string', 'key' => '', 'comment' => '员工编号', 'translation' => '员工编号'],
                ['name' => 'work_year', 'form' => 'date', 'nullable' => 'on', 'type' => 'date', 'key' => '', 'comment' => '工作年限', 'translation' => '工作年限'],
                ['name' => 'join_year', 'form' => 'date', 'nullable' => 'on', 'type' => 'date', 'key' => '', 'comment' => '入职时间', 'translation' => '入职时间'],
                ['name' => 'birthday', 'form' => 'date', 'nullable' => 'on', 'type' => 'date', 'key' => '', 'comment' => '出生日期', 'translation' => '出生日期'],
                ['name' => 'education', 'form' => '', 'nullable' => 'on', 'type' => 'unsignedInteger', 'key' => '', 'comment' => '文化程度', 'translation' => '文化程度'],
                ['name' => 'description', 'form' => 'textarea', 'nullable' => 'on', 'type' => 'string', 'key' => '', 'comment' => '描述', 'translation' => '描述'],
                ['name' => 'specialty', 'form' => '', 'nullable' => 'on', 'type' => 'string', 'key' => '', 'comment' => '擅长工作', 'translation' => '擅长工作'],
                ['name' => 'health_info', 'form' => 'multipleFile', 'nullable' => 'on', 'type' => 'string', 'key' => '', 'comment' => '健康信息', 'translation' => '健康信息']
            ]
        ],
        //投入品类型标签 类型名称/编码/标签/标签码
        [
            'table'        => 'input_type', 'class_name'   => 'InputType', //表名，实例名
            'comment'      => '投入品类型标签', 'primary_key'  => 'id', //主键
            'model'        => 1, 'controller'   => 1, 'repository'   => 1,
            'migration'    => 1, 'migrate'      => 0, 'timestamps'   => 1,
            'soft_deletes' => 0, 'lang'         => 1, 'menu' => 'inputs',
            'fields' => [
                ['name' => 'name', 'form' => '', 'nullable' => 'off', 'type' => 'string', 'key' => '', 'comment' => '类型名称', 'translation' => '类型名称'],
                ['name' => 'code', 'form' => '', 'nullable' => 'off', 'type' => 'string', 'key' => '', 'comment' => '编码', 'translation' => '编码'],
                ['name' => 'label', 'form' => '', 'nullable' => 'off', 'type' => 'string', 'key' => '', 'comment' => '标签', 'translation' => '标签'],
                ['name' => 'label_code', 'form' => '', 'nullable' => 'off', 'type' => 'string', 'key' => '', 'comment' => '标签码', 'translation' => '标签码']
            ]
        ],
        //投入品供应商  名称/联系人/地址/手机号/电话/图片/备注
        [
            'table'        => 'input_supplier', 'class_name'   => 'InputSupplier', //表名，实例名
            'comment'      => '投入品供应商', 'primary_key'  => 'id', //主键
            'model'        => 1, 'controller'   => 1, 'repository'   => 1,
            'migration'    => 1, 'migrate'      => 0, 'timestamps'   => 1,
            'soft_deletes' => 0, 'lang'         => 1, 'menu' => 'inputs',
            'fields' => [
                ['name' => 'name', 'form' => '', 'nullable' => 'off', 'type' => 'string', 'key' => '', 'comment' => '名称', 'translation' => '名称'],
                ['name' => 'contact', 'form' => '', 'nullable' => 'on', 'type' => 'string', 'key' => '', 'comment' => '联系人', 'translation' => '联系人'],
                ['name' => 'address', 'form' => '', 'nullable' => 'on', 'type' => 'string', 'key' => '', 'comment' => '地址', 'translation' => '地址'],
                ['name' => 'mobile', 'form' => 'mobile', 'nullable' => 'on', 'type' => 'string', 'key' => '', 'comment' => '手机号', 'translation' => '手机号'],
                ['name' => 'phone', 'form' => '', 'nullable' => 'on', 'type' => 'string', 'key' => '', 'comment' => '电话', 'translation' => '电话'],
                ['name' => 'image', 'form' => 'image', 'nullable' => 'on', 'type' => 'string', 'key' => '', 'comment' => '图片', 'translation' => '图片'],
                ['name' => 'description', 'form' => 'textarea', 'nullable' => 'on', 'type' => 'string', 'key' => '', 'comment' => '备注', 'translation' => '备注']
            ]
        ],
        //生产计划管理 批次名称/产品ID/产品有机编码/地块ID/批次
        [
            'table'        => 'production_plan', 'class_name'   => 'ProductionPlan', //表名，实例名
            'comment'      => '生产计划管理', 'primary_key'  => 'id', //主键
            'model'        => 1, 'controller'   => 1, 'repository'   => 1,
            'migration'    => 1, 'migrate'      => 0, 'timestamps'   => 1,
            'soft_deletes' => 0, 'lang'         => 1, 'menu' => 'produce',
            'fields' => [
                ['name' => 'name', 'form' => '', 'nullable' => 'off', 'type' => 'string', 'key' => '', 'comment' => '批次名称', 'translation' => '批次名称'],
                ['name' => 'product_id', 'form' => 'select', 'nullable' => 'off', 'type' => 'unsignedInteger', 'key' => '', 'comment' => '产品ID', 'translation' => '产品ID'],
                ['name' => 'product_organic_code', 'form' => '', 'nullable' => 'off', 'type' => 'string', 'key' => '', 'comment' => '产品有机编码', 'translation' => '产品有机编码'],
                ['name' => 'block_id', 'form' => 'select', 'nullable' => 'off', 'type' => 'unsignedInteger', 'key' => '', 'comment' => '地块ID', 'translation' => '地块ID'],
                ['name' => 'batch', 'form' => '', 'nullable' => 'off', 'type' => 'string', 'key' => '', 'comment' => '批次', 'translation' => '批次']
            ]
        ],
        //仓库管理 名称/面积/图片/主管人/地址/电话/描述
        [
            'table'        => 'warehouse', 'class_name'   => 'Warehouse', //表名，实例名
            'comment'      => '仓库管理', 'primary_key'  => 'id', //主键
            'model'        => 1, 'controller'   => 1, 'repository'   => 1,
            'migration'    => 1, 'migrate'      => 0, 'timestamps'   => 1,
            'soft_deletes' => 0, 'lang'         => 1, 'menu' => 'produce',
            'fields' => [
                ['name' => 'name', 'form' => '', 'nullable' => 'off', 'type' => 'string', 'key' => '', 'comment' => '名称', 'translation' => '名称'],
                ['name' => 'area', 'form' => '', 'nullable' => 'off', 'type' => 'decimal', 'key' => '', 'comment' => '面积', 'translation' => '面积'],
                ['name' => 'image', 'form' => 'image', 'nullable' => 'on', 'type' => 'string', 'key' => '', 'comment' => '图片', 'translation' => '图片'],
                ['name' => 'manager_id', 'form' => 'select', 'nullable' => 'on', 'type' => 'string', 'key' => '', 'comment' => '主管人', 'translation' => '主管人'],
                ['name' => 'address', 'form' => '', 'nullable' => 'on', 'type' => 'string', 'key' => '', 'comment' => '地址', 'translation' => '地址'],
                ['name' => 'mobile', 'form' => 'mobile', 'nullable' => 'on', 'type' => 'string', 'key' => '', 'comment' => '电话', 'translation' => '电话'],
                ['name' => 'description', 'form' => 'textarea', 'nullable' => 'on', 'type' => 'string', 'key' => '', 'comment' => '描述', 'translation' => '描述']
            ]
        ],
        //销售记录 订单号/批次编号/产品/客户/销售量/工作组/负责人/销售时间/备注
        [
            'table'        => 'sale', 'class_name'   => 'Sale', //表名，实例名
            'comment'      => '销售记录', 'primary_key'  => 'id', //主键
            'model'        => 1, 'controller'   => 1, 'repository'   => 1,
            'migration'    => 1, 'migrate'      => 0, 'timestamps'   => 1,
            'soft_deletes' => 0, 'lang'         => 1, 'menu' => 'sale',
            'fields' => [
                ['name' => 'order_id', 'form' => '', 'nullable' => 'off', 'type' => 'string', 'key' => '', 'comment' => '订单号', 'translation' => '订单号'],
                ['name' => 'batch_id', 'form' => '', 'nullable' => 'off', 'type' => 'string', 'key' => '', 'comment' => '批次编号', 'translation' => '批次编号'],
                ['name' => 'product_id', 'form' => 'select', 'nullable' => 'off', 'type' => 'unsignedInteger', 'key' => '', 'comment' => '产品', 'translation' => '产品'],
                ['name' => 'customer_id', 'form' => 'select', 'nullable' => 'off', 'type' => 'unsignedInteger', 'key' => '', 'comment' => '客户', 'translation' => '客户'],
                ['name' => 'quantity', 'form' => '', 'nullable' => 'off', 'type' => 'unsignedInteger', 'key' => '', 'comment' => '销售量', 'translation' => '销售量'],
                ['name' => 'group_id', 'form' => 'select', 'nullable' => 'on', 'type' => 'unsignedInteger', 'key' => '', 'comment' => '工作组', 'translation' => '工作组'],
                ['name' => 'manager_id', 'form' => 'select', 'nullable' => 'on', 'type' => 'unsignedInteger', 'key' => '', 'comment' => '负责人', 'translation' => '负责人'],
                ['name' => 'sale_time', 'form' => 'date', 'nullable' => 'on', 'type' => 'date', 'key' => '', 'comment' => '销售时间', 'translation' => '销售时间'],
                ['name' => 'description', 'form' => 'textarea', 'nullable' => 'on', 'type' => 'string', 'key' => '', 'comment' => '备注', 'translation' => '备注']
            ]
        ],
        //车辆信息 车牌号/车辆图片/承载量/描述
        [
            'table'        => 'vehicle', 'class_name'   => 'Vehicle', //表名，实例名
            'comment'      => '车辆信息', 'primary_key'  => 'id', //主键
            'model'        => 1, 'controller'   => 1, 'repository'   => 1,
            'migration'    => 1, 'migrate'      => 0, 'timestamps'   => 1,
            'soft_deletes' => 0, 'lang'         => 1, 'menu' => 'vehicle',
            'fields' => [
                ['name' => 'plate_number', 'form' => '', 'nullable' => 'off', 'type' => 'string', 'key' => '', 'comment' => '车牌号', 'translation' => '车牌号'],
                ['name' => 'image', 'form' => 'image', 'nullable' => 'on', 'type' => 'string', 'key' => '', 'comment' => '车辆图片', 'translation' => '车辆图片'],
                ['name' => 'capacity', 'form' => 'number', 'nullable' => 'on', 'type' => 'unsignedInteger', 'key' => '', 'comment' => '承载量', 'translation' => '承载量'],
                ['name' => 'description', 'form' => 'textarea', 'nullable' => 'on', 'type' => 'string', 'key' => '', 'comment' => '描述', 'translation' => '描述']
            ]
        ],
        //物流信息 订单号/工作组/负责人/运输时间/预计到达时间/车辆/仓库/物流单号
        [
            'table'        => 'logistics', 'class_name'   => 'Logistics', //表名，实例名
            'comment'      => '物流信息', 'primary_key'  => 'id', //主键
            'model'        => 1, 'controller'   => 1, 'repository'   => 1,
            'migration'    => 1, 'migrate'      => 0, 'timestamps'   => 1,
            'soft_deletes' => 0, 'lang'         => 1, 'menu' => 'logistics',
            'fields' => [
                ['name' => 'order_id', 'form' => '', 'nullable' => 'off', 'type' => 'string', 'key' => '', 'comment' => '订单号', 'translation' => '订单号'],
                ['name' => 'group_id', 'form' => 'select', 'nullable' => 'on', 'type' => 'unsignedInteger', 'key' => '', 'comment' => '工作组', 'translation' => '工作组'],
                ['name' => 'manager_id', 'form' => 'select', 'nullable' => 'on', 'type' => 'unsignedInteger', 'key' => '', 'comment' => '负责人', 'translation' => '负责人'],
                ['name' => 'transport_time', 'form' => 'date', 'nullable' => 'on', 'type' => 'date', 'key' => '', 'comment' => '运输时间', 'translation' => '运输时间'],
                ['name' => 'arrival_time', 'form' => 'date', 'nullable' => 'on', 'type' => 'date', 'key' => '', 'comment' => '预计到达时间', 'translation' => '预计到达时间'],
                ['name' => 'vehicle_id', 'form' => 'select', 'nullable' => 'on', 'type' => 'unsignedInteger', 'key' => '', 'comment' => '车辆', 'translation' => '车辆'],
                ['name' => 'warehouse_id', 'form' => 'select', 'nullable' => 'on', 'type' => 'unsignedInteger', 'key' => '', 'comment' => '仓库', 'translation' => '仓库'],
                ['name' => 'logistics_number', 'form' => '', 'nullable' => 'on', 'type' => 'string', 'key' => '', 'comment' => '物流单号', 'translation' => '物流单号']
            ]
        ],
        //产品召回 工作组/负责人/订单号/处理结果/包装重量/召回时间/召回量
        [
            'table'        => 'recall', 'class_name'   => 'Recall', //表名，实例名
            'comment'      => '产品召回', 'primary_key'  => 'id', //主键
            'model'        => 1, 'controller'   => 1, 'repository'   => 1,
            'migration'    => 1, 'migrate'      => 0, 'timestamps'   => 1,
            'soft_deletes' => 0, 'lang'         => 1, 'menu' => 'recall',
            'fields' => [
                ['name' => 'group_id', 'form' => 'select', 'nullable' => 'on', 'type' => 'unsignedInteger', 'key' => '', 'comment' => '工作组', 'translation' => '工作组'],
                ['name' => 'manager_id', 'form' => 'select', 'nullable' => 'on', 'type' => 'unsignedInteger', 'key' => '', 'comment' => '负责人', 'translation' => '负责人'],
                ['name' => 'order_id', 'form' => '', 'nullable' => 'off', 'type' => 'string', 'key' => '', 'comment' => '订单号', 'translation' => '订单号'],
                ['name' => 'result', 'form' => 'textarea', 'nullable' => 'on', 'type' => 'string', 'key' => '', 'comment' => '处理结果', 'translation' => '处理结果'],
                ['name' => 'weight', 'form' => 'number', 'nullable' => 'on', 'type' => 'unsignedInteger', 'key' => '', 'comment' => '包装重量', 'translation' => '包装重量'],
                ['name' => 'recall_time', 'form' => 'date', 'nullable' => 'on', 'type' => 'date', 'key' => '', 'comment' => '召回时间', 'translation' => '召回时间'],
                ['name' => 'recall_amount', 'form' => 'number', 'nullable' => 'on', 'type' => 'unsignedInteger', 'key' => '', 'comment' => '召回量', 'translation' => '召回量']
            ]
        ],
        //制度政策 名称/描述/附件
        [
            'table'        => 'policy', 'class_name'   => 'Policy', //表名，实例名
            'comment'      => '制度政策', 'primary_key'  => 'id', //主键
            'model'        => 1, 'controller'   => 1, 'repository'   => 1,
            'migration'    => 1, 'migrate'      => 0, 'timestamps'   => 1,
            'soft_deletes' => 0, 'lang'         => 1, 'menu' => 'company',
            'fields' => [
                ['name' => 'name', 'form' => '', 'nullable' => 'off', 'type' => 'string', 'key' => '', 'comment' => '名称', 'translation' => '名称'],
                ['name' => 'description', 'form' => 'textarea', 'nullable' => 'on', 'type' => 'string', 'key' => '', 'comment' => '描述', 'translation' => '描述'],
                ['name' => 'attachs', 'form' => 'multipleFile', 'nullable' => 'on', 'type' => 'string', 'key' => '', 'comment' => '附件', 'translation' => '附件']
            ]
        ],
        //认证信息表附件 企业ID/附件名称/附件路径 
        //投入品管理 名称/面积/图片/主管人/地址/电话/描述
    ]
];
