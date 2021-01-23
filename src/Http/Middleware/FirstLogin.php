<?php
/**
 * http://www.tanecn.com
 * 作者: Tanwen
 * 邮箱: 361657055@qq.com
 * 所在地: 广东广州
 * 时间: 2018/4/13 15:55
 */

namespace Tanwencn\Admin\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Tanwencn\Admin\Facades\Admin;

class FirstLogin
{

    public function handle($request, Closure $next, $status = null)
    {
        if($this->hasFirstLogin() && Route::currentRouteName() != 'admin.users.change_password'){
            return response()->view('admin::_users.change_password', [
                'tip' => trans('admin.change_password_tip')
            ]);
        }
        return $next($request);
    }

    protected function hasFirstLogin(){
        return session()->remember('has-first-login'.Admin::user()->id, function(){
            $operation = Admin::user()->operation()
                ->where('uri', route('admin.login', [], false))
                ->where('method', 'POST')
                ->orderBy('id')
                ->first();

            return !$operation || $operation->created_at > Admin::user()->updated_at;
        });
    }
}
