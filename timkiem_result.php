<?php
require 'connect.php';
if(!isset($_POST['page'])) $_POST['page'] = 1;
if(!isset($_POST['keysearch'])) $_POST['keysearch'] = '';
else $key_search = $_POST['keysearch'];
$row_per_page = 6;
$current_page = $_POST['page'];

$offset = ($current_page -1)*$row_per_page;

	
	$q = "select * from san_pham where tensp like '%$key_search%' LIMIT $offset, $row_per_page" ;
	$r = mysqli_query($conn,$q);

	if(mysqli_num_rows($r) != 0)
	{
		while ($row = mysqli_fetch_array($r)) {
			 echo '  <div class="col-md-4 text-center col-sm-6 col-xs-6 ">
                            <div class="thumbnail product-box">
                                <img src="assets/img/'.$row['hinh'].'" alt="" />
                                <div class="caption">
                                    <div class="name-product"><h3><a href="#">'.$row['tensp'].'</a></h3></div>
                                    <p>Price : <strong>'.number_format($row['dongia'],0,",",".").' VNĐ</strong>  </p>
                                    
                                    <p><a href="cart.php?action=add&id='.$row['Masp'].'" class="btn btn-success" role="button">Add To Cart</a> <a href="ct_san_pham.php?Masp='.$row['Masp'].'" class="btn btn-primary" role="button">See Details</a></p>
                                </div>
                            </div>
                        </div>
                        ';
		}
	$q = "select * from san_pham where tensp like '%$key_search%'";
	$r = mysqli_query($conn,$q);
	$total_records =  mysqli_num_rows($r);

	$total_pages = ceil($total_records /$row_per_page);
	
	include 'pagination.php';

	}
	else
	{
		echo "Rất tiếc! Không tìm thấy sản phẩm bạn cần";

	}

?>
