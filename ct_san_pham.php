

<?php
session_start();
require('Connect.php');
include 'header.php';
?>
 <link href="assets/css/style_chitiet_sp.css" rel="stylesheet"/>
<?php

	if(isset($_GET['Masp']))
		$Masp = $_GET['Masp']; 
	else $Masp = "MP0001";
	
	$sql = "SELECT *
	        FROM san_pham  JOIN loai_sp ON san_pham.maloai = loai_sp.maloai JOIN nha_san_xuat ON nha_san_xuat.mansx = san_pham.mansx
			WHERE Masp ='".$Masp."'";
	$result = mysqli_query($conn, $sql);
	if(mysqli_num_rows($result) <> 0){
		while($rows= mysqli_fetch_array($result))
		{
			
?>
 <section class="single-product">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-12 col-xs-12">
                    <figure>
                        <img src="assets/img/<?php echo $rows['hinh']?>" alt="">
                    </figure>
                </div>
                <div class="col-md-8 col-sm-12 col-xs-12">
                    <div class="section-title">
                        <h3><?php echo $rows['tensp']?></h3>
                        <span><?php echo number_format($rows['dongia'],0,".",",")?> VND</span>
						<p> Loại sản phẩm : <?php echo $rows['tenloai'] ?></p>
						<p> Nhà sản xuất: <?php echo $rows['tennsx'] ?></p>
						<p> Xuất xứ : <?php echo $rows['quocgia'] ?></p>
                    </div>
                    <div class="image-text">
                       
                        <div class="default-form-area">
                            <form method="get" action="cart.php" class="subscribe-form default-form">
                                <div class="form-group">
                                    <input type="number" placeholder="1" name ="quantity" value="1">
                                </div>
                                <div class="form-group">
                                    <input id="form_botcheck" name="id" class="form-control" type="hidden" value="<?php echo $rows['Masp']?>">
                                    <button type="submit" class="btn-style-one" data-loading-text="Please wait..." name="action" value ="add">add to cart</button>
                                </div>
                            </form>
                        </div>
                        <div class="tags">
                            <strong>Categories:</strong>
                            <a href="#">Products,</a>&nbsp;<a href="#">Bluetooth,</a>
                            <ul class="social-links">
                                <li><strong>Share:</strong>&nbsp;&nbsp;&nbsp;</li>
                                <li><a href="#"><i class="fab fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fab fa-pinterest-p" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fab fa-vimeo" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!--Tabs Box-->
            <div class="tabs-box">
                <!--Tab Buttons-->
                <div class="tab-buttons clearfix">
                    <a href="#tab-one" class="tab-btn active-btn">Details</a>
                </div>                        
                <!--Tabs Content-->
                <div class="tab-content">                            
                    <!--Tab / Active Tab-->
                    <div class="tab active-tab" id="tab-one" style="display: block">
                        <h3>Product Description</h3>
                        <div class="text">
						<p> <?php echo $rows['mota'];?></p>
                           </div> 
                    </div>                            
                    <!--Tab-->
                    <div class="tab" id="tab-two" style="display: none;">
                        <h3>Product Details</h3>
                        <div class="text">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur excepteur sint occaecat cupidatat non proident.sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut persp iciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantiumtotam rem aperiam lorem ipsum dolor sit amet, consectetur adip isicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat duis aute irure dolor.</p>
                        </div>                               
                    </div>                      
                </div>                    
            </div>
        </div>
    </section>
	</body>
	</html>
	<?php
		}
	}

	?>