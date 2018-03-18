<?php
  session_start();
  include("config.php");
  if (!empty($_SESSION["username"])){
    $username = $_SESSION["username"];
    $sql = "SELECT * from aman_user where email='$username'";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()){
      if ($row["branch"] == NULL or $row["interests"] == NULL or $row["cover_pic"] == NULL or $row["profile_pic"] == NULL){
        die("Fill details first! <a href='profile.php'>Profile Page</a>");
      }
    }
  $sql = "select * from aman_post";
  $result = $conn->query($sql);
  if ($result->num_rows > 0){
    while ($row = $result->fetch_assoc()){
      $name = $row['name'];
      $comment = $row['comment'];
      $time = $row['time'];
      echo "$name posted $comment on $time <br />";
    }
  }
  }
  else {
    header("location:index.php");
  }
?>

<!DOCTYPE html>
  <head><title>Feed</title></head>
  <body>
    <button onclick="location.href = 'profile.php'">Go Back</button>
  </body>
</html>

