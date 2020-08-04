<?php
    require('connect.php');
    $tensp = $mota = $soluong = $dongia = $tenloai = $tennsx = "";
    if(isset($_POST['add'])){
        $tensp = $_POST['tensp'];
        $mota = $_POST['mota'];
        $soluong = $_POST['soluong'];
        $dongia = $_POST['dongia'];
        $tenloai = $_POST['tenloai'];
        $tennsx = $_POST['tennsx'];
        if(isset($_FILES['image'])){
            $errors = array();
            $file_tmp = $_FILES['image']['tmp_name'];
            $file_name = $_FILES['image']['name'];
            $file_type = $_FILES['image']['type']; 
            $file_size = $_FILES['image']['size']; 
            if(!($_FILES["image"]["type"]=="image/jpeg"||$_FILES["image"]["type"]=="image/png"||$_FILES["image"]["type"]=="image/gif"))
              {
                 $errors[]="Chỉ hỗ trợ upload file JPEG hoặc PNG.";
              }
              
              if($file_size > 2097152) {
                 $errors[]='Kích thước file không được lớn hơn 2MB';
              }
               
              if(empty($errors)== TRUE) {     
                $sql = "SELECT MaLoai FROM loai_sp WHERE tenloai = '".$tenloai."'";
                    $result = mysqli_query($conn,$sql);
                        while($rows = mysqli_fetch_array($result))
                        {
                            $maloai = $rows['MaLoai'];
                        }
                $sql = "SELECT mansx FROM nha_san_xuat WHERE tennsx = '".$tennsx."'";
                    $result = mysqli_query($conn,$sql);
                        while($rows = mysqli_fetch_array($result))
                        {
                            $mansx = $rows['mansx'];
                        }
                //tao masp tự động
                $q = "select masp from san_pham";
                $r = mysqli_query($conn,$q);
                $mamax = 0;
                while ($row = mysqli_fetch_array($r)) {
                    if(substr($row['masp'],0,2) == substr($maloai, 0,2)){
                  if ($mamax < substr($row['masp'],2)) {
                    $mamax = substr($row['masp'],2);
                  }
              }
            }
                $mamax++;
                $ma_number = '000'.$mamax;
                $masp = substr($maloai, 0,2).substr($ma_number, strlen($mamax)-1);
                //-----------------
                $sql = "INSERT INTO san_pham(Masp,tensp,dongia,soluong,mota,hinh,MaLoai,mansx) VALUES ('$masp','$tensp','$dongia','$soluong','$mota','$file_name', '$maloai', '$mansx')";
                mysqli_query($conn, $sql);
                if (mysqli_affected_rows($conn)==1)
                    {   
                        move_uploaded_file($file_tmp,"Images/".$file_name);
                        echo "<script>alert('Thêm sản phẩm thành công!');</script>";
                        echo "<script>window.location.href = 'sanpham.php';</script>";
                    } 
                    else 
                    {           
                        echo "<script>alert('Mã này đã tồn tại trong database');</script>";

                    }           
            } else{
                 print_r($errors);
              }
            }  echo "<script>alert('Chưa có hình ảnh!');</script>";      
        }
    function option_maloai(){
        require('connect.php');
        $sql = 'SELECT tenloai
                        FROM loai_sp';
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result)<> 0){
        while($rows= mysqli_fetch_array($result)){
            echo "<option value='{$rows['tenloai']}'";
            if(isset($_POST['tenloai']) && $_POST['tenloai'] == $rows['tenloai'])
                                echo ' selected ="selected"';
            echo ">{$rows['tenloai']}</option>";
        }
    }
}
         function option_nsx(){
                require('connect.php');
                $sql = 'SELECT tennsx
                                FROM nha_san_xuat';
                $result = mysqli_query($conn, $sql);
                if(mysqli_num_rows($result)<> 0){
                while($rows= mysqli_fetch_array($result)){
                    echo "<option value='{$rows['tennsx']}'";
                    if(isset($_POST['tenloai']) && $_POST['tennsx'] == $rows['tennsx'])
                                        echo ' selected ="selected"';
                    echo ">{$rows['tennsx']}</option>";
                }
            }
        }
include 'header.php';
?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Sản Phẩm</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"> 
                     <div class="row"> 
                      <div class="col col-xs-6"> 
                       <h3 class="panel-title">Thêm mới sản phẩm</h3> 
                      </div> 
                     </div> 
                    </div> 
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                         <form action="sp_them.php" method="POST" enctype="multipart/form-data">
                              <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="input_msp">Mã sản phẩm</label>
                                <div class="col-sm-2">
                                  <input type="text" class="form-control" id="input_msp" name="masp" disabled>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="input_tensp">Tên sản phẩm</label>
                                <div class="col-sm-4">
                                  <input type="text" class="form-control" id="input_tensp" name="tensp" value="<?php echo $tensp; ?>">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="input_dongia">Đơn giá</label>
                                <div class="col-sm-2">
                                  <input type="number" min="0" class="form-control" id="input_dongia" name="dongia" value="<?php echo $dongia; ?>">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="input_soluong">Số lượng</label>
                                <div class="col-sm-2">
                                  <input type="number" min="0" class="form-control" id="input_soluong" name="soluong" value="<?php echo $soluong; ?>">
                                </div>
                              </div>
                               <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="input_mota">Mô tả</label>
                                <div class="col-sm-6">
                                     <textarea class="form-control" id="input_mota" rows="3" name="mota" ><?php echo $mota; ?></textarea>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="input_hinh" class="col-sm-2 col-form-label">Hình</label>
                                <div class="col-sm-6">
                                  <input type="file" class="form-control" id="input_hinh" name="image" required>
                                </div>
                              </div>
                               <div class="form-group row">
                                <label for="input_tenloai" class="col-sm-2 col-form-label">Tên loại</label>
                                <div class="col-sm-3">
                                  <select class="form-control" id="input_tenloai" name="tenloai">
                                    <?php option_maloai();?>
                                    </select>
                                </div>
                              </div>
                               <div class="form-group row">
                                <label for="input_tennsx" class="col-sm-2 col-form-label">Tên nhà sản xuất</label>
                                <div class="col-sm-3">
                                  <select class="form-control" id="input_tennsx" name="tennsx">
                                    <?php option_nsx();?>
                                    </select>
                                </div>
                              </div>
                              <div class="form-group row">
                                <div class="col-sm-10">
                                  <button type="submit" name="add" class="btn btn-primary">Thêm</button>
                                </div>
                              </div>
                            </form>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Core Scripts - Include with every page -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- Page-Level Plugin Scripts - Tables -->
    <script src="js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>

    <!-- SB Admin Scripts - Include with every page -->
    <script src="js/sb-admin.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').dataTable();
    });
    </script>

</body>

</html>
