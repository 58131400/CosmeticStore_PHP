<?php
require 'connect.php' ;
if(isset($_POST['id']))
{

    $id = $_POST['id'];

    $item_per_page = 6;
   $current_page = $_POST['page'];
   $offset = ($current_page - 1)* $item_per_page;
   $total_records = mysqli_query($conn,"select * from san_pham where maloai like '$id%'"  );
   
   $total_records = $total_records->num_rows;
   $total_pages = ceil($total_records/ $item_per_page);
   
$product = mysqli_query($conn,"select * from san_pham where maloai like '$id%' order by dongia ".$_POST['sort']." limit $offset, $item_per_page " );


echo '<div>
                    <ol class="breadcrumb" id="breadcrumb">
                        <li><a href="index.php">Trang chủ</a></li>
                        <li class="active" id = "'.$id.'">'; 
                        if(strlen($id) == 3)
                        {
                            if($id=="MP%") echo "Mỹ phẩm";
                            if($id=="NH%") echo "Nước hoa";
                            if($id=="TP%") echo "Thực phẩm";
                        }
                        else
                        {
                            $tenloai = mysqli_query($conn,"select * from loai_sp");
                            while ($row1 = mysqli_fetch_array($tenloai)) 
                            {
                                if ($row1[0] == $id) {
                                    echo $row1[1];
                                }
                                
                            }
                        }
                         echo'</li>
                    </ol>
                </div>
                <!-- /.div -->
                <div class="row">
                    <div class="btn-group alg-right-pad">
                        <button type="button" class="btn btn-default"><strong>'.$total_records.'  </strong>items</button>
                        <div class="btn-group">
                            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
                                Sắp xếp &nbsp;
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right" id ="sort">
                                <li class="text-center" id="asc">Giá tăng</li>
                                <li class="divider"></li>
                                <li class="text-center" id="desc">Giá giảm</li>
                                <li class="divider"></li>
                                
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
              
                
                <div class="row">';

                  while ($row= mysqli_fetch_array($product)) 
                        {
                          
                        echo '  <div class="col-md-4 text-center col-sm-6 col-xs-6">
                            <div class="thumbnail product-box">
                                <img src="assets/img/'.$row['hinh'].'" alt="" />
                                <div class="caption">
                                    <div class="name-product"><h3><a href="#">'.$row['tensp'].'</a></h3></div>
                                    <p>Price : <strong>'.number_format($row['dongia'],0,",",".").' VNĐ</strong>  </p>
                                    
                                    <p><a href="cart.php?action=add&id='.$row['Masp'].'" class="btn btn-success" role="button">Thêm vào giỏ</a> <a href="ct_san_pham.php?Masp='.$row['Masp'].'" class="btn btn-primary" role="button">Chi tiết</a></p>
                                </div>
                            </div>
                        </div>
                        ';
                        
                    }
                    echo "</div";
                    
      include 'pagination.php';

}
?>