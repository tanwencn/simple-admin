---
id: view
title: 视图
---

后台使用了```Laravel```的```Blade```模板引擎和```AdminLTE```模板框架做为布局和样式标准，并在此基础上封装了一些常用组件。

## 初始视图
安装完成后，在`Views`目录有以下文件，可以根据需求进行自定义:
- `footer/header` 进行静态资源注册。
- `login` 登录页
- `logo` 后台logo位置
- `top_navbar` 顶部菜单
- `options` 这里有一个默认示例，只要添加菜单及表单，就可以完成自定义全局配置项的功能了。
- `index.dashboard` 后台首页模板
- `components` 组件目录

## 加载视图
视图的加载可以参考```Laravel```的官方文档。同时后台提供了简单的二次封装，常规情况下，你可以直接使用```Admin::view('index/dashboard');```来进行视图加载。

## 布局示例
```php
@extends('admin::layouts.app') //继承布局

@section('title', $model->id?'添加':'修改')) //页面标题

@section('breadcrumbs') //面包屑
<li><a href="{{ Admin::action('index') }}"> 所有文章</a></li>
@endsection

@section('content')
内容

<script>
Admin.boot(function () {
    //视图局部js，在资源注册加载完毕后执行
    alert('ok');
});
</script>
@endsection
```

## JS
我们写常规代码时，大多会以```jquery```加载完成做为节点来写局部JS，如：
```js
$(function(){
    //js代码
});
```
但是这种写法会在```PJAX```下出现一些问题，所以在后台中，将使用新的初始化函数来编写JS局部代码：
```js
Admin.boot(function () {
    //js代码
});
``` 

## 组件
### 面包屑
```html
<admin::bread-middle :middle="['url' => Admin::action('index'), 'name' => '权限列表']" />
```

