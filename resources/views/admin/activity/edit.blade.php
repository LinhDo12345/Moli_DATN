@extends('admin.layout.index')
@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Activity
                        <small>Sửa</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-12" style="padding-bottom:30px">
                    <form action="admin/activity/edit-activity/{{$activity->id}}" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group">
                            <label>Tên activity</label>
                            <input class="form-control" name="name" placeholder="Nhập tên activity" value="{{$activity->name}}"/>
                        </div>
                        <div class="form-group">
                            <label>Chọn game</label>
                            <select name="game_id" class="form-control">
                                @foreach($listGame as $game)
                                    @if($activity->game_id==$game->id)
                                        <option value="{{$game->id}}" selected>{{$game->name}}</option>
                                    @else
                                        <option value="{{$game->id}}">{{$game->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <br><br>
                        <div class="form-group">
                            <label>File data</label><br>
                            <input type="file" name="path" class="form-control" accept="zip,application/octet-stream,application/zip,application/x-zip,application/x-zip-compressed">
                        </div>
                        <div class="form-group">
                            <label>Trạng thái</label>
                            <select name="status" class="form-control">
                                <option value="1" @if($activity->status==$status['IS_ACTIVE']) selected @endif>Active</option>
                                <option value="0" @if($activity->status==$status['IS_NOT_ACTIVE']) selected @endif>Inactive</option>
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
