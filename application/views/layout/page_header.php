<?php
/**
 * Created by PhpStorm.
 * User: Chandra
 * Date: 2/8/2016
 * Time: 5:33 AM
 */?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>IMS | <?php echo (isset($menu))?$menu:'$ menu belum ada';?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link rel="shortcut icon" href="<?php echo base_url()?>assets/SIB1.png">
    <!-- Bootstrap 3.3.4 -->
    <link href="<?php echo base_url()?>assets/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url()?>assets/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url()?>assets/dist/css/AdminLTE.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?php echo base_url()?>assets/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/datatables/jquery.dataTables.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url()?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url()?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- SlimScroll -->
    <script src="<?php echo base_url()?>assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='<?php echo base_url()?>assets/plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url()?>assets/dist/js/app.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url()?>assets/plugins/datatables/jquery.dataTables.js"></script>
    <link rel="stylesheet" href="<?php echo base_url()?>assets/validation/css/screen.css"/>
    <script src="<?php echo base_url()?>assets/validation/dist/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url()?>assets/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <style type="text/css">
    .btn-frm{
        width: 100px;
    }
    th{
        text-align: center;
    }
    td{
        font-size: 10px;
    }
    thead{
        background-color: #79C3F9;
    }
    .dataTables_wrapper { font-size: 12px }
    </style>
    <!-- AdminLTE for demo purposes
<script src="<?php echo base_url()?>assets/dist/js/demo.js" type="text/javascript"></script>-->
    <![endif]-->
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="skin-blue layout-top-nav">
<div class="wrapper">

    <header class="main-header">
        <nav class="navbar navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <a href="<?php echo base_url()?>home" class="navbar-brand"><b>IMS</b></a>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                    <ul class="nav navbar-nav">
                        <!-- <li class="active"><a href="#">Produksi Berjalan <span class="sr-only">(current)</span></a></li> -->
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Kredit Guna Bhakti<span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="<?php echo base_url()?>kgb/dpa">Daftar Peserta Asuransi</a></li>
                                <li><a href="<?php echo base_url()?>kgb/rekap">Rekap Peserta Asuransi</a></li>
                                <li><a href="<?php echo base_url()?>kgb/klaim">Klaim</a></li>
                                <li><a href="<?php echo base_url()?>kgb/restitusi">Restitusi</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Rekapitulasi Premi</a></li>
                        <li><a href="#">Rekonsiliasi</a></li>
                    </ul>
                    <!--<form class="navbar-form navbar-left" role="search">
                        <div class="form-group">
                            <input type="text" class="form-control" id="navbar-search-input" placeholder="Search">
                        </div>
                    </form>-->
                </div><!-- /.navbar-collapse -->
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less->
                        <li class="dropdown messages-menu">
                            <!-- Menu toggle button ->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-envelope-o"></i>
                                <span class="label label-success">4</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 4 messages</li>
                                <li>
                                    <!-- inner menu: contains the messages ->
                                    <ul class="menu">
                                        <li><!-- start message ->
                                            <a href="#">
                                                <div class="pull-left">
                                                    <!-- User Image ->
                                                    <img src="<?php echo base_url()?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
                                                </div>
                                                <!-- Message title and timestamp ->
                                                <h4>
                                                    Support Team
                                                    <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                                </h4>
                                                <!-- The message ->
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li><!-- end message ->
                                    </ul><!-- /.menu ->
                                </li>
                                <li class="footer"><a href="#">See All Messages</a></li>
                            </ul>
                        </li><!-- /.messages-menu -->

                        <!-- Notifications Menu ->
                        <li class="dropdown notifications-menu">
                            <!-- Menu toggle button ->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bell-o"></i>
                                <span class="label label-warning">10</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 10 notifications</li>
                                <li>
                                    <!-- Inner Menu: contains the notifications ->
                                    <ul class="menu">
                                        <li><!-- start notification ->
                                            <a href="#">
                                                <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                            </a>
                                        </li><!-- end notification ->
                                    </ul>
                                </li>
                                <li class="footer"><a href="#">View all</a></li>
                            </ul>
                        </li>-->
                        <!-- Tasks Menu ->
                        <li class="dropdown tasks-menu">
                            <!-- Menu Toggle Button ->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-flag-o"></i>
                                <span class="label label-danger">9</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 9 tasks</li>
                                <li>
                                    <!-- Inner menu: contains the tasks ->
                                    <ul class="menu">
                                        <li><!-- Task item ->
                                            <a href="#">
                                                <!-- Task title and progress text ->
                                                <h3>
                                                    Design some buttons
                                                    <small class="pull-right">20%</small>
                                                </h3>
                                                <!-- The progress bar ->
                                                <div class="progress xs">
                                                    <!-- Change the css width attribute to simulate progress ->
                                                    <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">20% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li><!-- end task item ->
                                    </ul>
                                </li>
                                <li class="footer">
                                    <a href="#">View all tasks</a>
                                </li>
                            </ul>
                        </li>-->
                        <!-- User Account Menu -->
                        <li class="dropdown user user-menu">
                            <!-- Menu Toggle Button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <!-- The user image in the navbar-->
                                <img src="<?php echo base_url()?>assets/dist/img/user2-160x160.jpg" class="user-image" alt="User Image"/>
                                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                <span class="hidden-xs"><?php echo $this->session->userdata('username');?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- The user image in the menu -->
                                <li class="user-header">
                                    <img src="<?php echo base_url()?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" />
                                    <p>
                                        <?php echo $this->session->userdata('username');?>
                                        <small></small>
                                    </p> 
                                </li>
                                <!-- Menu Body ->
                                <li class="user-body">
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Followers</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Sales</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Friends</a>
                                    </div>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?php echo base_url()?>welcome/logout" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div><!-- /.navbar-custom-menu -->
            </div><!-- /.container-fluid -->
        </nav>
    </header><br><br>
    <!-- Full Width Column -->
    <div class="content-wrapper">
        <div class="container">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    <?php echo (isset($judul))?$judul:" <h4>Insurance Management System</h4>";  ?>
                    <!--Top Navigation
                    <small>Example 2.0</small>-->
                </h1>
                <ol class="breadcrumb">
                    <?php $a=count($bc);$n=1; ?>
                    <?php
                        foreach($bc as $a=>$b){
                            $icon=($n==1)?'<i class="fa fa-dashboard"></i>':'';
                            $class=($a==$n)?'active':'';
                            echo '<li class="'.$class.'"><a href="'.$b.'">'.$icon.' '.$a.'</a></li>';
                            $n++;
                        }
                    ?><br><br>
                    <!--<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Dashboard</li>-->
                </ol>
            </section>
            <!-- Main content -->
            <section class="content">
