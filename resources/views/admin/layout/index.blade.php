<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title></title>
    <base href="{{asset('')}}">
    <!-- Bootstrap Core CSS -->
    <link href="admin_asset/css/font-awesome.min.css" rel="stylesheet">
    <link href="admin_asset/css/nice-style.css" rel="stylesheet">
    <link href="admin_asset/css/admin.css" rel="stylesheet">
    <link href="admin_asset/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="admin_asset/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="admin_asset/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="admin_asset/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- DataTables CSS -->
    <link href="admin_asset/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="admin_asset/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">

</head>

<body>
<div class="loader">
    <div class="bounce"></div>
    <div class="bounce"></div>
    <div class="bounce"></div>
    <div class="dot-text"></div>
</div>

<div id="wrapper">

    <!-- Navigation -->
    @include('admin.layout.header')
    @include('admin.layout.alert')
    <!-- Page Content -->
    @yield('content')

</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="admin_asset/bower_components/jquery/dist/jquery.min.js"></script>
<script src='admin_asset/js/jquery-ui.min.js'></script>
<!-- Bootstrap Core JavaScript -->
<script src="admin_asset/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="admin_asset/bower_components/metisMenu/dist/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="admin_asset/dist/js/sb-admin-2.js"></script>

<script src="admin_asset/js/admin.js"></script>
<script src="admin_asset/js/Chart.min.js"></script>
<script src="admin_asset/js/step.js"></script>
<script src="admin_asset/js/jquery.nice-select.min.js"></script>

<!-- DataTables JavaScript -->
{{--<script src="admin_asset/bower_components/DataTables/media/js/jquery.dataTables.min.js"></script>--}}
{{--<script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>--}}
<script src="add/jquery.dataTables.min.js"></script>
<script src="admin_asset/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>


<link rel="stylesheet" href="add/choices.min.css"/>
<script src="add/choices.min.js"></script>

{{--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css"/>--}}
{{--<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>--}}


<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
	$ (document).ready (function () {
		$ ('#dataTables-example').DataTable ({
			responsive : true
		});
	});
</script>
<script type="text/javascript" language="javascript" src="admin_asset/ckeditor/ckeditor.js"></script>
@yield('script')
<div id="loader" class="center"></div>
<div class="modal-backdrop fade show"></div>
</body>
</html>
