<?php 
include 'header.php';

if (!isset($_POST['keysearch'])) {
	$_POST['keysearch'] ='';
}
$key_search   = $_POST['keysearch'];
?>
<link href="assets/css/style.css" rel="stylesheet" />
<div class="container" style="min-height: 500px;">
	<div class ="search-content">
	<h1 class="text-center">Kết quả tìm kiếm</h1>
	<hr>
	<div class="row search_result" id="<?php echo $key_search;?>">
	<?php include 'timkiem_result.php';?>
	</div>
	
	<!--end row -->	
	</div>
</div>
<!--end container -->

<?php
include 'footer.php';
?>
<script type="text/javascript">
	$(function () {
		var key_search = $(".search_result").attr("id");
		function load_tim_kiem(page,keysearch)
		{
			$.ajax({
				url: "timkiem_result.php",
				data:{page:page,keysearch:keysearch},
				method:'post',
				success: function(data)
				{
					$(".search_result").html(data);
				}
			})
		}
		load_tim_kiem(1,key_search);
		$(document).on('click','#pagination li',function(){
			var page = $(this).attr("id");
			
			console.log("page là: " + page );
			console.log("key là: " + key_search );
			load_tim_kiem(page,key_search);
		})
	})
</script>

