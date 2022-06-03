@extends('admin.layout.index')
@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Activity
                        <small>Thêm mới</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-12" style="padding-bottom:120px">
                    <form action="admin/activity/add-activity" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group">
                            <label>Tên activity</label>
                            <input class="form-control" name="name" placeholder="Nhập tên activity"/>
                        </div>
                        <div class="form-group">
                            <label>Chọn game</label>
                            <select name="game_id" class="form-control">
                                @foreach($listGame as $game)
                                    <option value="{{$game->id}}">{{$game->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <br><br>
                        <div class="form-group">
                            <label>File Data</label>
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
