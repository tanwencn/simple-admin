---
id: config
title: 配置项
---

安装完成后，会生成一个```config/admin.php```配置文件，所有的配置项都能在这里找到。

## 路由
后台路由的配置项，和路由相关的配置都在这里。

### router.prefix
路由前缀

### router.namespaces
控制器的```namespaces```

### router.routes
路由文件的路径。这个文件中的路由命名会自动加上```admin.```前缀。如命名```$route->name('index')```，实际命名为```admin.index```。

### router.index
首页路由名称

## 中间件(router.middleware)
这里包含了后台路由的部分中间件，你的自定义中间件也在这里添加。

### Tanwencn\Admin\Http\Middleware\Menu
注册默认菜单，你可以添加新的中间件注册自定义菜单，也可以直接替换这个。

### Tanwencn\Admin\Http\Middleware\Pjax
pjax内容过滤中间件，删除这个中间件，会自动取消pjax功能

## 登录设置

### auth.login.controller
登录控制器，如若需要重写，可在这里写自定义控制器。

### auth.login.username
登录字段，默认为邮箱登录。更改此选项的同时，需要注意数据库必填字段及索引等结构。

## 授权(auth)
参考Laravel官方文档的config.auth设置项。

## 文件管理器(elfinder)

## 操作日志
后台操作日志配置。

### logger.method
```HttpLog```会只记录这里出现的```method```请求。

### logger.except
不需要记录的字段。
