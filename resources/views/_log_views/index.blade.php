<!DOCTYPE html>
<html xmlns:admin="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ trans("admin.laravel_logs") }} &nbsp;&nbsp;&nbsp;{{ option('web_name', config('app.name')) }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Tell the browser to be responsive to screen width -->
    <link rel="shortcut icon" href="{{ asset(mix('/logo.png', 'vendor/simple-admin')) }}" type="image/x-icon">

    <link rel="stylesheet" href="{{ asset(mix('/css/vendor.css', 'vendor/simple-admin')) }}">
    <link rel="stylesheet" href="{{ asset(mix('/css/app.css', 'vendor/simple-admin')) }}">
    <script src="{{ asset(mix('/js/vendor.js', 'vendor/simple-admin')) }}"></script>
    <script src="{{ asset(mix('/js/app.js', 'vendor/simple-admin')) }}"></script>

    <style>
        body {
            font-size: 0.8rem;
        }

        .modal-content {
            position: relative;
            background-color: transparent;
            background-clip: padding-box;
            border: 0;
            border-radius: 6px;
            outline: 0;
        }

        .modal-body {
            padding: 0;
        }

        pre {
            position: relative;
            background: #21252b;
            border-radius: 5px;
            #font: 15px/22px "Microsoft YaHei", Arial, Sans-Serif;
            #line-height: 1.6;
            #margin-bottom: 24px;
            max-width: 100%;
            overflow: auto;
            text-shadow: none;
            color: #000;
            #padding-top: 30px;
            card-bodyshadow: 0 10px 30px 0 rgba(0, 0, 0, .4);
        }

        pre code {
            background: #1d1f21;
            color: #fff;
            word-break: break-word;
            font-family: 'Source Code Pro', monospace, Helvetica, Tahoma, Arial, STXihei, "STHeiti Light", "Microsoft YaHei", sans-serif;
            padding: 2px;
            text-shadow: none;
            border-radius: 0 0 5px 5px;
        }

    </style>
</head>
<body>
<div class="wrapper">
    <!-- begin row -->
    <div class="row m-2 pt-3">
        <!-- begin col-12 -->
        <div class="col-md-3">
            <div class="card sidebar" style="min-height:200px">
                <div class="card-header">
                    <h3 class="card-title">Files</h3>
                </div>
                <div class="card-body p-0 sidebar-light-primary">
                    @php
                        $build_tag = function($results)use(&$build_tag, $current){
                            $str = '';
                            foreach ($results as $key => $value){
                                $is_folder = is_array($value);
                                $icon = $is_folder?"folder":"file";
                                $attr = 'class="nav-link '.($current==$value?"active":"").'" href="'.($is_folder?'#':route('admin.logs', ['f' => encrypt($value, false)])).'"';

                                $str .= '<li class="nav-item '. ($current==$value?"menu-open":"").(!$is_folder?"":"has-treeview") .'"><a '. $attr .'><i class="nav-icon fas fa-'. $icon .'"></i><p>'.$key.($is_folder?'<i class="right fas fa-angle-left"></i>':'').'</p></a>';
                                if(is_array($value)){
                                    $str .= '<ul class="nav nav-treeview">'.$build_tag($value).'</ul>';
                                }
                            }
                            return $str.'</li>';
                        }
                    @endphp
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview"
                        data-accordion="true" id="tree_list">
                        {!! $build_tag($tree) !!}
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card content-table">
                <div class="card-header">
                    <div class="form-group row p-0 m-0" style="float:left; ">
                        <label class="col-control-label col-control-label-sm text-right col-control-label text-right" style="line-height: 32px">Continue to load：</label>
                        <div>
                            <input type="number" class="form-control form-control-sm" style="width: 100px; height: 32px" id="load_number" value="100" />
                        </div>
                        <label class="col-control-label col-control-label-sm col-control-label" style="line-height: 32px">&nbsp;rows&nbsp;</label>
                        <button class="btn btn-default btn-xs btn-load" style="height: 32px">Confirm</button>
                    </div>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 200px;">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="read_rows">Loaded(0)</span>
                            </div>
                            <input type="search" style="display: none" name="search"
                                   class="form-control float-right" value=""
                                   placeholder="{{ trans('admin.search') }}...">
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <admin::table nowrap="false" nodata="true">
                        <slot name="thead">
                            <tr>
                                <th>Date</th>
                                <th>Level</th>
                                <th>Context</th>
                                <th>Content</th>
                                <th>More</th>
                            </tr>
                        </slot>
                        <slot name="tbody">
                            {{--@foreach($data as $key => $val)
                                <tr>
                                    <td style="white-space: nowrap;">{{ $val[3] }}</td>
                                    <td style="white-space: nowrap;">{{ $val[2] }}</td>
                                    <td style="white-space: nowrap;">{{ $val[1] }}</td>
                                    <td>
                                        <code style="word-break:break-word">
                                            {{ trim($val[4]) }}
                                        </code>
                                    </td>
                                    <td>
                                        @if(isset($val[5]) && !empty(trim($val[5])))
                                            <button type="button" class="btn btn-xs btn-primary" data-toggle="modal"
                                                    data-target="#modal-default{{ $key }}"> View
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                                <div class="modal fade" id="modal-default{{ $key }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <pre><code>{{ $val[4].(isset($val[5])?$val[5]:"") }}</code></pre>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                            @endforeach--}}
                        </slot>
                    </admin::table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <!-- end panel -->

        <div id="modals"></div>
    </div>
</div>
<script>
    $(function () {

        $('#tree_list a.active').parents('li').addClass('menu-open').children('a').addClass('active');

        function ReadLog(file)
        {
            this.file = file;
            this.rows = 100;

            this.loading = false;

            this.table = $('.table').DataTable({
                searching: true,
                ordering: false,
                paging: false,
                scrollY: $(window).height() ? $(window).height() - 140 : 420,
                dom: 'Brt',
                buttons: [
                    'print'
                ]
            });
            var t=this;
            var line = 0;

            this.load = function(rows){
                if (t.file == '') return;
                NProgress.start();
                setTimeout(function(){
                    $.ajax({
                        method: 'GET',
                        url: '{{ route('admin.logs.api') }}',
                        data: { f: t.file, rows:rows },
                        async:false,
                        dataType: 'JSON',
                        success: function (rs) {
                            var data = rs.data;

                            addRows(data);

                            $('[name="search"]').show();

                            NProgress.done();
                        },
                        error: function (rs) {
                            if (rs['responseJSON'] && rs['responseJSON']['message']) {
                                Admin.error(rs['responseJSON']['message']);
                            }
                        }
                    });
                }, 100);
            };

            var addRows = function(data){
                var rows = [];
                var modal;
                $(data).each(function(_, val){
                    rows.push([val[0], val[1], val[2], '<code style="word-break:break-word" class="val">' + val[3] + '</code>', '<button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#modal-default' + line + '"> show</button>']);
                    /*var tr = '<tr>' +
                        '<td style="white-space: nowrap;" class="val">' + val[0] + '</td>' +
                        '<td style="white-space: nowrap;" class="val">' + val[1] + '</td>' +
                        '<td style="white-space: nowrap;" class="val">' + val[2] + '</td>' +
                        '<td><code style="word-break:break-word" class="val">' + val[3] + '</code></td>' +
                        '<td><button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#modal-default' + line + '"> show</button></td>' +
                        '</tr>';*/
                    modal += '<div class="modal fade" id="modal-default' + line + '">' +
                        '<div class="modal-dialog modal-lg">' +
                        '<div class="modal-content">' +
                        '<div class="modal-body">' +
                        '<pre><code class="val">' + val[4].replace(/[<>&"]/g, function (c) {
                            return {'<': '&lt;', '>': '&gt;', '&': '&amp;', '"': '&quot;'}[c];
                        }) + '</code></pre>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>';
                    line++;
                });
                t.table.rows.add(rows).draw(false);
                $('#modals').append(modal);
                $('#read_rows').text('Loaded('+ t.table.page.info().recordsDisplay +')');
            }
        }

        var ReadLog = new ReadLog('{{ request("f") }}');
        ReadLog.load();

        $('.btn-load').click(function(){
            var number = $('#load_number').val();
            ReadLog.load(number);
        });
        $('[name="search"]').keyup(function () {
            if ($(document).prop('comStart')) return;    // 中文输入过程中不截断
            NProgress.start();
            ReadLog.table.search($('input[name="search"]').val()).draw(false);
            $('#read_rows').text('Loaded('+ ReadLog.table.page.info().recordsDisplay +')');
            NProgress.done();
        }).on('compositionstart', function () {
            $(document).prop('comStart', true);
        }).on('compositionend', function () {
            $(document).prop('comStart', false);
        });

    });


</script>
</body>
</html>
