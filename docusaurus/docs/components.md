---
id: components
title: 组件
---

组件分为两部分，一为视图图件，二为js组件。

# 视图组件
视图组件位于`app\Admin\Views\components`目录，你可以添加自定义组件及修改黑鹰组件。

## form
```
<admin::form :model="$model"></admin::form>
```
根据`$model`来判断是`post`还是`put`表单并输出。

## input
```html
<div class="card-body">
    <div class="form-group row {{ $errors->has('name')?"has-error":"" }}">
        <admin::label :text="trans('admin.name')" required="true" class="col-md-4 text-right" />
        <div class="col-md-8">
            <admin::input name="name" :value="old('name', $model->name)" :readonly="$model->name=='superadmin'" />
        </div>
    </div>
</div>
```

## table
```html
<admin::table checkbox="true">
    <slot name="thead">
        <tr>
            <th>名称</th>
            <th>操作</th>
        </tr>
    </slot>
    <slot name="tbody">
        @foreach($results as $role)
            <tr @if($role->name != 'superadmin') data-id="{{ $role->id }}" @endif>
                <td>{{ $role->name }}</td>
                <td>
                    @can('edit_role')
                        <a href="{{ Admin::action('edit', $role->id) }}">编辑</a>
                        &nbsp;
                    @endcan
                </td>
            </tr>
        @endforeach
    </slot>
</admin::table>
```
以上是一个表单的快速渲染方式，`checkbox`为`true`时，会根据`tbody.tr`的`data-id`属性添加全选框

## 面包屑
```html
<admin::bread-middle :middle="['url' => Admin::action('index'), 'name' => '权限列表']" />
```

