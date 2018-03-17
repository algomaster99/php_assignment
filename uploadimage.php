<?php
  include("config.php");
  session_start();
  $target_dir = "uploads/";
  if ($_SERVER["REQUEST_METHOD"] == "POST"){
  $files = glob("$target_dir"."*"); // get all file names
                               foreach($files as $file){ // iterate files
                                 if(is_file($file))
                                     unlink($file); // delete file
                                     }
  $target_file = $target_dir . basename($_FILES["dp"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  // Check if image file is a actual image or fake image
  if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["dp"]["tmp_name"]);
            if($check !== false) {
                      echo "File is an image - " . $check["mime"] . ".";
                              $uploadOk = 1;
                                  } else {
                                            echo "File is not an image.";
                                                    $uploadOk = 0;
                                                        }
  }
// Check if file already exists
if (file_exists($target_file)) {
      echo "Sorry, file already exists.";
          $uploadOk = 0;
}
// Check file size
if ($_FILES["dp"]["size"] > 500000) {
      echo "Sorry, your file is too large.";
          $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
          $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
      // if everything is ok, try to upload file
} else {
      if (move_uploaded_file($_FILES["dp"]["tmp_name"], $target_file)) {
                echo "The file ". basename( $_FILES["dp"]["name"]). " has been uploaded.";
                $username = $_SESSION["username"];
                $sql = "UPDATE aman_user SET profile_pic = '$target_file' where email='$username'";
                $result = $conn->query($sql);
                    } else 
                              echo "Sorry, there was an error uploading your file.";
                                  }
$target_file = $target_dir . basename($_FILES["cp"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
      $check = getimagesize($_FILES["cp"]["tmp_name"]);
          if($check !== false) {
                    echo "File is an image - " . $check["mime"] . ".";
                            $uploadOk = 1;
                                } else {
                                          echo "File is not an image.";
                                                  $uploadOk = 0;
                                                      }
}
// Check if file already exists
if (file_exists($target_file)) {
      echo "Sorry, file already exists.";
          $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
          $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
      // if everything is ok, try to upload file
} else {
      if (move_uploaded_file($_FILES["cp"]["tmp_name"], $target_file)) {
                echo "The file ". basename( $_FILES["cp"]["name"]). " has been uploaded.";
                   $username = $_SESSION["username"];
                                   $sql = "UPDATE aman_user SET cover_pic = '$target_file' where email='$username'";
                                                   $result = $conn->query($sql);

                    } else {
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
