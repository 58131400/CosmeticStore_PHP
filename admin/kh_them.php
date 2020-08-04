<?php
    require('connect.php');
    $hoten = $diachi = $sdt = $email = "";
    if(isset($_POST['add'])){
        if((!empty($_POST['hoten']))&&(!empty($_POST['diachi']))&&(!empty($_POST['sdt']))&&(!empty($_POST['email']))){
        $q = "select makh from khach_hang";
        $r = mysqli_query($conn,$q);
        $mamax = 0;
        while ($row = mysqli_fetch_array($r)) {
          if ($mamax < substr($row['makh'],2)) {
            $mamax = substr($row['makh'],2);
          }
        }
        $mamax++;
        $ma_number = '00'.$mamax;
        $makh = "KH".substr($ma_number, strlen($mamax)-1);
        $hoten = $_POST['hoten'];
        $diachi = $_POST['diachi'];
        $sdt = $_POST['sdt'];
        $email = $_POST['email'];
        $sql = "INSERT INTO khach_hang(makh, hoten, dienthoai, diachi, email, ghichu) VALUES ('$makh','$hoten','$sdt','$diachi','$email', '')";
        mysqli_query($conn, $sql);
       if(mysqli_affected_rows($conn)==1){           
                echo "<script>alert('Thêm khách hàng thành công!');</script>";
                echo "<script>window.location.href = 'khachhang.php';</script>";
  }  else echo "<script>alert('Nhập đủ thông tin khách hàng!!');</script>";
}
}
    function option_matk(){
        require('connect.php');
        $sql = 'SELECT matk
                        FROM tai_khoan';
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result)<> 0){
        while($rows= mysqli_fetch_array($result)){
            echo "<option value='{$rows['matk']}'";
            if(isset($_GET['matk']) && $_GET['matk'] == $rows['matk'])
                                echo ' selected ="selected"';
            echo ">{$rows['matk']}</option>";
        }
    }
    }
include 'header.php';
?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Khách Hàng</h1>
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
                       <h3 class="panel-title">Thêm mới khách hàng</h3> 
                      </div> 
                     </div> 
                    </div> 
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                         <form action="kh_them.php" method="POST">
                              <div class="form-group row">
                                <label for="input_makh" class="col-sm-2 col-form-label">Mã khách hàng</label>
                                <div class="col-sm-2">
                                  <input type="text" class="form-control" id="input_makh" name="makh" disabled> 
                                </div>
                              </div>

                              <div class="form-group row">
                                <label for="input_hoten" class="col-sm-2 col-form-label">Họ tên</label>
                                <div class="col-sm-4">
                                  <input type="text" class="form-control" id="input_hoten" name="hoten" value="<?php echo $hoten; ?>">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="input_sdt" class="col-sm-2 col-form-label">Số điện thoại</label>
                                <div class="col-sm-4">
                                  <input type="text" class="form-control" id="input_sdt" name="sdt" value="<?php echo $sdt; ?>">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="input_diachi" class="col-sm-2 col-form-label">Địa chỉ</label>
                                <div class="col-sm-6">
                                  <input type="text" class="form-control" id="input_diachi" name="diachi" value="<?php echo $diachi; ?>">
                                </div>
                              </div>
                               <div class="form-group row">
                                <label for="input_email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-6">
                                  <input type="text" class="form-control" id="input_email" name="email" value="<?php echo $email; ?>">
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
