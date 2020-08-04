<?php
    require('connect.php');
    $makh = $hoten = $diachi = $sdt = $email = $matk = "";
    if(isset($_GET['makh'])) $makh = $_GET['makh'];
            else $makh = $_POST['makh'];
        if(isset($makh)){
            $sql = 'SELECT * FROM khach_hang WHERE makh ="'.$makh.'"';
            $result = mysqli_query($conn, $sql);    
            if(mysqli_num_rows($result) <> 0)
            {
                while($rows= mysqli_fetch_array($result)) {
                    $makh = $rows['makh'];
                    $hoten = $rows['hoten'];
                    $diachi = $rows['diachi'];
                    $sdt = $rows['dienthoai'];
                    $email = $rows['email'];
                    $matk = $rows['matk'];
                } 
            } 
       }
        if(isset($_POST['edit'])){
            if((!empty($_POST['hoten']))&&(!empty($_POST['diachi']))&&(!empty($_POST['sdt']))&&(!empty($_POST['email']))&&(!empty($_POST['matk']))){
            $hoten = $_POST['hoten'];
            $diachi = $_POST['diachi'];
            $sdt = $_POST['sdt'];
            $email = $_POST['email'];
            $matk = $_POST['matk'];
            $sql = "UPDATE khach_hang SET hoten = '$hoten', diachi = '$diachi', dienthoai = '$sdt', email = '$email', matk = '$matk' WHERE makh = '$makh'";
             mysqli_query($conn, $sql);
            if(mysqli_query($conn, $sql)=== TRUE){
                header("location: khachhang.php");
                echo "<script>alert('Cập nhập thông tin khách hàng thành công!');</script>";
            }
            else echo "<script>alert('Không cập nhập được khách hàng!');</script>";
        }
        else echo "<script>alert('Chưa nhập đủ thông tin khách hàng!!');</script>";
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
                       <h3 class="panel-title">Sửa thông tin khách hàng</h3> 
                      </div> 
                     </div> 
                    </div> 
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                         <form action="kh_sua.php" method="POST">
                              <div class="form-group row">
                                <label for="input_makh" class="col-sm-2 col-form-label">Mã khách hàng</label>
                                <div class="col-sm-2">
                                  <input type="text" class="form-control" id="input_makh" name="makh" value="<?php echo $makh; ?>" readonly > 
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
                                <label for="input_matk" class="col-sm-2 col-form-label">Mã tài khoản</label>
                                <div class="col-sm-2">
                                  <select name="matk" class="form-control"><?php require('connect.php');
                                            $sql = 'SELECT matk
                                                            FROM tai_khoan';
                                            $result = mysqli_query($conn, $sql);
                                            if(mysqli_num_rows($result)<> 0){
                                            while($rows= mysqli_fetch_array($result)){
                                                echo "<option value='{$rows['matk']}'";
                                                if(isset($matk) && $matk == $rows['matk'])
                                                                    echo ' selected ="selected"';
                                                echo ">{$rows['matk']}</option>";
                                            }
                                        }?></select>
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
