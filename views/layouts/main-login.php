<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
    <meta charset="utf-8" />
    <title>Авторизация</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />

    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="/theme/assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
    <link href="/theme/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/theme/assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="/theme/assets/css/animate.min.css" rel="stylesheet" />
    <link href="/theme/assets/css/style.min.css" rel="stylesheet" />
    <link href="/theme/assets/css/style-responsive.min.css" rel="stylesheet" />
    <!-- ================== END BASE CSS STYLE ================== -->

    <!-- ================== BEGIN BASE JS ================== -->
    <script src="/theme/assets/plugins/pace/pace.min.js"></script>
    <!-- ================== END BASE JS ================== -->
</head>
<body class="pace-top">
<!-- begin #page-loader -->
<div id="page-loader" class="fade in"><span class="spinner"></span></div>
<!-- end #page-loader -->

<!-- begin #page-container -->
<div id="page-container" class="fade">
    <!-- begin login -->
    <?=$content?>
    <!-- end login -->

</div>
<!-- end page container -->

<!-- ================== BEGIN BASE JS ================== -->
<script src="/theme/assets/plugins/jquery/jquery-1.9.1.min.js"></script>
<script src="/theme/assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
<script src="/theme/assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
<script src="/theme/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<!--[if lt IE 9]>
<script src="/theme/assets/plugins/crossbrowserjs/html5shiv.js"></script>
<script src="/theme/assets/plugins/crossbrowserjs/respond.min.js"></script>
<script src="/theme/assets/plugins/crossbrowserjs/excanvas.min.js"></script>
<![endif]-->
<script src="/theme/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="/theme/assets/plugins/jquery-cookie/jquery.cookie.js"></script>
<!-- ================== END BASE JS ================== -->

<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="/theme/assets/js/apps.min.js"></script>
<!-- ================== END PAGE LEVEL JS ================== -->

<script>
    $(document).ready(function() {
        App.init();
    });
</script>
</body>
</html>
