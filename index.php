<!DOCTYPE html>

<?php 
session_start();
require 'connect.php';
include'header.php';?>
<link href="assets/css/style.css" rel="stylesheet" />
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="well well-lg offer-box text-center">


                   Today's best sale : &nbsp; <span class="glyphicon glyphicon-cog"></span>&nbsp;40 % off  on purchase of $ 2,000 and above till 24 dec !                
              
               
                </div>
                <div class="main box-border">
                    <div id="mi-slider" class="mi-slider">
                        
  
                           <?php 
                                include('mi-slider.php');
                           ?>
                        
                        
                    
                        <nav>
                            <a href="#">Mỹ phẩm</a>
                            <a href="#">Thực Phẩm CN</a>
                            <a href="#">Nước hoa</a>
                            <!--<a href="#">Bags</a> -->
                        </nav>
                    </div>
                    
                </div>
                <br />
            </div>
            <!-- /.col -->
            
            <div class="col-md-3 text-center">
                
                    <?php include 'best-sale.php'; ?>
                
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-md-3" id="left-menu">
                <?php include 'left-menu.php'; ?>
            <div class="col-md-9" id="right-content">
                <?php include 'right-content.php'?>
                <!-- /.row -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
    <div class="col-md-12 download-app-box text-center">

        <span class="glyphicon glyphicon-download-alt"></span>Download Our Android App and Get 10% additional Off on all Products . <a href="#" class="btn btn-danger btn-lg">DOWNLOAD  NOW</a>

    </div>

    <!--Footer -->
    <?php include 'footer.php'; ?>
</body>
</html>
