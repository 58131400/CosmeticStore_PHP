<?php session_start(); 
 
if (isset($_SESSION['username'])){
    unset($_SESSION['username']); // xóa session login
}
if (isset($_SESSION['cart'])){
    unset($_SESSION['cart']); // xóa session login
}
?>
<a href="index.php">Trang chủ</a>
<a href="dangnhap.php">Trang login</a>