<?php
if($total_records > 6)
{
echo '        
                <!-- /.row -->
                <div class="row">
                    <ul class="pagination alg-right-pad" id="pagination">
                    ';
                    if($_POST['page'] != 1 )
                    {       
                        echo '<li id="'.($_POST['page']-1).'">&laquo;</li>';
                    }
                    else
                    {
                        echo'
                        <li id="1">&laquo;</li>';
                    }

                        for ($num=1; $num <= $total_pages ; $num++) { 
                            if ($num == $_POST['page']) {
                                echo '<li id="'.$num.'"><b>'.$num.'</b></li>';
                                # code...
                            }
                            else
                                echo '<li id= "'.$num.'">'.$num.'</li>';
                            }
                        if($_POST['page'] == $total_pages) echo '<li id="'.$total_pages.'">&raquo</li>';
                        else
                        echo '<li id="'.($_POST['page']+1).'">&raquo;</li>
                    </ul>
                    
                </div>';
}
?>