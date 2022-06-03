@extends('admin.layout.index')
@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Nhân sự
                        <small>Thêm mới</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
                    <form autocomplete="off" action="admin/staff/add-staff" method="POST">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group">
                            <label>Họ tên</label>
                            <input class="form-control" name="name" placeholder="Tên nhân sự"/>
                        </div>
                        <div class="form-group">
                            <label>Email đăng nhập</label>
                            <input class="form-control" type="email" name="email" placeholder="Địa chỉ email"/>
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
                                @foreach($roles as $key => $value)
                                    <option value="{{$key}}">
                                        {{$value}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <br><br>
                        <button type="submit" class="btn btn-default">Thêm</button>
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
