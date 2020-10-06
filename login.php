<?php
 $name = "";
 session_start();
 if (!empty($_SESSION["username"])){
  header("location:profile.php");
 }
 else if (!empty($_COOKIE["username"])){
    $_SESSION["username"] = $_COOKIE["username"];
    header("location:profile.php");
 }
 else{
 $nameErr = $passErr = "";
 if ($_SERVER["REQUEST_METHOD"] == "POST"){
   if (empty($_POST["username"])){
     $nameErr = "Please enter username";
   }
   else{
    $name = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
   }
   if (empty($_POST["pass"])){
     $passErr = "Please enter a password";
     $pass = "";
   }
   else {
     $pass = md5($_POST["pass"]);
   }
   if (!empty($name) and !empty($pass)){
    include('config.php');
    $sql_name = "select email from aman_user where email = '".$name."'";
    $sql_pass = "select password from aman_user where email = '".$name."'";
    $result1 = $conn->query($sql_name);
    $result2 = $conn->query($sql_pass);
    if ($result1->num_rows > 0 and $result2->num_rows >0){
      while ($row1 = $result1->fetch_assoc() and $row2 = $result2->fetch_assoc()){
        if ($row1["email"] == $name and $row2["password"] == $pass){
          session_start();
          $_SESSION["username"] = $name;
          if (!empty($_POST["remember"])){
            echo "<script type='text/javascript'>console.log(1);</script>";
            $cookie_name = "username";
            setcookie($cookie_name, $name, time() + 240);
          }
          echo $_SESSION["username"];
          header("location:profile.php");
        }
        else {
          echo "Password and username combination is wrong!";
        }
      }
    }
    else if (!empty($name) and !empty($pass)){
      echo "Password and username combination is wrong!";
    }
  }
   else {
     echo "Data is required in both fields.";
   }

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
          Profile: <img src="#" /><br />
          E-mail ID (Username): <input type="text" name="username" /><span id="username"><?php echo $nameErr; ?></span><br />
          Password: <input type="password" name="pass" /><span id="pass" /><?php echo $passErr; ?></span>
          <a href="signup.php">Not Registered Yet?</a><br />
          Remember Me: <input type="checkbox" id="remember" name="remember" value="checked"><br />
          <button type="submit">Submit</button>
      </form>
  </body>
</html>
