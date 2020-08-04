
<?php

require('Connect.php');
session_start();
include 'header.php';
	if(isset($_GET['makh']))
		$makh = $_GET['makh']; 
	else $makh = "KH001";
if(isset($_POST['capnhat']))
{
    $sql ="UPDATE khach_hang SET makh= '$makh'";
    $errors = array(); // Initialize an error array.
    if (file_exists($_FILES['hinh']['tmp_name']) && is_uploaded_file($_FILES['hinh']['tmp_name'])) {
    $target_dir = "assets/img/khach_hang/";
      //lay ten file
    
        $hinh=  basename( $_FILES["hinh"]["name"]) ; 
         $sql .= ",Hinh = '$hinh'";
    
   
    $target_file = $target_dir . basename($_FILES["hinh"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
      $check = getimagesize($_FILES["hinh"]["tmp_name"]);
      if($check !== false) 
      {
          //echo "<p class='text-danger'>File is an image - " . $check["mime"] . ".</p>";
          $uploadOk = 1;
      } 
      else 
      {
          echo "<p class='text-danger'>File is not an image.</p>";
          $uploadOk = 0;
      }
    // Check if file already exists
    if (file_exists($target_file)) {
        echo '<script type="text/javascript">';
echo ' alert("file is already exists")';  //not showing an alert box.
echo '</script>';
        $uploadOk = 0;
    }
    // Check file size <0.5MB
    if ($_FILES["hinh"]["size"] > 500000) {
        echo "<p class='text-danger'>Sorry, your file is too large.</p>";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "<p class='text-danger'>Sorry, only JPG, JPEG, PNG & GIF files are allowed.</p>";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) 
    {
        echo "<p class='text-danger'>Sorry, your file was not uploaded.</p>";
    // if everything is ok, try to upload file
    } 
    else 
    {
        if (move_uploaded_file($_FILES["hinh"]["tmp_name"], $target_file)) 
        {
            echo "<p class='text-danger'>The file ". basename( $_FILES["hinh"]["name"]). " has been uploaded.</p>";
        } 
        else 
        {
            $errors[] = "<p class='text-danger'>Xin lỗi, có lỗi khi upload file.</p>";
        }
    }

   }
   //ghi chu co the null
    if (!empty($_POST['ghichu'])) {
        $ghichu = mysqli_real_escape_string($conn,trim($_POST['ghichu']));
        $sql .= ",ghichu = '$ghichu'";
    }
    if (!empty($_POST['hoten'])) {
        $hoten = mysqli_real_escape_string($conn,trim($_POST['hoten']));
        $sql .= ",hoten = '$hoten'";
    }
            if (!empty($_POST['diachi'])) {
        $diachi = mysqli_real_escape_string($conn,trim($_POST['diachi']));
        $sql .= ",diachi = '$diachi'";
    }
            if (!empty($_POST['dienthoai'])) {
        $dienthoai = mysqli_real_escape_string($conn,trim($_POST['dienthoai']));
        $sql .= ",dienthoai = '$dienthoai'";
    }
            if (!empty($_POST['email'])) {
        $email = mysqli_real_escape_string($conn,trim($_POST['email']));
        $sql .= ",email = '$email'";
    }
            
    if (empty($errors)) {
                $sql .="
                  WHERE makh ='".$makh."'";
                  
                  $re = mysqli_query($conn, $sql);
                  if(mysqli_affected_rows($conn))
                  {
                       echo '<script type="text/javascript">';
echo ' alert("update success!")';  //not showing an alert box.
echo '</script>';
                  }
                  else
                  {
                    echo '<script type="text/javascript">';
echo ' alert("update failed!")';  //not showing an alert box.
echo '</script>';
                  }
            }
            else {
                  echo '<h1>Error!</h1>
                    <p class="error">The following error(s) occurred:<br />';
                    foreach ($errors as $msg) 
                    { // Print each error.
                      echo " - $msg<br />\n";
                    }
                    echo '</p><p>Please try again.</p><p><br /></p>';
                }       
            
        }
	$sql = "SELECT *
	        FROM khach_hang
			WHERE makh ='".$makh."'";

	$result = mysqli_query($conn, $sql);
	if(mysqli_num_rows($result) <> 0){
		while($rows= mysqli_fetch_array($result))
		{
			 
?>
<link rel="stylesheet" type="text/css" href="assets/css/style_chitiet_khachhang.css">
<div class="container emp-profile">
            <form method="post" action="" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img">
                             <img src="assets/img/khach_hang/<?php echo $rows['Hinh']?>" alt="" id="photo_img">
                            <div class="file btn btn-lg btn-primary">
                                Change Photo
                                <input id="input_img" type="file" name="hinh" onchange="readURL(this)" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="profile-head">
                                    <h5> Mã khách hàng :  <?php echo $rows['makh']?></h5>
                                    <h6>
                                        Web Developer and Designer
                                    </h6>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-work">
                            <p>WORK LINK</p>
                            <a href="">Website Link</a><br/>
                            <a href="">Bootsnipp Profile</a><br/>
                            <a href="">Bootply Profile</a>
                            <p>Đơn mua</p>
                            <a href="?makh=<?php echo $makh;?>&da_thanh_toan=1" id ="da_mua">Đã thanh toán</a><br/>
                            <a href="?makh=<?php echo $makh;?>&da_thanh_toan=0" id="chua_mua">chưa thanh toán</a><br/>
                            
                        </div>
                    </div>
                    <div class="col-md-8">
                        <?php if(!isset($_GET['da_thanh_toan'])){ ?>
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Tên khách hàng </label>
                                            </div>
                                            <div class="col-md-6">
                                                <input  name ="hoten" value="<?php echo $rows['hoten']?>" /></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Điện thoại </label>
                                            </div>
                                            <div class="col-md-6">
                                                <input name="dienthoai" value="<?php echo $rows['dienthoai']?>" /></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Địa chỉ</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input name="diachi" value="<?php echo $rows['diachi']?> "/></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Email</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input name="email" value="<?php echo $rows['email']?>" /></p>
                                            </div>
                                        </div>
										 <div class="row">
                                            <div class="col-md-6">
                                                <label>Ghi chú</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input name="ghichu" value="<?php echo $rows['ghichu']?>" /></p>
                                            </div>
                                        </div>
                            </div>
                        </div>
						<div class="form-group">
                           <div class="col-xs-12">
                                <br>
                              	<button class="btn btn-lg btn-success pull-center" type="submit" name="capnhat"><i class="fas fa-check-circle"></i> Cập Nhật</button>
              
                            </div>
                      </div>
                    </div>
                    <?php 
                        }
                        else if($_GET['da_thanh_toan'] == 1)
                        {
                            include 'donhang_dathanhtoan.php';
                        }
                        else
                        {
                            include 'donhang_chothanhtoan.php';
                        }
                    ?>
                </div>
            </form>           
</div>
<script type="text/javascript">
        function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#photo_img')
                    .attr('src', e.target.result)
                    
            };

            reader.readAsDataURL(input.files[0]);
        }
    }


      
    
    </script>

<?php
		}
	}
	
include 'footer.php';

	?>
    
