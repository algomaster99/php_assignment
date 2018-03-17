<?php
  include("config.php");
  session_start();
  if (isset($_SESSION["username"])){
  $username = $_SESSION["username"];
    $sql = "SELECT name from aman_user where email ='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0){
      while ($row = $result->fetch_assoc()) {
        echo "<h1>Welcome ".$row["name"]."!</h1>";
      }
    }
  }
  else if (!empty($_COOKIE["username"])){
    $_SESSION["username"] = $_COOKIE["username"];
    $sql = "SELECT name from aman_user where email ='$username'";
      $result = $conn->query($sql);
      if ($result->num_rows > 0){
         while ($row = $result->fetch_assoc()) {
           echo "Welcome ".$row["name"]."!";
         }
      }
  }
  else {
   echo "<button onclick=\"location.href = 'index.php';\">Homepage</button><br />";
   die("You're not logged in");
  }
  $details1 = $details2 = "";
  $sql1 = "SELECT branch from aman_user where email ='$username'";
  $sql2 = "SELECT interests from aman_user where email ='$username'";
  $result1 = $conn->query($sql1);
  $result2 = $conn->query($sql2);

  if ($result1->num_rows > 0){
    while ($row = $result1->fetch_assoc()){
      $details1 = "<h4>Branch: </h4>".$row["branch"]." ";
    }
  }
  if ($result2->num_rows > 0){
    while ($row = $result2->fetch_assoc()){
          $details2 = "<h4>Interests: </h4>".$row["interests"]." ";
    }
}
  $image1 = "";

 $sqldp="SELECT profile_pic from aman_user where email='$username'";
 $result = $conn->query($sqldp);
 if ($result->num_rows > 0){
   while ($row = $result->fetch_assoc()){
      $image1 = $row['profile_pic'];
   }
 }
  $image2 = "";

   $sqlcp="SELECT cover_pic from aman_user where email='$username'";
    $result = $conn->query($sqlcp);
     if ($result->num_rows > 0){
          while ($row = $result->fetch_assoc()){
                  $image2 = $row['cover_pic'];
                     }

 }
?>
<!DOCTYPE html>
  <head><title>Welcome to Connect!</title></head>
  <body>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/formdata">
      <span><?php echo $details1.$details2; ?></span><br />
      <img src="<?php echo $image1; ?>" />
      <img src="<?php echo $image2; ?>" />
      <input type="button" onclick="location.href = 'uploadimage.php';" value="Upload Images" />
      <input type="button" onclick="location.href = 'details.php';" value="Upload Details" />
      <input type="button" onclick="location.href = 'changepass.php';" value="Change Password" />
      <input type="button" onclick="location.href = 'logout.php?logout=1';" value="Log Out" />
    </form>
  </body>
</html>
