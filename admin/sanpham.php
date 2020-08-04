<?php
    function sanpham(){
    require('connect.php');
    $sql = 'SELECT Masp, tensp, dongia, soluong, mota, hinh,tenloai, tennsx 
                FROM san_pham JOIN loai_sp ON san_pham.maloai = loai_sp.maloai 
                              JOIN nha_san_xuat ON san_pham.mansx = nha_san_xuat.mansx';
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)<>0){
        $dem = 1;
        while ($rows = mysqli_fetch_array($result)) {
            echo '<tr class="odd gradeX">';
            echo "<td> {$dem} </td>";
            echo "<td>{$rows['Masp']}</td>";
            echo "<td>{$rows['tensp']}</td>";
            echo "<td>{$rows['dongia']}</td>";
            echo "<td>{$rows['soluong']}</td>";
            echo "<td>{$rows['mota']}</td>";
            echo "<td><img src='Images/{$rows['hinh']}' width='100' height = '100'</td>";
            echo "<td>{$rows['tenloai']}</td>";
            echo "<td>{$rows['tennsx']}</td>";
            echo "<td><span><a href='sp_sua.php?masp=".$rows['Masp']."' class='btn btn-default' data-toggle='tooltip' title='Sửa'><i class='fa fa-pencil-square-o'></i></a></span>
                    <span><a href='sp_xoa.php?masp=".$rows['Masp']."' class='btn btn-danger' data-toggle='tooltip' title='Xoá'><i class='fa fa-trash-o' ></i></a></span></td>";
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
                       <h3 class="panel-title">Danh sách sản phẩm</h3> 
                      </div> 
                      <div class="col col-xs-6 text-right"> 
                       <a href="sp_them.php"><button type="button"  class="btn btn-sm btn-primary btn-create"><i class="fa fa-plus"></i> Thêm sản phẩm</button> </a>
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
                                            <th>Mã SP</th>
                                            <th>Tên SP</th>
                                            <th>Đơn giá</th>
                                            <th>Số lượng</th>
                                            <th>Mô tả</th>
                                            <th>Hình</th>
                                            <th>Tên loại</th>
                                            <th>Tên nsx</th>
                                            <th><em class="fa fa-cog"></em></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php sanpham();?>
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

</body>

</html>
