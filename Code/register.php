<!DOCTYPE HTML>
<html lang="cs">
	<head>
    <link rel="stylesheet" type="text/css" href="css/mystyle.css">
	</head>
	<body>
	<?php
	
	$name = "";
	$password = "";
	$password_re = "";
	$email = "";
	$error = "";
	
	
	$con=mysqli_connect("localhost","root","") or die(mysql_error());
	mysqli_select_db($con,'polytech');
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (empty($_POST["user"])) {
    		$error .= "* Username is required <br>";
  		}
		else
		{
			$name = test_input($_POST["user"]);
			if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      			$error .= "* Only letters and white space allowed <br>"; 
   			}
		}
		if (empty($_POST["pass"])) {
    		$error .= "* Password is required <br>";
  		}
		else
		{
			$password = test_input($_POST["pass"]);
			if(strlen($password) < 6)
			{
				$error .= "* Password is required to have at least 6 characters <br>";
			}
		}
		if (empty($_POST["passre"])) {
    		$error .= "* You have to confirm Password <br>";
  		}
		else
		{
			$password_re = test_input($_POST["passre"]);
		}
		if (empty($_POST["email"])) {
    		$error .= "* Email is required <br>";
  		}
		else
		{
			$email = test_input($_POST["email"]);
			
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
     			 $error .= "* Invalid email format <br>"; 
    		}
		}
		
		
		
		
		if($error == "")
		{
			if($password == $password_re)
			{
				
				$sql="SELECT * FROM user WHERE Nick='$name'";
				$result=mysqli_query($con,$sql);
				$count=mysqli_num_rows($result);
				
				if($count == 0)
				{
					$sql="SELECT * FROM user WHERE Email='$email'";
					$result=mysqli_query($con,$sql);
					$count=mysqli_num_rows($result);
					if($count == 0)
					{
						$password = password_hash($password_re, PASSWORD_DEFAULT);
						mysqli_query($con,"INSERT INTO user VALUES('$name','$password','$email','user')");
						session_start();
						$_SESSION['user']= $name;
						header('Location: index.php');
						
					}
					else
					{
						$error .= "* An account already exists with this email address <br>"; 
					}
					
				}
				else
				{
					$error .= "* Username is already taken <br>"; 
				}
				
			}
			else
			{
				$error .= "* Passwords don't match";
			}

		}
		
		
	}
		function test_input($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
	?>
	<ul class="topul">
    	<li><a href="Index.php" class="Title1">LOGOS</a></li>
        <li><a href="Index.php" class="Title2">POLYTECHNIKOS</a></li>
		<li style="float:right" ><a href="login.php" class="btn">login</a></li>
		<li style="float:right"><a href="register.php" class="active_b btn ">register</a></li>
	</ul>
	<ul>
	  <li><a href="Index.php" class="hav pic"><img border="0" alt="Home" src="images/home-blue.png" width="30" height="30"></a></li>
		<li><a href="casopisy.php" class="hav">Čísla časopisu</a></li>
		<li style="float:right" ><a href="about.php" class="hav">Napište nám</a></li>
		<li style="float:right" ><a href="revize.php" class="hav">Revize <u class="NotifNum">0</u></a></li>
	</ul>
    <div class="login-card">
     <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
     	<span class="error"><?php echo $error;?></span>
   	    <input type="text" name="user" placeholder="Username" value="<?php echo $name;?>">
    	<input type="password" name="pass" placeholder="Password" value="<?php echo $password;?>">
        <input type="password" name="passre" placeholder="Confirm Password" value="<?php echo $password_re;?>">
        <input type="email" name="email" placeholder="email@adress.com" value="<?php echo $email;?>">
    	<input type="submit" name="login" class="login login-submit" value="Register">
 	 </form>
     </div>
	</body>
</html>
