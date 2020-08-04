<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Bootstrap E-Commerce Template- DIGI Shop mini</title>
    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!-- Fontawesome core CSS -->
    
    <link rel="stylesheet" type="text/css" href="">
    <!--GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Courgette&display=swap" rel="stylesheet">
    <!--Slide Show Css -->
    <link href="assets/ItemSlider/css/main-style.css" rel="stylesheet" />
    <!--link jquery-->
    
    <!-- custom CSS here -->
    
    <link href="assets/fontawesome/css/all.css" rel="stylesheet" />
</head>
<body>
    <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><strong style="font-family: 'Courgette', cursive;">Như Quỳnh</strong> Shop</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">


                <ul class="nav navbar-nav navbar-right">
                    <?php
                    
                    if(isset($_SESSION['username'])) 
                    {
                         echo '<li><a href="ct_khach_hang.php?makh=';
                            $q= "select makh from khach_hang join tai_khoan on khach_hang.matk = tai_khoan.matk where ID = '".$_SESSION['username']."'";
                            
                            $r = mysqli_query($conn,$q);
                            while($row = mysqli_fetch_array($r))
                            {
                                echo $row['makh'];
                            }
                          echo '"><span class ="fas fa-user text-white"></span> '.$_SESSION['username'].'</a></li>
                     <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i>Đăng xuất</a></li>';
                      }  
                    else
                        echo '<li><a href="Dangnhap.php">Đăng nhập</a></li>
                    <li><a href="register.php">Đăng kí</a></li>';
                    ?>
                    <li>
                        <a href="cart.php"><i class="fas fa-shopping-cart"></i> Giỏ hàng <span style="background: orange; "><?php if(isset($_SESSION['username']))
                            {
                                if(isset($_SESSION['cart'])) echo count($_SESSION['cart']); 
                            }
                            else
                            {
                                if(isset($_SESSION['cart'])) unset($_SESSION['cart']);
                            }
                            ?></span></a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="far fa-question-circle"></i>Hỗ trợ<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#"><strong>SĐT: </strong>0986604577</a></li>
                            <li><a href="#"><strong>Mail: </strong>xichlong.it@gmail.com</a></li>
                            <li class="divider"></li>
                            <li><a href="#"><strong>Địa chỉ: </strong>
                                <div>
                                    1/16 Đường 1C<br />
                                    Nha Trang, Khánh Hòa
                                </div>
                            </a></li>
                        </ul>
                    </li>

                </ul>
                <form class="navbar-form navbar-right" role="search" method="post" action="timkiem.php">
                    <div class="form-group">
                        <input type="text" placeholder="Nhập tên sản phẩm" class="form-control" name="keysearch">
                    </div>
                    &nbsp; 
                    <button type="submit" class="btn btn-primary" name="search">Tìm kiếm</button>
                </form>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>