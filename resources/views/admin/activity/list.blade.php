@extends('admin.layout.index')
@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Activity
                        <small>Danh sách</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <table style="font-size: 14px" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                    <tr align="center">
                        <th class="text-center">STT</th>
                        <th class="text-center" style="min-width: 200px;">Tên</th>
                        <th class="text-center">Game play</th>
                        <th style="min-width: 90px;">Trạng thái</th>
                        <th class="text-center" style="min-width: 100px;">Thời gian</th>
                        <th style="min-width: 80px;">Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php($i=0)
                    @foreach($listActivity as $activity)
                        @php($i++)
                        <tr class="odd gradeX" align="center">
                            <td>{{$i}}</td>
                            <td>{!! $activity->name !!}</td>
                            <td>
                                @if(isset($listGame[$activity->game_id]))
	                            {{$listGame[$activity->game_id]['name']}}
                                @endif
                            </td>
                            <td>
                                @if($activity->status==$status['IS_ACTIVE'])
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-danger">Inactive</span>
                                @endif
                            </td>
                            <td>{{ date('d/m/Y', $activity->time_created)}}</td>
                            <td>
                                <a class="mb btn btn-warning btn-sm" href="admin/activity/edit-activity/{{$activity->id}}"><i class="fa fa-pencil fa-fw"></i> Sửa</a><br>
                                <a class="mb btn btn-danger btn-sm" href="admin/activity/delete-activity/{{$activity->id}}"><i class="fa fa-trash-o fa-fw"></i> Xóa</a><br>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
@endsection

<style>
    select {
        display: inline !important;
    }

    .nice-select {
        display: none !important;
    }
</style>

