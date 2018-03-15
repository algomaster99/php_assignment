<?php
  $a = $b = 0; //create individual functions of each and assign variable. Do Not return.
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
    else if (!empty($_POST["email"])) {
      $email = modify($_POST["email"]);
      $b = true;
    }
    if (empty($_POST["pass"])){
      $passErr = "Password is required";
    }
    else {
      $pass = modify($_POST["pass"]);
    }
    if (empty($_POST["cnfpass"])){
      $cnfpassErr = "Confirmation of password is required";
    }
    else {
      $cnfpass = modify($_POST["cnfpass"]);
    }
    if (empty($_POST["dob"])){
      $dobErr = "Date of Birth is required";
    }
    else {
      $dob = modify($_POST["dob"]);
    }
    if (empty($_POST["gender"])){
      $genderErr = "Gender is required";
    }
    else {
      $gender = modify($_POST["gender"]);
    }
  }
  function modify($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  include('config.php');
  if (a and b){
 // $query = "INSERT INTO aman_user(name, email, mobile, password, age, gender) ".  "VALUES(".$name.",".$email.",".$pass.",NOW(),".$gender.")";

  //mysqli_query($connection, $query) or die("Failed to add data");
  }
?>
<!DOCTYPE html>
<head>
	<title>SignUp</title>
</head>
<body>
  <script type="text/javascript" src="js/signup.js"></script>
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
		Full Name: <input type="text" name="name" value="<?php echo $name; ?>"><span id="name"><?php echo $nameErr; ?></span><br /><br />
		E-mail ID: <input type="text" name="email"><span id="email" value="<?php echo $email; ?>"><?php echo $emailErr; ?></span><br /><br />
		Password: <input type="text" name="pass"><span id="pass" value="<?php echo $email; ?>"><?php echo $passErr; ?></span><br /><br />
		Confirm Password: <input type="text" name="cnfpass" value="<?php echo $cnfpass; ?>"><span id="cnfpass"><?php echo $cnfpassErr; ?></span><br /><br />
		DOB: <input type="date" name="dob"><span id="dob" value="<?php echo $dob; ?>"><?php echo $dobErr; ?></span><br /><br />
		Gender: <select>
			<option disabled selected>&lt;Select&gt;</option>
			<option name="gender" value="M">Male</option>
			<option name="gender" value="F">Female</option>
			<option name="gender" value="O">Other</option>
    </select><span id="gender"><?php echo $genderErr; ?></span><br /><br />
    <button type="submit">Submit</button>
	</form>
</body>
</html>
