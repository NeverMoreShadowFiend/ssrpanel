@extends('admin.layouts')

@section('css')
    <link href="/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('title', '控制面板')
@section('content')
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE BREADCRUMB -->
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="{{url('admin')}}">管理中心</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="{{url('admin/nodeList')}}">节点管理</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="{{url('admin/addNode')}}">添加节点</a>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMB -->
        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="tab-pane active" id="tab_0">
            <div class="portlet light bordered">
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form action="{{url('admin/addNode')}}" method="post" class="form-horizontal" onsubmit="return do_submit();">
                        <div class="form-body">
                            <div class="form-group">
                                <label for="name" class="col-md-4 control-label"> 节点名称 </label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="name" id="name" placeholder="" required>
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="server" class="col-md-4 control-label"> 服务器地址 </label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="server" id="server" placeholder="" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="method" class="col-md-4 control-label">加密方式</label>
                                <div class="col-md-4">
                                    <select class="form-control" name="method" id="method">
                                        @foreach ($method_list as $method)
                                            <option value="{{$method->name}}" @if($method->is_default) selected @endif>{{$method->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="custom_method" class="col-md-4 control-label">自定义加密方式</label>
                                <div class="col-md-4">
                                    <select class="form-control" name="custom_method" id="custom_method">
                                        @foreach ($method_list as $method)
                                            <option value="{{$method->name}}" @if($method->is_default) selected @endif>{{$method->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="traffic_rate" class="col-md-4 control-label"> 流量比例 </label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="traffic_rate" value="1.0" id="traffic_rate" placeholder="" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="protocol" class="col-md-4 control-label">协议</label>
                                <div class="col-md-4">
                                    <select class="form-control" name="protocol" id="protocol">
                                        @foreach ($protocol_list as $protocol)
                                            <option value="{{$protocol->name}}" @if($protocol->is_default) selected @endif>{{$protocol->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="protocol_param" class="col-md-4 control-label"> 协议参数 </label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="protocol_param" id="protocol_param" placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="obfs" class="col-md-4 control-label">混淆</label>
                                <div class="col-md-4">
                                    <select class="form-control" name="obfs" id="obfs">
                                        @foreach ($obfs_list as $obfs)
                                            <option value="{{$obfs->name}}" @if($obfs->is_default) selected @endif>{{$obfs->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="obfs_param" class="col-md-4 control-label"> 混淆参数 </label>
                                <div class="col-md-4">
                                    <textarea class="form-control" rows="5" name="obfs_param" id="obfs_param"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="bandwidth" class="col-md-4 control-label">出口带宽</label>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="bandwidth" id="bandwidth" placeholder="">
                                        <span class="input-group-addon">M</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="traffic" class="col-md-4 control-label">每月可用流量</label>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <input type="text" class="form-control right" name="traffic" id="traffic" placeholder="">
                                        <span class="input-group-addon">G</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="monitor_url" class="col-md-4 control-label">监控地址</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control right" name="monitor_url" value="" id="monitor_url" placeholder="">
                                    <span class="help-block"> 例如：http://us1.xxx.com/monitor.php </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="sort" class="col-md-4 control-label">排序</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="sort" value="0" id="sort" placeholder="">
                                    <span class="help-block"> 值越大排越前 </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="status" class="col-md-4 control-label">状态</label>
                                <div class="col-md-4">
                                    <select class="form-control" name="status" id="status">
                                        <option value="1" selected>正常</option>
                                        <option value="0">维护</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-5 col-md-4">
                                    <button type="submit" class="btn green"> 提 交 </button>
                                    <button type="button" class="btn default"> 取 消 </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- END FORM-->
                </div>
            </div>
        </div>
        <!-- END PAGE BASE CONTENT -->
    </div>
    <!-- END CONTENT BODY -->
@endsection
@section('script')
    <script src="/assets/global/plugins/bootbox/bootbox.min.js" type="text/javascript"></script>

    <script type="text/javascript">
        // ajax同步提交
        function do_submit() {
            var _token = '{{csrf_token()}}';
            var name = $('#name').val();
            var server = $('#server').val();
            var method = $('#method').val();
            var custom_method = $('#custom_method').val();
            var traffic_rate = $('#traffic_rate').val();
            var protocol = $('#protocol').val();
            var protocol_param = $('#protocol_param').val();
            var obfs = $('#obfs').val();
            var obfs_param = $('#obfs_param').val();
            var bandwidth = $('#bandwidth').val();
            var traffic = $('#traffic').val();
            var monitor_url = $('#monitor_url').val();
            var sort = $('#sort').val();
            var status = $('#status').val();

            $.ajax({
                type: "POST",
                url: "{{url('admin/addNode')}}",
                async: false,
                data: {_token:_token, name: name, server:server, method:method, custom_method:custom_method, traffic_rate:traffic_rate, protocol:protocol, protocol_param:protocol_param, obfs:obfs, obfs_param:obfs_param, bandwidth:bandwidth, traffic:traffic, monitor_url:monitor_url, sort:sort, status:status},
                dataType: 'json',
                success: function (ret) {
                    if (ret.status == 'success') {
                        bootbox.alert(ret.message, function () {
                            window.location.href = '{{url('admin/nodeList')}}';
                        });
                    } else {
                        bootbox.alert(ret.message);
                    }
                }
            });

            return false;
        }
    </script>
@endsection