<?php
include "../db.php";

if (isset($_POST['submit'])) {
     $files = $_FILES['file'];
     
     $filename = $files['name'];
     $fileerror = $files['error'];
     $filetmp = $files['tmp_name'];
     
     $fileext = explode('.',$filename);
     $filecheck = strtolower(end($fileext));
     
     $fileextstrong = array ('png', 'jpg', 'jpeg');
     
     if (in_array($filecheck,$fileextstrong)) {
          $dentanision = 'upload/'.$filename;
          move_uploaded_file($filetmp,$dentanision);
          
          $q = "INSERT INTO `userimage` (`user_id`, `username`, `image`, `email `) VALUES ('$dentanision')";
          $query = mysqli_query($conn, $q);
     }
     
}


?>