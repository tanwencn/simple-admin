---
id: menu
title: 菜单
---

为了方便自定义管理，需要开发者在代码中对菜单进行添加和修改。

## 注册菜单示例

在视图渲染之前的任何地方注册，都会被视图加载出来，建议在`app\admin\Middleware\Menu`中统一管理。

示例：

```php
public function boot()
{
    $this->add(trans_choice('admin.dashboard', 0))//添加菜单
         ->icon('tachometer-alt')//菜单图标，参考fontawesome5的fas图标
         ->uri('/')//菜单uri
         ->auth('dashboard');//相应权限才能显示
    
    $this->add('用户')->icon('user-lock')
          //添加子菜单
          ->child('用户列表', function($menu){
            $menu->uri('users')->auth('用户列表');
    })
          ->child('权限列表', function($menu){
        $menu->uri('permissions')->auth('view_permission');
    });

    $this->group('系统', 99)//添加菜单分类
        ->add('SimpleAdmin')
        ->sort(99)//菜单排序
        ->icon('record-vinyl')
        ->child('打开官网', function($menu){
            $menu->blank() //新窗口打开链接
            ->url('http://tanecn.com')
            ->sort(100);//子菜单排序
    })
        ->child(trans_choice('admin.operationlog', 0), function($menu){
        $menu->route('admin.operationlog');
    });
}
```
## 图标
图标参考:```fontawesome5```的`fas`图标


## 链接

### 路由
```$menu->route($name, $parameters = [], $absolute = true)```用路由生成菜单。

### 相对链接
```$menu->uri($uri)```用相对链接生成菜单。

### 绝对链接
```$menu->url($url)```用绝对链接生成菜单。

#### 新窗口打开菜单
```$menu->url($url)->blank()```新窗口打开外部链接。