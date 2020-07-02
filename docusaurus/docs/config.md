---
id: config
title: 配置项
---

安装完成后，会生成一个```config/admin.php```配置文件，所有的配置项都能在这里找到。

## 路由
`router`是后台路由的配置项，和路由相关的配置都在这里。

|  key   | value  |
|  ----  | ----  |
| prefix  | 路由前缀 |
| namespaces  | 控制器的命名空间 |
| routes  | 路由文件的路径。这个文件中的路由命名会自动加上```admin.```前缀。如命名```$route->name('index')```，实际命名为```admin.index``` |
| index  | 首页路由名称 |

### 中间件(middleware)
这里包含了后台路由的部分中间件，你的自定义中间件也在这里添加。

|  class   | value  |
|  ----  | ----  |
| `app\Admin\Middleware\Menu`  | 注册菜单的中间件 |
| `Tanwencn\Admin\Http\Middleware\Pjax`  | `pjax`内容过滤中间件，删除这个中间件，会自动取消`pjax`功能 |

## 登录设置

|  key   | value  |
|  ----  | ----  |
|auth.login.username|登录字段，默认为`email`。更改此选项的同时，需要注意数据库必填字段及索引等结构。|
|auth.login.throttle|登录限制，默认为`60,15`，即每15分钟内接受同一用户60次请求|

## 授权(auth)
参考Laravel官方文档的config.auth设置项。

## 文件管理器(elfinder)

## 操作日志(logger)
后台操作日志配置。

|  key   | value  |
|  ----  | ----  |
|method|`HttpLog`会只记录这里出现的`method`请求。|
|except|不需要记录的字段。|
