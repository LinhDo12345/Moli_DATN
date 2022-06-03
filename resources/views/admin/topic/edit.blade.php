@extends('admin.layout.index')
@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Chủ đề
                        <small>Sửa</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-12" style="padding-bottom:120px">
                    <form action="admin/topic/edit-topic/{{$topic->id}}" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group">
                            <label>Tên chủ đề</label>
                            <input class="form-control" name="name" placeholder="Nhập tên chủ đề" value="{{$topic->name}}"/>
                        </div>
                        <div class="form-group">
                            <label>Hình ảnh</label><br>
                            <img width="250px" src="image/topic/{{$topic->thumb}}" alt="Image not showing"><br><br>
                            <input type="file" name="image" class="form-control" accept="image/*">
                        </div>

                        <div class="form-group">
                            <label>Chọn hoạt động</label><br>

                            <select id="js-choice" name="activity_id[]" multiple="multiple">
                                @foreach($listActivity as $activity)
                                    <option value="{{$activity->id}}">{{$activity->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Trạng thái</label>
                            <select name="status" class="form-control">
                                <option value="1" @if($topic->status==$status['IS_ACTIVE']) selected @endif>Active</option>
                                <option value="0" @if($topic->status==$status['IS_NOT_ACTIVE']) selected @endif>Inactive</option>
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

@section('script')
    <script>
	    const choices = new Choices("#js-choice", {
		    removeItems: true,
		    removeItemButton: true
	    });

    </script>
@endsection
