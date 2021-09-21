table_name: admin_menu
exist-table: one|admin_menu
model_name: App\Models\AdminMenu
controller_name: App\Admin\Controllers\AdminMenuController
repository_name: App\Admin\Repositories\AdminMenu
create[]: migration
create[]: model
create[]: repository
create[]: controller
create[]: migrate
create[]: lang
fields[0][name]: parent_id
fields[0][translation]: 
fields[0][type]: bigInteger
fields[0][nullable]: on
fields[0][key]: 
fields[0][default]: 0
fields[0][comment]: 
fields[1][name]: order
fields[1][translation]: 
fields[1][type]: integer
fields[1][key]: 
fields[1][default]: 0
fields[1][comment]: 
fields[2][name]: title
fields[2][translation]: 
fields[2][type]: string
fields[2][key]: 
fields[2][default]: 
fields[2][comment]: 
fields[3][name]: icon
fields[3][translation]: 
fields[3][type]: string
fields[3][nullable]: on
fields[3][key]: 
fields[3][default]: 
fields[3][comment]: 
fields[4][name]: uri
fields[4][translation]: 
fields[4][type]: string
fields[4][nullable]: on
fields[4][key]: 
fields[4][default]: 
fields[4][comment]: 
primary_key: id
timestamps: 1
soft_deletes: 1
_token: qXILkWoUSAArKqlJSuDzQa6R6J1ADRUsfnPWLxy3