---
id: advanced
title: 高级使用
sidebar_label: 高级使用
---

## 全局自定义配置项
在后台菜单中，有个配置项的功能，这个配置和日志一样，是提供给开发人员用的。

对应的视图位置为`app\Admin\Views\options`，此目录有初始状态有两个文件，分别是`nav`菜单，`default`默认设置项。


你只要需要在`default`视图的表单中添加或更改字段，也可以在`nav`中添加新的视图定义变量，便可以在任何地方使用`options($key)`的方式调用。

## 元数据扩展属性
如果你的表需要扩展字段，或者缓存部份字段的需求，可以直接使用扩展属性的方式，经常变动的数据不建议使用。以下是一个简单的使用例子：
定义`Eloquent`模型
```php
use Illuminate\Database\Eloquent\Model;
use Tanwencn\Admin\Database\Eloquent\Concerns\HasMetas;

class Post extends Model{
    use HasMetas;
}
```
保存扩展属性
```php
$post = new Post();
$metas = ['author' => 'simpalAdmin'];
$post->fill(['metas' => $metas])->save();
//or
$post->metas = $metas;
$post->save();
```
获取扩展属性
```php
$post = Post::find(1);
$metas = $post->metas;
$metas['author'];
//or
$post->metas->get('author');
```