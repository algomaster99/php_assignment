<?php
  $branchErr = $interestErr = "";
  $branch = $interest ="";
  if ($_SERVER["REQUEST_METHOD"] == "POST" ){
    if (empty($_POST["branch"])){
      $branchErr = "Required";
      $a = false;
    }
    else {
      $branch = $_POST["branch"];
      $a = true;
    }
    if (empty($_POST["interests"])){
      $interestErr = "Required";
      $b = false;
    }
    else {
      $interest = $_POST["interests"];
      $b = true;
    }

    if ($a and $b){
      include("config.php");
      session_start();
      $sql1 = "UPDATE aman_user SET branch = '".$branch."' where email='".$_SESSION["username"]."'";
      $sql2 = "UPDATE aman_user SET interests = '".$interest."' where email='".$_SESSION["username"]."'";
      if ($conn->query($sql1) and $conn->query($sql2)){
        header("location:profile.php");
      }
      $conn->close();
    }
  }
?>

<!DOCTYPE html>
  <head><title>Upload Details</title></head>
  <body>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
      Branch: <input type="text" name="branch" value="<?php echo $branch; ?>"/><span><?php echo $branchErr; ?></span><br />
      Interests: <textarea name="interests" value="<?php echo $interest; ?>"></textarea><span><?php echo $interestErr; ?></span><br />
      <button type="submit">Submit!</button><a href="profile.php">Go Back</a>
    </form>
  </body>
</html>
