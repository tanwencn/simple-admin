<?php
/**
 * http://www.tanecn.com
 * 作者: Tanwen
 * 邮箱: 361657055@qq.com
 * 所在地: 广东广州
 * 时间: 2019/8/24 2:33 PM
 */

namespace Tanwencn\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Finder\Finder;
use Illuminate\Support\Facades\URL;
use Tanwencn\Admin\Log\FileLog;

class LogViewController extends Controller
{
    use Package;

    protected $eof = false;

    protected $page_timeout = 3;

    public function index(Request $request)
    {
        $current = $request->filled('f') ? decrypt($request->query('f'), false) : "";
        $tree = [];
        $log_path = storage_path('logs');
        $files = iterator_to_array(
            Finder::create()->files()->ignoreDotFiles(true)->in($log_path)->sort(function ($a, $b) {
                return -($a->getMTime() - $b->getMTime());
            }),
            false
        );

        foreach ($files as $file) {
            $pathname = $file->getRelativePathname();
            $info = pathinfo($pathname);
            $key = $info['dirname'] == '.' ? $info['filename'] : str_replace('/', '.', $info['dirname']) . '.' . $info['filename'];
            $fileName = $log_path . '/' . $pathname;

            Arr::set($tree, $key, $fileName);
        }

        $statistics = "";

        session()->forget('admin_logs_parser');

        return $this->view('index', compact('tree', 'statistics', 'current', 'data', 'page', 'eof'));
    }

    public function api(Request $request)
    {
        $file = $request->filled('f') ? decrypt($request->query('f'), false) : "";

        $log = session('admin_logs_parser', new FileLog($file));

        $response = response([
            'data' => $log->row($request->query('rows', 100)),
            'read_rows' => $log->getReadRows()
        ]);

        session(['admin_logs_parser' => $log]);

        return $response;
    }

    protected function abilitiesMap()
    {
        return "laravel_logs";
    }
}