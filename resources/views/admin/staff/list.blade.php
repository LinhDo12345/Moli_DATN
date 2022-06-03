@extends('admin.layout.index')
@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Nhân sự
                        <small>Danh sách</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <table style="font-size: 14px" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                    <tr>
                        <th class="text-center">STT</th>
                        <th class="text-center">Họ tên</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Quyền</th>
                        <th class="text-center">Trạng thái</th>
                        <th class="text-center">Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php($i=0)
                    @foreach($staffs as $staff)
                        @php($i++)
                        <tr class="odd gradeX" align="center">
                            <td>{{$i}}</td>
                            <td>{{$staff->name}}</td>
                            <td>{{$staff->email}}</td>
                            <td>
                                @if($staff->role==1)
                                    <span class="badge badge-primary">Admin</span>
                                @else
                                    <span class="badge badge-default">Chuyên viên</span>
                                @endif
                            </td>
                            <td>
                                @if($staff->status==1)
                                    <span class="badge badge-success">Đang hoạt động</span>
                                @else
                                    <span class="badge badge-success">Đang tạm khóa</span>
                                @endif
                            </td>
                            <td>
                                <a @if(Auth::user()->role!=1) disabled @endif class="mb btn btn-warning btn-sm" href="admin/staff/edit-staff/{{$staff->id}}"><i class="fa fa-pencil fa-fw"></i> Sửa</a><br>
                                <a @if(Auth::user()->role!=1) disabled @endif class="mb btn btn-danger btn-sm" href="admin/staff/delete-staff/{{$staff->id}}"><i class="fa fa-trash-o fa-fw"></i> Xóa</a><br>
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
