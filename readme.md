# Laravel Dcat-Admin 拓展脚手架
- 命令行
- 批量处理
- 增加控制器表单数据类型配置

### install 安装
```
composer install adong/one
```


### 使用
```
（注意：把config/app.php） 语言改成中文
'locale' => 'zh-CN',
# 发布配置文件或迁移文件
php artisan adong:publish
# 根据配置文件生成
php artisan adong:config 
# 根据数据库表生成
php artisan adong:tables
```

### 本地开发修改
``` json
// config/app.php =>providers 添加xxxServiceProvider::class 
// composer init 之后在 composer.json 根增加
"require":{},
"extra": {
    "laravel": {
        "providers": [
            "<vendor>\\<name>\\xxxServiceProvider"
        ]
    }
}
```