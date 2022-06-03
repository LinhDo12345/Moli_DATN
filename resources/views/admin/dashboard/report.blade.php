@extends('admin.layout.index')
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row" style="margin-top: 20px;">
                <div class="col-md-3">
                    <div class="panel panel-primary">
                        <div class="panel-heading" style="background: #007BFF;">
                            <i class="glyphicon glyphicon-user glyphicon">  {{$data['countTopic']}} </i> Chủ đề
                        </div>
                        <a href="/admin/topic/list-topic" style="text-decoration: none">
                            <div class="panel-body" style="background:#007BFF;color: white">
                                Chi tiết <i class="fa fa-angle-right pull-right"></i>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="panel panel-warning">
                        <div class="panel-heading" style="background: #FFC107;color: white">
                            <i class="glyphicon glyphicon-user glyphicon"> {{$data['countGame']}} </i> Game
                        </div>
                        <a href="admin/game/list-game" style="text-decoration: none">
                            <div class="panel-body" style="background:#FFC107;color: white">
                                Chi tiết <i class="fa fa-angle-right pull-right"></i>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="panel panel-success">
                        <div class="panel-heading" style="background: #28A745;color: white">
                            <i class="glyphicon glyphicon-calendar"> {{$data['countActivity']}} </i> Activity
                        </div>
                        <a href="/admin/activity/list-activity" style="text-decoration: none">
                            <div class="panel-body" style="background:#28A745;color: white">
                                Chi tiết <i class="fa fa-angle-right pull-right"></i>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="panel panel-danger">
                        <div class="panel-heading" style="background: #DC3545;color: white">
                            <i class="glyphicon glyphicon-user"> {{$data['countUser']}} </i> Người dùng
                        </div>
                        <a href="/admin/user/list-user" style="text-decoration: none">
                            <div class="panel-body" style="background:#DC3545;color: white">
                                Chi tiết <i class="fa fa-angle-right pull-right"></i>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
    </div>
@endsection




