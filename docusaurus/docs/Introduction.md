---
id: introduction
title: 介绍
sidebar_label: 介绍
---

Simple Admin 是一款基于Laravel+Bootstrap的后台开发框架。
因时间因素，只提供Lalravel-LTS版本维护，目前最新版本为Laravel6。


## 主要特性
- RBAC权限管理。
    - 支持单用户多角色
    - 支持多守卫自定义角色
    - 高速缓存
    
- 丰富的前端样式库，基于`AdminLTE` `bootstrap4`跨平台访问。
    - 支持`PJAX`访问模式。
    - 提供常用视图组件，支持自定义组件。

- 安全
    - 支持自定义正则密码强度。
    - 首次登录改密码
    - 自定义登录频率限制，防暴力破解
    
- 更多功能
    - 基于`laravel`原生语言包，支持多语言。
    - 集成`Elfinder`文件浏览器，兼容`Flysystem`驱动。
    - 用户行为操作日志、`Laravel`原生错误日志支持超大文件分片解析
    - 提供全局自定义配置项，高速访问缓存
    - 提供`eloquent`便捷扩展元数据功能，高速访问缓存

## 文档、安装和演示
- [查看文档](https://www.tanecn.com/)
- [在线演示](https://demo.tanecn.com/admin)

## UI截图
![Simple Admin](/img/preview.jpg)

## 特别鸣谢
- [Laravel Permission](https://github.com/spatie/laravel-permission)
- [Laravel BladeX](https://github.com/spatie/laravel-blade-x)
- [Elfinder](https://github.com/Studio-42/elFinder)
- [AdminLTE](https://github.com/ColorlibHQ/AdminLTE)
- [Jquery Pjax](https://github.com/defunkt/jquery-pjax)
- [DataTables](https://github.com/DataTables/DataTables)
- [icheck](https://github.com/fronteed/icheck)
- [jquery Confirm](https://github.com/craftpip/jquery-confirm)
- [Nprogress](https://github.com/rstacruz/nprogress)

## 授权许可
Apache2开源协议发布，并提供免费使用。

## 其它选择
- [Laravel Admin](https://github.com/z-song/laravel-admin)
很火的一个包，功能很全。事实上如果不是这个包太过臃肿，定位不符合自身团队利益，`simpleadmin`就不会出现了。
- [voyager](https://github.com/the-control-group/voyager)
这个在国内不怎么火，因为体验上跟国内行情有点对不上眼，但是其代码非常优秀，个人项目可以体验一把。


