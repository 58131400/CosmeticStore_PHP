<?php 
require('connect.php');
$array = array("MP%","NH%","TP%");
for($i =0; $i<3; $i++)
{
    $q = "select  * from loai_sp where maloai like '$array[$i]'";
    
    $r = mysqli_query($conn,$q);
     echo '<div>
                <div class="list-group-item active loaisp" id="'.$array[$i].'">';
                 if ($array[$i] == "MP%") {
                        echo 'Mỹ phẩm';
                    }   
                    else if ($array[$i] =="TP%") {
                        echo 'Thực phẩm chức năng';
                    }
                    else echo 'Nước hoa';
    echo'</div>
                <ul class="list-group">';
    if(mysqli_num_rows($r) != 0)
    {
        while ($row = mysqli_fetch_array($r)) 
        {
            echo'
            <li class="list-group-item" id="'.$row[0].'">'.$row[1].'
            <span class="label label-primary pull-right">';

            $q1="select count(*) from san_pham where maloai = '$row[0]'";
            $r1= mysqli_query($conn,$q1); 
            while ($row1=mysqli_fetch_array($r1)) {
                 echo $row1[0];
             } 
            echo'</span>
            </li>';
        }
    }
    else echo '<li>Không có dữ liệu</li>';
    echo '</ul></div>';
}
                      
               
               
           echo'   <div>
               <ul class="list-group">
                        <li class="list-group-item list-group-item-success"><a href="#">New Offer Coming </a></li>
                        <li class="list-group-item list-group-item-info"><a href="#">New Products Added</a></li>
                        <li class="list-group-item list-group-item-warning"><a href="#">Ending Soon Offers</a></li>
                        <li class="list-group-item list-group-item-danger"><a href="#">Just Ended Offers</a></li>
                    </ul>
                </div>';
               
             echo' <div class="well well-lg offer-box offer-colors">


                     <span class="glyphicon glyphicon-star-empty"></span>25 % off  , GRAB IT                 
              
                   <br />
                    <br />
                    <div class="progress progress-striped">
                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"
                            style="width: 70%">
                            <span class="sr-only">70% Complete (success)</span>
                            2hr 35 mins left
                        </div>
                    </div>
                    <a href="#">click here to know more </a>
                </div>
                <!-- /.div -->
            </div>
            <!-- /.col -->';
        
            ?>
