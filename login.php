<?php
 $nameErr = $passErr = "";
 if ($_SERVER["REQUEST_METHOD"] == "POST"){
   if (empty($_POST["username"])){
     $nameErr = "Please enter username";
   }
   else{
     $name = $_POST["username"];
   }
   if (empty($_POST["pass"])){
     $passErr = "Please enter a password";
   }
   else {
     $pass = md5($_POST["pass"]);
   }
    include('config.php');
    $sql_name = "select email from aman_user where email = '".$name."'"; 
    $sql_pass = "select password from aman_user where email = '".$name."'";
    
    $row1 = $conn->query($sql_name);
    $row2 = $conn->query($sql_pass);
    if ($row1 = $row1->fetch_assoc() == $name and $row2 = $row2->fetch_assoc() == $pass){
      session_start();
      $_SESSION["username"] = $name;
      $_SESSION["pass"] = $pass;
      header("location:profile.php");
    }
 }
?>
<!DOCTYPE html>
  <head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  </head>
  <body>
      <script type="text/javascript" src="js/login.js"></script>
      <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
          E-mail ID (Username): <input type="text" name="username" /><span id="username"><?php echo $nameErr; ?></span><br />
          Password: <input type="text" name="pass" /><span id="pass" /><?php echo $passErr; ?></span><br />
          Remember Me: <input type="checkbox" id="remember"><br />
          <button type="submit">Submit</button>
      </form>
  </body>
</html>
