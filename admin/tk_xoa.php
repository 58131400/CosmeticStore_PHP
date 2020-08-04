<?php
    require('connect.php');
    $matk = $ID = $pass = $quyen = "";
    if(isset($_GET['matk'])) $matk = $_GET['matk'];
            else $matk = $_POST['matk'];
        if(isset($matk)){
            $sql = 'SELECT * FROM tai_khoan WHERE matk ="'.$matk.'"';
            $result = mysqli_query($conn, $sql);    
            if(mysqli_num_rows($result) <> 0)
            {
                while($rows= mysqli_fetch_array($result)) {
                    $ID = $rows['ID'];
                    $pass = $rows['pass'];
                    $quyen = $rows['role'];
                } 
            } 
       }
        if(isset($_POST['del'])){
            if((!empty($_POST['ID']))&&(!empty($_POST['pass']))){
            $sql = 'DELETE FROM tai_khoan WHERE matk = "'.$_POST['matk'].'"';
             mysqli_query($conn, $sql);
            if(mysqli_affected_rows($conn)==1){           
                echo "<script>alert('Xoá tài khoản thành công!');</script>";
                echo "<script>window.location.href = 'dstaikhoan.php';</script>";
             }   else echo "<script>alert('Không được xoá tài khoản này!');</script>";
        }
        else echo "<script>alert('Hãy nhập đủ thông tin!!');</script>";
    }
include 'header.php';
?>

        <div id="page-wrapper">
             <div class="row">
                 <ul class="nav nav-tabs">
                    <li><a href="taikhoan.php">Cấp quyền</a></li>
                    <li class="active"><a href="dstaikhoan.php">Tài khoản</a></li>
                  </ul>
            </div>
            <hr>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                    <div class="panel-heading"> 
                     <div class="row"> 
                      <div class="col col-xs-6"> 
                       <h3 class="panel-title">Xoá tài khoản</h3> 
                      </div> 
                     </div> 
                    </div> 
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                         <form action="tk_xoa.php" method="POST">
                              <div class="form-group row">
                                <label for="input_makh" class="col-sm-2 col-form-label">Mã tài khoản</label>
                                <div class="col-sm-2">
                                  <input type="text" class="form-control" id="input_makh" name="matk" value="<?php echo $matk; ?>" readonly> 
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="input_hoten" class="col-sm-2 col-form-label">ID</label>
                                <div class="col-sm-4">
                                  <input type="text" class="form-control" id="input_hoten" name="ID" value="<?php echo $ID; ?>" readonly>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="input_sdt" class="col-sm-2 col-form-label">Pass</label>
                                <div class="col-sm-4">
                                  <input type="text" class="form-control" id="input_sdt" name="pass" value="<?php echo $pass; ?>" readonly>
                                </div>
                              </div>
                             <div class="form-group row">
                                <label for="input_matk" class="col-sm-2 col-form-label">Quyền</label>
                                <div class="col-sm-2">
                                  <select name="quyen" class="form-control" disabled>
                                    <option value="0" <?php if(isset($quyen) && $quyen == '0') echo 'selected ="selected"';?> >0</option>
                                    <option value="1" <?php if(isset($quyen) && $quyen == '1') echo 'selected ="selected"';?> >1</option>
                                    </select>
                                </div>
                              </div>
                              <div class="form-group row">
                                <div class="col-sm-10">
                                  <button type="submit" name="del" class="btn btn-danger">Xoá</button>
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
