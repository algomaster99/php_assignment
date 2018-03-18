<?php
  include("config.php");
  session_start();

  if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if (!empty($_POST["pass_o"]) and !empty($_POST["pass_n"]) and !empty($_POST["cnfpass_n"])){
  $username = $_SESSION["username"];
  $sql = "SELECT password from aman_user where email ='$username'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0){
   $row = $result->fetch_assoc();
      if (md5($_POST["pass_o"]) == $row["password"]){
        if ($_POST["pass_n"] == $_POST["cnfpass_n"] and $_POST["pass_n"] != $_POST["pass_o"]){
          $sql1 = "UPDATE aman_user SET password ='".md5($_POST["pass_n"])."' where email='".$_SESSION["username"]."'";
          if ($result = $conn->query($sql1)){
            echo "Password changed successfully";
          }
        }
        else {
          echo "Password didn't change either newpass=oldpass or newpasses dont match";
        }
      }
      else {
        echo "Old Password is wrong";
      }
    }
  }
    else {
      echo "please fill all fields";
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
