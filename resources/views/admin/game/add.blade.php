@extends('admin.layout.index')
@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Game
                        <small>Thêm mới</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-12" style="padding-bottom:120px">
                    <form action="admin/game/add-game" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group">
                            <label>Tên game</label>
                            <input class="form-control" name="name" placeholder="Nhập tên game"/>
                        </div>
                        <div class="form-group">
                            <label>Hình ảnh </label>
                            <input type="file" name="image" class="form-control" accept="image/*">
                        </div>
                        <div class="form-group">
                            <label>File resource </label>
                            <input type="file" name="path" class="form-control" accept="zip,application/octet-stream,application/zip,application/x-zip,application/x-zip-compressed">
                        </div>
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

@section('script')
    <script>

    </script>
@endsection
