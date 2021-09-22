# Laravel Dcat-Admin 拓展自动化生成批量脚手架

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
