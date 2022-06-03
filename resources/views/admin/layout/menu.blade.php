<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li>
                <a href="admin/dashboard/report-total"><i class="fa fa-dashboard fa-fw"></i> Dashboard <i class="fa arrow"></i></a>
            </li>
            <li>
                <a href="admin/topic/list-topic"><i class="fa fa-tasks"></i> Chủ đề<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="admin/topic/list-topic">Danh sách chủ đề</a>
                    </li>
                    <li>
                        <a href="admin/topic/add-topic">Thêm mới chủ đề</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href=""><i class="fa fa-car"></i> Game<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="admin/game/list-game">Danh sách game</a>
                    </li>
                    <li>
                        <a href="admin/game/add-game">Thêm mới game</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="admin/service/list-service"><i class="glyphicon glyphicon-calendar"></i> Activity<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="admin/activity/list-activity">Danh sách activity</a>
                    </li>
                    <li>
                        <a href="admin/activity/add-activity">Thêm mới activity</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>

            <li>
                <a href="admin/staff/list-staff"><i class="glyphicon glyphicon-user"></i> User<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="admin/user/list-user">Danh sách user</a>
                    </li>
                    <li>
                        <a href="admin/staff/list-staff">Danh sách nhân sự</a>
                    </li>
                    @if(Auth::user()->role==1)
                        <li>
                            <a href="admin/staff/add-staff">Thêm mới nhân sự</a>
                        </li>
                    @endif
                </ul>
                <!-- /.nav-second-level -->
            </li>

        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->
