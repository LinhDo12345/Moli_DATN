@extends('admin.layout.index')
@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Chủ đề
                        <small>Danh sách</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <table style="font-size: 14px" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                    <tr align="center">
                        <th class="text-center">STT</th>
                        <th class="text-center" style="min-width: 200px;">Tên</th>
                        <th class="text-center" style="min-width: 100px;">Hình ảnh</th>
                        <th style="min-width: 90px;">Trạng thái</th>
                        <th class="text-center" style="min-width: 100px;">Thời gian</th>
                        <th style="min-width: 80px;">Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php($i=0)
                    @foreach($listTopic as $topic)
                        @php($i++)
                        <tr class="odd gradeX" align="center">
                            <td>{{$i}}</td>
                            <td>{!! $topic->name !!}</td>
                            <td>
                                <img width="120px" src="image/topic/{{$topic->thumb}}">
                            </td>
                            <td>
                                @if($topic->status==$status['IS_ACTIVE'])
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-danger">Inactive</span>
                                @endif
                            </td>
                            <td>{{ date('d/m/Y', $topic->time_created)}}</td>
                            <td>
                                <a class="mb btn btn-warning btn-sm" href="admin/topic/edit-topic/{{$topic->id}}"><i class="fa fa-pencil fa-fw"></i> Sửa</a><br>
                                <a class="mb btn btn-danger btn-sm" href="admin/topic/delete-topic/{{$topic->id}}"><i class="fa fa-trash-o fa-fw"></i> Xóa</a><br>
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

