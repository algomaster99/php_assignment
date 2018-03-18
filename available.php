<?php
  $c = false;
  include("config.php");
  $q = $_GET["q"];
  $sql  = "select email from aman_user";
  $result = $conn->query($sql);
  if ($result->num_rows > 0){
    while ($row = $result->fetch_assoc()){
      if ($q == $row["email"]){
        echo "Username not available";
        $c = true;
      }
    }
  }
  if (!$c){
    echo "Username available";
  }
?>
