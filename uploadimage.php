<?php
  include("config.php");
  session_start();
  $username = $_SESSION["username"];
  $target_dir = "uploads/";
  if ($_SERVER["REQUEST_METHOD"] == "POST"){
  $target_file = $target_dir . basename($_FILES["dp"]["name"]);
  $uploadOka = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  // Check if image file is a actual image or fake image
  if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["dp"]["tmp_name"]);
            if($check !== false) {
                      echo "File is an image - " . $check["mime"] . ".";
                              $uploadOka= 1;
                                  } else {
                                            echo "File is not an image.";
                                                    $uploadOka = 0;
                                                        }
  }
// Check file size
if ($_FILES["dp"]["size"] > 500000) {
      echo "Sorry, your file is too large.";
          $uploadOka = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
          $uploadOka = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOka == 0) {
      echo "Sorry, your file was not uploaded.";
       $sql = "UPDATE aman_user SET profile_pic = NULL where email ='$username'";
                                                   $result = $conn->query($sql);
      // if everything is ok, try to upload file
} else {
      if (move_uploaded_file($_FILES["dp"]["tmp_name"], $target_file)) {
                  $files = glob("$target_dir"."*"); // get all file names
                               foreach($files as $file){ // iterate files
                                 if(is_file($file) and $file != $target_file){
                                     unlink($file); // delete file
                                   }
                               }

                echo "The file ". basename( $_FILES["dp"]["name"]). " has been uploaded.";
                $username = $_SESSION["username"];
                $sql = "UPDATE aman_user SET profile_pic = '$target_file' where email='$username'";
                $result = $conn->query($sql);
                    } else { $sql = "UPDATE aman_user SET profile_pic = '' where email ='$username'";
                                            $result = $conn->query($sql);

                              echo "Sorry, there was an error uploading your file.";
                                  }
}
$target_file = $target_dir . basename($_FILES["cp"]["name"]);
$uploadOkb = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
      $check = getimagesize($_FILES["cp"]["tmp_name"]);
          if($check !== false) {
                    echo "File is an image - " . $check["mime"] . ".";
                            $uploadOkb = 1;
                                } else {
                                          echo "File is not an image.";
                                                  $uploadOkb = 0;
                                                      }
}

// Check file size
if ($_FILES["cp"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
                  $uploadOkb = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
          $uploadOkb = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOkb == 0) {
      echo "Sorry, your file was not uploaded.";
      // if everything is ok, try to upload file
       $sql = "UPDATE aman_user SET cover_pic = NULL where email ='$username'";
                        $conn->query($sql);

} else {
      if (move_uploaded_file($_FILES["cp"]["tmp_name"], $target_file)) {
                  $files = glob("$target_dir"."*"); // get all file names
                               foreach($files as $file){ // iterate files
                                 if(is_file($file) and $file != $target_file and  $file != $target_dir . basename($_FILES["dp"]["name"])){


                                     unlink($file); // delete file
                                     }}  $sql = "UPDATE aman_user SET cover_pic = '$target_file' where email='$username'";
                                                   $result = $conn->query($sql);

                                              echo "The file ". basename( $_FILES["cp"]["name"]). " has been uploaded.";
                                  
                     } else { $sql = "UPDATE aman_user SET cover_pic = NULL where email ='$username'";
                                               $conn->query($sql);

                                                     echo "Sorry, there was an error uploading your file.";
                                  }
}
}

?>

<!DOCTYPE html>
  <head><title>Upload Images</title></head>
  <body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
      Upload Profile: <input type ="file" name="dp" />
      Upload Cover: <input type="file" name="cp" /><br />
      <button type="submit">Submit</button><a href="profile.php">Go Back</a>
    </form>
  </body>
</html>
