@extends('admin.layout.index')
@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Game
                        <small>Sửa</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-12" style="padding-bottom:30px">
                    <form action="admin/game/edit-game/{{$game->id}}" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group">
                            <label>Tên game</label>
                            <input class="form-control" name="name" placeholder="Nhập tên game" value="{{$game->name}}"/>
                        </div>
                        <div class="form-group">
                            <label>Hình ảnh</label><br>
                            <img width="250px" src="image/game/{{$game->thumb}}" alt="Image not showing"><br><br>
                            <input type="file" name="image" class="form-control" accept="image/*">
                        </div>
                        <div class="form-group">
                            <label>Resouce</label><br>
                            <input type="file" name="path" class="form-control" accept="zip,application/octet-stream,application/zip,application/x-zip,application/x-zip-compressed">
                        </div>
                        <div class="form-group">
                            <label>Trạng thái</label>
                            <select name="status" class="form-control">
                                <option value="1" @if($game->status==$status['IS_ACTIVE']) selected @endif>Đang hoạt động</option>
                                <option value="0" @if($game->status==$status['IS_NOT_ACTIVE']) selected @endif>Tạm ngưng</option>
                            </select>
                        </div>
                        <br><br>
                        <button type="submit" class="btn btn-default">Cập nhật</button>
                        <button type="reset" class="btn btn-default">Làm mới</button>
                    </form>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
@endsection
@section('script')
@endsection
