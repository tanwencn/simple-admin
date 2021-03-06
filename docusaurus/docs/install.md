---
id: install
title: 安装使用
---

整个安装过程非常简单，只需以下几个步骤。

## 开始安装
### 1.在laravel项目根目录下，通过 Composer 安装扩展包
```composer
composer require tanwencn/simple-admin
```

### 2.修改配置文件
数据库存信息，在```.env``` 设置数据库连接信息

本地化，在 ```config/app.php```中设置```'locale' => 'zh-CN'```

### 3.执行安装命令
```php
php artisan admin:install
```
最后会在命令行输出初始账号及密码，注意复制。

### 4.安装完成

打开链接：http://youwebsite/admin

输入登录账号：admin@admin.com   
输入登录密码：安装时复制的密码
PS:如若忘记密码或者误删除此账号，可以用```php artisan admin:resetSuperAdmin```命令恢复此账号至安装状态。

### 5.开发目录
执行```admin::install```后，扩展包会自动生成开发目录和后台首页控制器及视图:
```
App
└───Admin
|    │   routes.php
│   └───Controllers
│       │   IndexController.php
│       │   ...
│   └───Views
│       └───   index
|       |        |   dashboard.blade.php
│       │   ...
└───Http
|    ...
```