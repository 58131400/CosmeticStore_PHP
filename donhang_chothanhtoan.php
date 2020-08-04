<?php
require 'connect.php'; 

$q = "select matk from tai_khoan where ID = '".$_SESSION['username']."'";
$r = mysqli_query($conn,$q);
while ($row = mysqli_fetch_array($r)) {
	$matk = $row['matk'];
}
$q = "select * from don_hang join chi_tiet_don_hang on don_hang.madon = chi_tiet_don_hang.madon join san_pham on chi_tiet_don_hang.masp = san_pham.Masp where matk = '".$matk."' and tinhtrang = 0";
$r = mysqli_query($conn,$q);
while ($row = mysqli_fetch_array($r)) {
	echo '
		<div>
			<div>
			<img width ="100px" height="100px" src = "assets/img/'.$row['hinh'].'">
			</div>
			<div>
				<div>Mã sản phẩm:'.$row['Masp'].'</div>
				<div>Sản phẩm:'.$row['tensp'].'</div>
				<div>Mã đơn: '.$row['madon'].'</div>
				<div>số lượng: '.$row[8].'</div>
				<div>Đơn giá: '.$row[9].'</div>
			</div>
		</div>
		<hr>
	';
}
?>