<?php 

require 'connect.php';

session_start();
 if(isset($_GET['action']) && $_GET['action']=="add"){ 
          
        $id=$_GET['id']; 
        if (isset($_GET['quantity'])) {
        	$soluong = $_GET['quantity'];
        }else $soluong=1;
         
        if(isset($_SESSION['cart'][$id])){ 
              
            $_SESSION['cart'][$id]['quantity']+= $soluong; 
              
        }else{ 
              
            $sql_s="SELECT * FROM san_pham 
                WHERE Masp='{$id}'"; 
              //echo $sql_s;
            $query_s=mysqli_query($conn,$sql_s); 
            if(mysqli_num_rows($query_s)!=0){ 
                $row_s=mysqli_fetch_array($query_s); 
                  
                $_SESSION['cart'][$row_s['Masp']]=array( 
                        "quantity" => $soluong, 
                        "dongia" => $row_s['dongia'] 
                    ); 
                  
                  
            }else{ 
                  
                $message="This product id it's invalid!"; 
                  
            } 
              
        } 
          
    } 
if(isset($_POST['submit'])){ 
  
foreach($_POST['quantity'] as $key => $val) { 
    if($val==0) { 
        unset($_SESSION['cart'][$key]); 
    }else{ 
        $_SESSION['cart'][$key]['quantity']=$val; 
    } 
} 
  


}
include 'header.php';
echo '<div class = "container" id ="cart">';
?>

<h1 align="center">Your cart <i class="fas fa-shopping-cart"></i></h1> 
<hr>
<?php 

if(isset($message)){ 
            echo "<h2>$message</h2>"; 
        } ?>
<a href="javascript: history.go(-1)">Go back</a> 
<?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) != 0) 
{
	?>
<form method="post" action="cart.php"> 
      
    <table width="100%" border="1" style="border-collapse: collapse;text-align: center;"> 
          
        <tr> 
            <th style="text-align: center;">Name</th> 
            <th style="width: 180px;text-align: center;">Quantity</th> 
            <th style="text-align: center;">Price</th> 
            <th style="text-align: center;">Items Price</th> 
        </tr> 
          
        <?php 
          
          	//var_dump( $_SESSION['cart']);
         
            $sql="SELECT * FROM san_pham WHERE Masp IN ("; 
                      
                    foreach($_SESSION['cart'] as $id => $value) { 
                        $sql.="'".$id."',"; 

                    } 
                     
                    $sql=substr($sql, 0, -1).") ORDER BY tensp ASC"; 
                    
                    $query=mysqli_query($conn,$sql); 
                    
                    $totalprice=0; 
                    if(mysqli_num_rows($query) != 0)
                    while($row=mysqli_fetch_array($query)){ 
                        $subtotal=$_SESSION['cart'][$row['Masp']]['quantity']*$row['dongia']; 
                        $totalprice+=$subtotal; 
                    ?> 
                        <tr> 
                            <td><?php echo $row['tensp'] ?></td> 
                            <td><input type="number" name="quantity[<?php echo $row['Masp'] ?>]" size="5" value="<?php echo $_SESSION['cart'][$row['Masp']]['quantity'] ?>" /></td> 
                            <td><?php echo $row['dongia'] ?>$</td> 
                            <td><?php echo $_SESSION['cart'][$row['Masp']]['quantity']*$row['dongia'] ?> VNĐ</td> 
                        </tr> 
                    <?php 
                          
                    } 

        ?> 
                    <tr> 
                    	<td></td>
                    	<td></td>
                    	<td></td>
                        <td colspan="4">Total Price: <?php echo $totalprice; ?> VNĐ</td> 
                    </tr> 
          
    </table> 
    <br /> 
    <button style="float:right;" type="submit" name="muahang" class="text-right">mua hàng</button>
    <button style="float:right;" type="submit" name="submit" class="text-right">Update Cart</button> 
</form> 
<br /> 
<p>To remove an item, set it's quantity to 0. </p>
<?php

} 
else echo "<p>Your Cart is empty. Please add some products.</p>"; 
echo "</div>";

if (isset($_POST['muahang'])) {
	
	   $q = "select madon from don_hang";
    $r = mysqli_query($conn,$q);
    $mamax = 0;
    while ($row = mysqli_fetch_array($r)) {
      
      if ($mamax < intval(substr($row['madon'],3))) {
        $mamax = intval(substr($row['madon'],3));

      }
    }
    $mamax++;
    
    $ma_number = '00'.$mamax;
    
    $madon = "MD".substr($ma_number, strlen($mamax)-1);
    echo "ma don la" .$madon;
    //lay ma tk tu session
    $q = "select matk from tai_khoan where ID ='".$_SESSION['username']."' ";
    $r = mysqli_query($conn,$q);
    while ($row = mysqli_fetch_array($r)) {
    	$matk = $row['matk'];
    }
    echo $matk;
	$q = "insert into don_hang (madon,ngaydathang,tongtien,tinhtrang,matk) values('$madon','".date('Y-m-d')."',$totalprice,0,'$matk');";
	$q.="insert into chi_tiet_don_hang(madon,masp,soluong,dongia) values";
	$sql ="SELECT * FROM san_pham WHERE Masp IN ("; 
                      
                    foreach($_SESSION['cart'] as $id => $value) { 
                        $sql.="'".$id."',"; 

                    } 

                    $sql=substr($sql, 0, -1).") ORDER BY tensp ASC"; 
                    
                    $query=mysqli_query($conn,$sql); 
                    
                    $totalprice=0; 
                    if(mysqli_num_rows($query) != 0)
                    while($row=mysqli_fetch_array($query))
                    { 
                        $subtotal=$_SESSION['cart'][$row['Masp']]['quantity']*$row['dongia']; 
                        $totalprice+=$subtotal; 
	$q.= "('$madon','".$row['Masp']."',".$_SESSION['cart'][$row['Masp']]['quantity'].",".$row['dongia']."),";
					}
					$q = substr($q, 0,-1);
	if(mysqli_multi_query($conn,$q))
{
	unset($_SESSION['cart']);
	 echo ("<script LANGUAGE='JavaScript'>
    window.alert('Mua hàng thành công');
     window.location.href='index.php';
    </script>");
}
					}
					
	

?>

<?php include'footer.php'?>