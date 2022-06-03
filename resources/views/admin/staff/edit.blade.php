@extends('admin.layout.index')
@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Nhân sự
                        <small>{{$staff->name}}</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
                    <form action="admin/staff/edit-staff/{{$staff->id}}" method="POST">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group">
                            <label>Họ tên</label>
                            <input class="form-control hidden" name="id" value="{{$staff->id}}"/>
                            <input class="form-control" name="name" placeholder="Tên nhân sự" value="{{$staff->name}}"/>
                        </div>
                        <div class="form-group">
                            <label>Email đăng nhập</label>
                            <input disabled class="form-control" type="email" name="email" placeholder="Địa chỉ email" value="{{$staff->email}}"/>
                        </div>
                        <div class="form-group">
                            <label>Mật khẩu</label>
                            <input type="password" class="form-control" name="password" placeholder="Mật khẩu"/>
                        </div>
                        <div class="form-group">
                            <label>Nhập lại mật khẩu</label>
                            <input class="form-control" name="repassword" type="password" placeholder="Nhập lại mật khẩu"/>
                        </div>
                        <div class="form-group">
                            <label>Chức vụ</label>
                            <select name="role" class="form-control">
                                    <option value="1"  @if($staff->role==1) selected @endif>Admin</option>
                                    <option value="2"  @if($staff->role==2) selected @endif>Chuyên viên</option>
                            </select>
                        </div>
                        <br><br>
                        <div class="form-group">
                            <label>Trạng thái</label>
                            <select name="status" class="form-control">
                                <option value="1"  @if($staff->status==1) selected @endif>Đang hoạt động</option>
                                <option value="0"  @if($staff->status==0) selected @endif>Tạm ngưng</option>
                            </select>
                        </div>
                        <br><br>
                        <button type="submit" class="btn btn-default">Cập nhật</button>
                        <button type="reset" class="btn btn-default">Làm mới</button>
                        </form>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
@endsection
