<?php
    function khachhang(){
    require('connect.php');
    $sql = 'SELECT * FROM khach_hang';
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)<>0){
        $dem = 1;
        while ($rows = mysqli_fetch_array($result)) {
            echo '<tr class="odd gradeX">';
            echo "<td> {$dem} </td>";
            echo "<td>{$rows['makh']}</td>";
            echo "<td>{$rows['hoten']}</td>";
            echo "<td>{$rows['dienthoai']}</td>";
            echo "<td>{$rows['diachi']}</td>";
            echo "<td>{$rows['email']}</td>";
            echo "<td>{$rows['matk']}</td>";
            echo "<td><span><a href='kh_sua.php?makh=".$rows['makh']."' class='btn btn-default' data-toggle='tooltip' title='Sửa'><i class='fa fa-pencil-square-o'></i></a></span>
                    <span><a href='kh_xoa.php?makh=".$rows['makh']."' class='btn btn-danger' data-toggle='tooltip' title='Xoá'><i class='fa fa-trash-o' ></i></a></span></td>";
            echo "</tr>";                             
            $dem+=1;                              
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
                       <h3 class="panel-title">Danh sách khách hàng</h3> 
                      </div> 
                      <div class="col col-xs-6 text-right"> 
                       <a href="kh_them.php"><button type="button"  class="btn btn-sm btn-primary btn-create"><i class="fa fa-plus"></i> Thêm mới khách hàng</button> </a>
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
                                            <th>Mã KH</th>
                                            <th>Họ tên</th>
                                            <th>SDT</th>
                                            <th>Địa chỉ</th>
                                            <th>Email</th>
                                            <th>Mã TK</th>
                                            <th><em class="fa fa-cog"></em></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php khachhang();?>
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
