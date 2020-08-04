<?php
    require('connect.php');
    $madon = $ngaydathang = $tongtien = $tinhtrang = "";
    if(isset($_GET['madon'])) $madon = $_GET['madon'];
            else $madon = $_POST['madon'];
        if(isset($madon)){
            $sql = 'SELECT * FROM don_hang WHERE madon ="'.$madon.'"';
            $result = mysqli_query($conn, $sql);    
            if(mysqli_num_rows($result) <> 0)
            {
                while($rows= mysqli_fetch_array($result)) {
                    $ngaydathang = $rows['ngaydathang'];
                    $tongtien = $rows['tongtien'];
                    $tinhtrang = $rows['tinhtrang'];
                    $matk = $rows['matk'];
                } 
            } 
       }
        if(isset($_POST['edit'])){
            $ngaydathang = $_POST['ngaydathang'];
            $tongtien = $_POST['tongtien'];
            $tinhtrang = $_POST['tinhtrang'];
            $matk = $_POST['matk'];
            $sql = "UPDATE don_hang SET ngaydathang = '$ngaydathang', tongtien = '$tongtien', tinhtrang = '$tinhtrang', matk = '$matk' WHERE madon = '$madon'";
            mysqli_query($conn, $sql);
            if(mysqli_affected_rows($conn)==1){           
                echo "<script>alert('Cập nhập thành công!');</script>";
                echo "<script>window.location.href = 'donhang.php';</script>";
            } else echo "<script>alert('Không cập nhập được!');</script>";
    }

include 'header.php';
?>

        <hr>
        <div id="page-wrapper">
            <!-- <div class="row">
                 <ul class="nav nav-tabs">
                    <li class="active"><a href="donhang.php">Danh sách đơn hàng</a></li>
                    <li><a href="#">Chi tiết đơn hàng</a></li>
                  </ul>
            </div> -->
            <hr>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"> 
                     <div class="row"> 
                      <div class="col col-xs-12"> 
                       <h3 class="panel-title">Cập nhập đơn hàng</h3> 
                      </div> 
                     </div> 
                    </div> 
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <form action="dh_capnhap.php" method="POST">
                              <div class="form-group row">
                                <label for="input_makh" class="col-sm-2 col-form-label">Mã đơn hàng</label>
                                <div class="col-sm-2">
                                  <input type="text" class="form-control" id="input_makh" name="madon" value="<?php echo $madon; ?>" readonly>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="input_hoten" class="col-sm-2 col-form-label">Ngày đặt hàng</label>
                                <div class="col-sm-2">
                                  <input type="text" class="form-control" id="input_hoten" name="ngaydathang" value="<?php echo $ngaydathang; ?>">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="input_sdt" class="col-sm-2 col-form-label">Tổng tiền</label>
                                <div class="col-sm-2">
                                  <input type="text" class="form-control" id="input_sdt" name="tongtien" value="<?php echo $tongtien; ?>">
                                </div>
                              </div>
                             <div class="form-group row">
                                <label for="input_matk" class="col-sm-2 col-form-label">Tình trạng</label>
                                <div class="col-sm-2">
                                  <select name="tinhtrang" class="form-control">
                                    <option value="0" <?php if(isset($tinhtrang) && $tinhtrang == '0') echo 'selected ="selected"';?> >Chưa giao</option>
                                    <option value="1" <?php if(isset($tinhtrang) && $tinhtrang == '1') echo 'selected ="selected"';?> >Đã giao</option>
                                    </select>
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
                                  <button type="submit" name="edit" class="btn btn-primary">Cập nhập</button>
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
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip(); 
        });
    </script>
</body>

</html>
