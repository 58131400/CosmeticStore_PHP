<?php
    require('connect.php');
    $masp = $tensp = $mota = $soluong = $dongia = $tenloai = $tennsx = "";
    if(isset($_GET['masp'])) $masp = $_GET['masp']; else $masp = $_POST['masp'];
        if(isset($masp)){
            $sql = 'SELECT * FROM san_pham 
                             JOIN loai_sp ON san_pham.maloai = loai_sp.maloai
                             JOIN nha_san_xuat ON san_pham.mansx = nha_san_xuat.mansx
                        WHERE masp ="'.$masp.'"';
            $result = mysqli_query($conn, $sql);    
            if(mysqli_num_rows($result) <> 0)
            {
                while($rows= mysqli_fetch_array($result)) {
                    $tensp = $rows['tensp'];
                    $mota = $rows['mota'];
                    $dongia = $rows['dongia'];
                    $soluong = $rows['soluong'];
                    $tenloai = $rows['tenloai'];
                    $tennsx = $rows['tennsx'];
                    } 
            } 
            }

       if(isset($_POST['edit'])){
            $tensp = $_POST['tensp'];
            $mota = $_POST['mota'];
            $dongia = $_POST['dongia'];
            $soluong = $_POST['soluong'];
            $tennsx = $_POST['tennsx'];
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
            $sql = "UPDATE san_pham SET tensp = '$tensp', mota = '$mota', dongia = '$dongia', maloai ='$maloai', mansx = '$mansx', hinh = '$file_name' WHERE masp = '$masp'";
            
            $r= mysqli_query($conn, $sql);
            if(mysqli_affected_rows($conn)==1){           
                echo "<script>alert('Sửa sản phẩm thành công!');</script>";
                echo "<script>window.location.href = 'sanpham.php';</script>";
                 
            }
            else echo "<p>Không sửa được!".mysqli_error($conn)."</p>";
        }
    }
}
 
    function option_maloai(){
        require('connect.php');
        $sql = 'SELECT tenloai
                        FROM loai_sp';
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result)<> 0){
        while($rows= mysqli_fetch_array($result)){
            echo "<option value='{$rows['tenloai']}'";
            if(isset($tenloai) && ($tenloai == $rows['tenloai']))
                                echo ' selected ="selected" ';
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
                    if(isset($tennsx) && ($tennsx == $rows['tennsx']))
                                        echo 'selected ="selected"';
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
                       <h3 class="panel-title">Sửa thông tin sản phẩm</h3> 
                      </div> 
                     </div> 
                    </div> 
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                         <form action="sp_sua.php" method="POST" enctype="multipart/form-data">
                              <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="input_msp">Mã sản phẩm</label>
                                <div class="col-sm-2">
                                  <input type="text" class="form-control" id="input_msp" name="masp" value="<?php echo $masp; ?>" readonly> 
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
                                    <?php require('connect.php');
                                        $sql = 'SELECT tenloai  FROM loai_sp';
                                        $result = mysqli_query($conn, $sql);
                                        if(mysqli_num_rows($result)<> 0){
                                        while($rows= mysqli_fetch_array($result)){
                                            echo "<option value='{$rows['tenloai']}'";
                                            if(isset($tenloai) && ($tenloai == $rows['tenloai']))
                                                                echo ' selected ="selected" ';
                                            echo ">{$rows['tenloai']}</option>";
                                        }
                                    }
                                ?>
                                 </select>
                                </div>
                              </div>
                               <div class="form-group row">
                                <label for="input_tennsx" class="col-sm-2 col-form-label">Tên nhà sản xuất</label>
                                <div class="col-sm-3">
                                  <select class="form-control" id="input_tennsx" name="tennsx">
                                    <?php require('connect.php');
                                            $sql = 'SELECT tennsx
                                                            FROM nha_san_xuat';
                                            $result = mysqli_query($conn, $sql);
                                            if(mysqli_num_rows($result)<> 0){
                                            while($rows= mysqli_fetch_array($result)){
                                                echo "<option value='{$rows['tennsx']}'";
                                                if(isset($tennsx) && ($tennsx == $rows['tennsx']))
                                                                    echo 'selected ="selected"';
                                                echo ">{$rows['tennsx']}</option>";
                                            }
                                        }?>
                                    </select>
                                </div>
                              </div>
                              <div class="form-group row">
                                <div class="col-sm-10">
                                  <button type="submit" name="edit" class="btn btn-primary">Sửa</button>
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
