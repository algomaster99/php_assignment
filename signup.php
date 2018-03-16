<?php
  $a = $b = $c = $d = $e = $f = $g = $h = false; //create individual functions of each and assign variable. Do Not return.
  $name = $email = $pass = $cnfpass = $dob = $gender = $mobile = "";
  $nameErr = $passErr = $cnfpassErr = $dobErr = $genderErr = $mobileErr = $emailErr = "";
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])){
      $nameErr = "Name is required";
      $a = false;
    }
    else {
      $name = modify($_POST["name"]);
      if (!preg_match("/^[a-zA-Z]*$/", $name)) {
        $nameErr = "Only letters and white spaces are allowed";
        $a = false;
      }
      else {
        $a = true;
      }
    }
    if (empty($_POST["email"])){
      $emailErr = "Email is required";
      $b = false;
    }
    else {
      $email = modify($_POST["email"]);
      if (!preg_match("/[a-z0-9_\.]+[a-z]+[0-9]*@[a-z]+.(com|in|co\.in|org.in|iitr\.ac\.in)/", $email)) {
        $emailErr = "Please enter email id in valid format";
        $b = false;
      }
      else {
        $b = true;
      }
    }
    if (empty($_POST["mobile"])){
      $mobileErr = "Mobile No. is required";
      $h = false;
    }
    else {
      $mobile = modify($_POST["mobile"]);
      if (!preg_match("/^(\+91)[7-9]\d{9}$/", $mobile)){
        $mobileErr = "Enter Mobile No. in valid format";
        $h = false;
      }
      else {
        $h = true;
      }
    }
    if (empty($_POST["pass"])){
      $passErr = "Password is required";
      $c = false;
    }
    else {
      $pass = modify($_POST["pass"]);
      if (!preg_match("/.{8,}/", $pass)) {
        $passErr = "Atleast 8 characters required";
        $c = false;
      }
      else {
        $c = true;
      }
    }
    if (empty($_POST["cnfpass"])){
      $cnfpassErr = "Confirmation of password is required";
      $d = false;
    }
    else {
      $cnfpass = modify($_POST["cnfpass"]);
      if (preg_match("/.{8,}/", $cnfpass)){
        $d = true;
      }
      else {
        $cnfpassErr = "Atleast 8 characters required";
        $d = false;
      }
    }
    if ($pass == $cnfpass and ($c and $d)){
      $e = true;
      $passErr = $cnfpassErr = "";
    }
    else if (!empty($_POST["cnfpass"]) and $pass != $cnfpass){
      $cnfpassErr = "Passwords don't match";
      $e = false;
    }
    if (empty($_POST["dob"])){
      $dobErr = "Date of Birth is required";
      $f = false;
    }
    else {
      $dob = modify($_POST["dob"]);
      $f = true;
    }
    if ($_POST["gender"] == ""){
      $genderErr = "Please select a value";
      $g = false;
    }
    else {
      $gender = modify($_POST["gender"]);
      $g = true;
    }
  }

  function modify($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

 include('config.php');
 if ($a and $b and $c and $d and $e and $f and $g and $h){
   $query = "INSERT INTO aman_user(name, email, mobile, password, dob, gender) "."VALUES('".$name."','".$email."',".$mobile.",'".md5($pass)."','".$dob."','".$gender."')";

   if ($conn->query($query) === TRUE) {
         echo "New record created successfully";
   } else {
         echo "Error: " . $query . "<br>" . $conn->error;
   }

   $conn->close();
 }
?>
<!DOCTYPE html>
<head>
	<title>SignUp</title>
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
</head>
<body>
  <script type="text/javascript" src="js/signup.js"></script>
	<form name="signup" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
		Full Name: <input type="text" name="name" value="<?php echo $name; ?>" onblur="validName()"><span id="name"><?php echo $nameErr; ?></span><br /><br />
		E-mail ID: <input type="text" name="email" value="<?php echo $email; ?>" onblur="validEmail()"><span id="email"><?php echo $emailErr; ?></span><br /><br />
    Mobile No: <input type="text" name="mobile" value="<?php echo $mobile; ?>"><span id="mobile"><?php echo $mobileErr; ?></span><br /><br />
		Password: <input type="text" name="pass" value="<?php echo $pass; ?>"><span id="pass"><?php echo $passErr; ?></span><br /><br />
		Confirm Password: <input type="text" name="cnfpass" value="<?php echo $cnfpass; ?>"><span id="cnfpass"><?php echo $cnfpassErr; ?></span><br /><br />
		DOB: <input type="date" name="dob" value="<?php echo $dob; ?>"><span id="dob"><?php echo $dobErr; ?></span><br /><br />
		Gender: <select name="gender">
            <option value="" selected>&lt;Select&gt;</option>
            <option value="M">Male</option>
            <option value="F">Female</option>
            <option value="O">Other</option>
           </select><span id="gender"><?php echo $genderErr; ?></span><br /><br />
           <button type="submit">Submit</button>
</form>
</body>
</html>
