<?php
    function donhang(){
    require('connect.php');
    $sql = 'SELECT * FROM don_hang';
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)<>0){
        $dem = 1;
        while ($rows = mysqli_fetch_array($result)) {
            echo '<tr class="odd gradeX">';
            echo "<td> {$dem} </td>";
            echo "<td>{$rows['madon']}</td>";
            echo "<td>{$rows['ngaydathang']}</td>";
            echo "<td>{$rows['tongtien']}</td>";
            if($rows['tinhtrang']== 0) echo "<td>Chưa giao</td>"; else echo "<td>Đã giao</td>";
            echo "<td>{$rows['matk']}</td>";
            echo "<td><span><a href='dh_capnhap.php?madon=".$rows['madon']."' class='btn btn-primary' data-toggle='tooltip' title='cập nhập'><i class='fa fa-pencil-square-o'></i></a></span>
                </td>";
            echo "</tr>";                             
            $dem+=1;                              
        }
    }
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
                       <h3 class="panel-title">Danh sách đơn hàng</h3> 
                      </div> 
                     </div> 
                    </div> 
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Mã đơn</th>
                                            <th>Ngày đặt hàng</th>
                                            <th>Tổng tiền</th>
                                            <th>Tình trạng</th>
                                            <th>Mã TK</th>
                                            <th><em class="fa fa-cog"></em></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php donhang(); ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
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
