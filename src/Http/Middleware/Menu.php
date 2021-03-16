<?php
/**
 * http://www.tanecn.com
 * 作者: Tanwen
 * 邮箱: 361657055@qq.com
 * 所在地: 广东广州
 * 时间: 2018/4/13 15:55
 */

namespace Tanwencn\Admin\Http\Middleware;

class Menu extends AbstractMenuMiddleware
{
    public function boot()
    {
        $this->add(trans_choice('admin.dashboard', 0))->icon('tachometer-alt')->uri('/')->auth('dashboard');
        $this->add(trans_choice('admin.user_group', 0))->icon('user-lock')->child(trans_choice('admin.role', 0), function ($menu) {
            $menu->uri('roles')->auth('view_role');
        })->child(trans_choice('admin.permission', 0), function ($menu) {
            $menu->uri('permissions')->auth('view_permission');
        })->child(trans_choice('admin.user', 0), function ($menu) {
            $menu->uri('users')->auth('view_user');
        });

        $this->group(trans_choice('admin.system', 0), 99)
            ->add(trans_choice('admin.log', 0))->icon('record-vinyl')->blank()->route('supervisor.index')->auth('dashboard');

        $this->group(trans_choice('admin.system', 0))->add(trans_choice('admin.setting', 0))->icon('cog')->route('admin.options', ['template' => 'default'])->sort(98)->auth('setting');
    }
}
