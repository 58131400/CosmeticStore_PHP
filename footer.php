<div class="col-md-12 footer-box">


        
        <div class="row">
            <div class="col-md-4">
                <strong>Send a Quick Query </strong>
                <hr>
                <form>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <input type="text" class="form-control" required="required" placeholder="Name">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <input type="text" class="form-control" required="required" placeholder="Email address">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <textarea name="message" id="message" required="required" class="form-control" rows="3" placeholder="Message"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit Request</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-md-4">
                <strong>Our Location</strong>
                <hr>
                <p>
                     234, New york Street,<br />
                                    Just Location, USA<br />
                    Call: +09-456-567-890<br>
                    Email: info@yourdomain.com<br>
                </p>

                2014 www.yourdomain.com | All Right Reserved
            </div>
            <div class="col-md-4 social-box">
                <strong>We are Social </strong>
                <hr>
                <a href="#"><i class="fab fa-facebook-square fa-3x "></i></a>
                <a href="#"><i class="fab fa-twitter-square fa-3x "></i></a>
                <a href="#"><i class="fab fa-google-plus-square fa-3x c"></i></a>
                <a href="#"><i class="fab fa-linkedin-square fa-3x "></i></a>
                <a href="#"><i class="fab fa-pinterest-square fa-3x "></i></a>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur nec nisl odio. Mauris vehicula at nunc id posuere. Curabitur nec nisl odio. Mauris vehicula at nunc id posuere. 
                </p>
            </div>
        </div>
        <hr>
    </div>
    <!-- /.col -->
    <div class="col-md-12 end-box ">
        &copy; 2014 | &nbsp; All Rights Reserved | &nbsp; www.yourdomain.com | &nbsp; 24x7 support | &nbsp; Email us: info@yourdomain.com
    </div>
    <!-- /.col -->
    <!--Footer end -->
    <!--Core JavaScript file  -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!--bootstrap JavaScript file  -->
    <script src="assets/js/bootstrap.js"></script>
    <!--Slider JavaScript file  -->
    <script src="assets/ItemSlider/js/modernizr.custom.63321.js"></script>
    <script src="assets/ItemSlider/js/jquery.catslider.js"></script>
    <script>
        $(function () {

            $('#mi-slider').catslider();
             var sort = 'asc';
             var id_sp ='MP%';
            function load_right_content(id,page,sort)
            {
                $.ajax({
                    url: "right-content.php",
                    method: "post",
                    data: {id:id,page:page,sort:sort}, 
                    success: function(data)
                    {
                        $('#right-content').html(data);
                    }
                })
            }
            load_right_content('MP%',1,sort);
           
            
            $("#left-menu li, #left-menu .active").click(function()
                    {
                        id_sp= $(this).attr("id");
                        load_right_content(id_sp,1,sort);
                        console.log(id_sp); 
                    })
                   
            $(document).on('click','#sort li',function(){
                sort = $(this).attr("id");
                load_right_content(id_sp,1,sort);  
                
                    })

            $(document).on('click','#pagination li',function()
                    {
                        var page = $(this).attr("id");   
                         
                        
                        console.log("page:"+ page);
                        console.log("id:"+id_sp);
                        load_right_content(id_sp,page,sort);         

                    })
           
        }); 
		</script>