@extends('admin.layout.index')
@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Người dùng
                        <small>Danh sách</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <table style="font-size: 14px" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                    <tr>
                        <th class="text-center">STT</th>
                        <th class="text-center">Tên</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Ngày tạo</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php($i=0)
                    @foreach($listUser as $user)
                        @php($i++)
                        <tr class="odd gradeX" align="center">
                            <td>{{$i}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{ date('d/m/Y', $user->time_created)}}</td>
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
