<?php 

require('connect.php');
$array = array("MP%","TP%","NH%");
for ($i=0; $i < 3; $i++) { 


$q = "SET @loaisp = '$array[$i]';";
$q .="SET @top = '4';";
$q .="CALL get_top_mua(@loaisp,@top);";


echo "<ul>";
if(mysqli_multi_query($conn,$q))
{
	do
	{
		if($result = mysqli_store_result($conn))
		{
			while ($row = mysqli_fetch_array($result)) 
			{
				
				echo '<li><a href="#">
		                                <a href="ct_san_pham.php?Masp='.$row[0].'"><img src="assets/img/'.$row[3].'" alt="'.$row[3].'"><h4>'.$row[2].'</h4></a>
		                            </a></li>
		                           ';
			}
			mysqli_free_result($result);
		}
	}
	while (mysqli_next_result($conn));
}
echo"</ul>";
}
mysqli_close($conn);
?>