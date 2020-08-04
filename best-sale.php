<?php 
require('connect.php');
$q = "SET @top = 2;";
$q .="CALL get_top_km(@top);";
if(mysqli_multi_query($conn,$q))
{
	do
	{
		if($result = mysqli_store_result($conn))
		{
			while ($row = mysqli_fetch_array($result)) 
			{
				
		echo '
		<div class=" col-md-12 col-sm-6 col-xs-6" >
			<div class="offer-text">
                        GIảm giá '.$row['muc_khuyen_mai'].'%
            </div>
            <div class="thumbnail product-box">
            <a href="ct_san_pham.php?Masp='.$row['masp'].'">
	            <img src="assets/img/'.$row[2].'" alt="" /></a>
	            <div class="caption">
	                <h3><a href="ct_san_pham.php?Masp='.$row['masp'].'">'.$row[1].'</a></h3>
	                
	            </div>
            </div>
        </div>';
			}
			mysqli_free_result($result);
		}
	}while (mysqli_next_result($conn));

}

mysqli_close($conn);
?>