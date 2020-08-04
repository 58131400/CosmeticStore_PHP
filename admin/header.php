<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin</title>

    <!-- Core CSS - Include with every page -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Page-Level Plugin CSS - Dashboard -->
    <link href="css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">
    <link href="css/plugins/timeline/timeline.css" rel="stylesheet">

    <!-- SB Admin CSS - Include with every page -->
    <link href="css/sb-admin.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Courgette&display=swap" rel="stylesheet">

</head>

<body>
t
    <div id="wrapper">

        <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <p class="navbar-brand" href="index.php"><a  href="../index.php"><strong style="font-family: 'Courgette', cursive;">Như Quỳnh</strong> Shop</a> </p>
	
            </div>
            <!-- /.navbar-header -->
	
            <ul class="nav navbar-top-links navbar-right">
		<li style="margin-right:0px;">
                  <a href="../ct_khach_hang.php?makh=<?php 
                    require 'connect.php';
                     session_start();
                     if (isset($_SESSION['username'])) {
                            //echo $_SESSION['username'];
                            $q= "select makh from khach_hang join tai_khoan on khach_hang.matk = tai_khoan.matk where ID = '".$_SESSION['username']."'";
                            
                            $r = mysqli_query($conn,$q);
                            while($row = mysqli_fetch_array($r))
                            {
                                echo $row['makh'];
                            }
                        }   
                    ?>"><i class="fa fa-user fa-fw"></i> <?php echo $_SESSION['username']?></li>
		</a>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <!-- /.dropdown-messages -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-tasks fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                 </li>
                    <!-- /.dropdown-tasks -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <!-- /.dropdown-alerts -->
                </li>
                <!-- /.dropdown -->
                
		<li class="dropdown"><a href ="#"  class ="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-gear fa-fw"></i>
		<i class="fa fa-caret-down "  ></i></a>
                    
                    <ul class="dropdown-menu dropdown-user">
                      
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="../Logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
		</div>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default navbar-static-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Tổng quan</a>
                        </li>
                        <li>
                            <a href="donhang.php"><i class="fa fa-shopping-cart fa-fw"></i> Đơn hàng</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-table fa-fw"></i> QL Sản phẩm <span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li>
                                    <a href="sanpham.php">Sản phẩm</a>
                                </li>
                                <li>
                                    <a href="loai_sp.php">Loại sản phẩm</a>
                                </li>
                                <li>
                                    <a href="nha_sx.php">Nhà sản xuất</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="khachhang.php"><i class="fa fa-user fa-fw"></i> Khách hàng</a>
                        </li>
                        <li>
                            <a href="taikhoan.php"><i class="fa fa-wrench fa-fw"></i> Thiết lập tài khoản</a>
                        </li>
                    </ul>
                    <!-- /#side-menu -->
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
