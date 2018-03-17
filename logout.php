<?php
if (isset($_GET["logout"])){
  session_start();
  if (isset($_SESSION["username"])){
    session_destroy();
  }
 if (!empty($_COOKIE["username"])){
    setcookie("username","",time()-3600);
 }
}
else {
  header("location:index.php");
}
?>
<DOCTYPE html>
  <head><title>Thanks for coming by!</title></head>
  <body>
  Thanks for coming by!<br />
   <button onclick="location.href = 'login.php';">Login Again?</button>
  </body>
</html>
