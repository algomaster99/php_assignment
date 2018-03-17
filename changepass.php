<?php
  include("config.php");
  session_start();

  if ($_SERVER["REQUEST_METHOD"] == "POST"){
  $sql = "SELECT password from aman_user where email ='".$_SESSION["username"]."'";
  echo $sql;
  $result = $conn->query($sql);
  if ($result->num_rows > 0){
    while ($row = $result->fetch_assoc()){
      if (md5($_POST["pass_o"]) == $row["password"]){
        if ($_POST["pass_n"] == $_POST["cnfpass_n"] and $_POST["pass_n"] != $_POST["pass_o"]){
          $sql1 = "UPDATE aman_user SET password ='".md5($_POST["pass_n"])."' where email='".$_SESSION["username"]."'";
          if ($result = $conn->query($sql1)){
            header("location:profile.php");
          }
        }
      }
    }
  }
  }

?>

<!DOCTYPE html>
  <head><title>Change Password</title></head>
  <body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
      Old Password: <input type="text" name="pass_o" /><br />
      New Password: <input type="text" name="pass_n" /><br />
      Confirm Password: <input type="text" name="cnfpass_n" /><br />
      <button type="submit">Change Password</button><a href="profile.php">Go Back</a>
    </form>
  </body>
</html>
