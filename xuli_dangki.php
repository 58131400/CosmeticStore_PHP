
<?php 
  
if (isset($_POST['submit'])) {
  require 'connect.php';
  $errors = array(); // Initialize an error array.
   
  
    $target_dir = "assets/img/khach_hang/";
    $target_file = $target_dir . basename($_FILES["hinh"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
      $check = getimagesize($_FILES["hinh"]["tmp_name"]);
      if($check !== false) 
      {
          echo "<p class='text-danger'>File is an image - " . $check["mime"] . ".</p>";
          $uploadOk = 1;
      } 
      else 
      {
          echo "<p class='text-danger'>File is not an image.</p>";
          $uploadOk = 0;
      }
    // Check if file already exists
    if (file_exists($target_file)) {
        echo "<p class='text-danger'>Sorry, file already exists.</p>";
        $uploadOk = 0;
    }
    // Check file size <0.5MB
    if ($_FILES["hinh"]["size"] > 500000) {
        echo "<p class='text-danger'>Sorry, your file is too large.</p>";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "<p class='text-danger'>Sorry, only JPG, JPEG, PNG & GIF files are allowed.</p>";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) 
    {
        echo "<p class='text-danger'>Sorry, your file was not uploaded.</p>";
    // if everything is ok, try to upload file
    } 
    else 
    {
        if (move_uploaded_file($_FILES["hinh"]["tmp_name"], $target_file)) 
        {
            echo "<p class='text-danger'>The file ". basename( $_FILES["hinh"]["name"]). " has been uploaded.</p>";
        } 
        else 
        {
            $errors[] = "<p class='text-danger'>Xin lỗi, có lỗi khi upload file.</p>";
        }
      }
     //lay ten file
    $hinh=  basename( $_FILES["hinh"]["name"]) ; 
  
  
 // Check for a username
  if (empty($_POST['username'])) {
    $errors[] = 'You forgot to enter your username.';
  } else {
    $q = "select ID from tai_khoan";
    $r = mysqli_query($conn,$q);
    $flag= 0;
    while ($row = mysqli_fetch_array($r)) {
      if($row['ID'] == $_POST['username'])
      {
        $errors[] = 'Username đã có người sử dụng';
        $flag = 1;
        break;

      }
    }
    if ($flag == 0) {
      $username = mysqli_real_escape_string($conn, trim($_POST['username']));
    }
    
  }

   // Check for a ho ten
  if (empty($_POST['hoten'])) {
    $errors[] = 'You forgot to enter your name.';
  } else {
    $hoten = mysqli_real_escape_string($conn, trim($_POST['hoten']));
  }
  // Check for a dienthoai
  if (empty($_POST['dienthoai'])) {
    $errors[] = 'You forgot to enter your phone.';
  } else {
    $dienthoai = mysqli_real_escape_string($conn, trim($_POST['dienthoai']));
  }
  
  // Check for an ghi chu
  if (empty($_POST['diachi'])) {
    $errors[] = 'You forgot to enter your dia chi.';
  } else {
    $diachi = mysqli_real_escape_string($conn, trim($_POST['ghichu']));
  }
  // Check for an ghi chu
  if (empty($_POST['ghichu'])) {
    $ghichu = '';
  } else {
    $ghichu = mysqli_real_escape_string($conn, trim($_POST['ghichu']));
  }
  // Check for an email address:
  if (empty($_POST['email'])) {
    $errors[] = 'You forgot to enter your email address.';
  } else {
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
  }
  
  // Check for a password and match against the confirmed password:
  if (!empty($_POST['pass1'])) {
    if ($_POST['pass1'] != $_POST['pass2']) {
      $errors[] = 'Your password did not match the confirmed password.';
    } else {
      $pass = md5(trim($_POST['pass1']));
      $pass = mysqli_real_escape_string($conn, $pass);
    }
  } else {
    $errors[] = 'You forgot to enter your password.';
  }
  
  if (empty($errors)) 
  { // If everything's OK.
  
    //lay ma tu dong khach hang
    $q = "select makh from khach_hang";
    $r = mysqli_query($conn,$q);
    $mamax = 0;
    while ($row = mysqli_fetch_array($r)) {
      
      if ($mamax < intval(substr($row['makh'],3))) {
        $mamax = intval(substr($row['makh'],3));

      }
    }
    $mamax++;
    
    $ma_number = '00'.$mamax;
    
    $makh = "KH".substr($ma_number, strlen($mamax)-1);
    
    //lay ma tu dong tai khoan
    $q = "select matk from tai_khoan";
    $r = mysqli_query($conn,$q);
    $mamax = 0;
    while ($row = mysqli_fetch_array($r)) {
      if ($mamax < substr($row['matk'],3)) {
        $mamax = substr($row['matk'],3);
      }
    }
    $mamax++;
    
    $ma_number = '00'.$mamax;
    
    $matk = "TK".substr($ma_number, strlen($mamax)-1);
    
    // Register the user in the database...
    

    // Make the query:
    $q = "INSERT into tai_khoan(matk,ID,pass,role) values ('$matk','$username','$pass',0);";
    $q .= "INSERT INTO khach_hang (makh,hoten,dienthoai,diachi,email,ghichu,hinh,matk) VALUES ('$makh', '$hoten', '$dienthoai', '$diachi','$email', '$ghichu','$hinh','$matk' )";   
    
    
    /* execute multi query */
    if (mysqli_multi_query($conn, $q)) 
    {
       
                 echo ("<script LANGUAGE='JavaScript'>
    window.alert('Succesfully Register');
    window.location.href='dangnhap.php';
    </script>");
            
    }
    else echo '<p>Register fail1 ' . mysqli_error($conn).'</p>';
  }
    else 
    { // Report the errors.
      
        echo '<h1>Error!</h1>
        <p class="error">The following error(s) occurred:<br />';
        foreach ($errors as $msg) 
        { // Print each error.
          echo " - $msg<br />\n";
        }
        echo '</p><p>Please try again.</p><p><br /></p>';
    } // End of if (empty($errors)) IF.
     mysqli_close($conn); // Close the database connection.
  }

?>
