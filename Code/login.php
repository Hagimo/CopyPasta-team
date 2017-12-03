<!DOCTYPE HTML>
<html lang="cs">
	<head>
    <link rel="stylesheet" type="text/css" href="css/mystyle.css">
	    <script>
		var pagetop, menu, yPos;
		function yScroll(){
			pagetop = document.getElementById('pagetop');
			topul = document.getElementById('topul');
			yPos = window.pageYOffset;
			if(yPos > 150){
				pagetop.style.height = "55px";
				topul.style.height = "0px";
				topul.style.paddingBottom = "0px";
			} else {
				pagetop.style.height = "120px";
				topul.style.height = "50px";
				topul.style.paddingBottom = "1%";
			}
		}
		window.addEventListener("scroll", yScroll);
	</script>
	</head>
	<body>
    <?php
    $name = "";
	$password = "";
	$pass = "";
	$error = "";
	
	$con=mysqli_connect('localhost','root','') or die(mysql_error());
	mysqli_select_db($con,'polytech');
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (empty($_POST["user"])) {
			$error = "incorrect login credentials";
		}
		else
		{
			$name = test_input($_POST["user"]);
			
		}
		if (empty($_POST["pass"])) {
			$error = "incorrect login credentials";
		}
		else
		{
			$password = test_input($_POST["pass"]);
		}
	
	if($error == "")
		{
			$sql="SELECT Pass,Type FROM user WHERE Nick='$name'";
			$result=mysqli_query($con,$sql);
			$count=mysqli_num_rows($result);
			$arr = mysqli_fetch_assoc($result);
			if($count == 1)
			{
				if(password_verify($password, $arr["Pass"]))
				{
					session_start();
					$_SESSION['user']= $name;
                                        $_SESSION['type']= $arr["Type"];
					header('Location: Index.php');
				}
				else
				{
					$error = "incorrect login credentials";
				}
			}
			else
			{
				$error = "incorrect login credentials";
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
	 <div id="pagetop">
	<ul class="topul" id="topul">
    	<li><a href="Index.php" class="Title1">LOGOS</a></li>
        <li><a href="Index.php" class="Title2">POLYTECHNIKOS</a></li>
		<li style="float:right" ><a href="login.php" class="active_b btn">login</a></li>
		<li style="float:right"><a href="register.php" class="btn">register</a></li>
	</ul>
	<ul>
	  <li><a href="Index.php" class="hav pic"><img border="0" alt="Home" src="images/home-blue.png" width="30" height="30"></a></li>
		<li><a href="casopisy.php" class="hav">Císla casopisu</a></li>
		<li style="float:right" ><a href="about.php" class="hav">Informace</a></li>
		<?php
		   if (!isset($_SESSION['user'])) {
			    if ($_SESSION['type'] == "redaktor") {
			   echo '<li style="float:right" ><a href="revize.php" class="hav">Revize <u class="NotifNum">0</u></a></li>';
			   }
		   }
		   ?>
	</ul>
	</div>
    <div id="wrapper">
     <div class="login-card">
     <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
     	<span class="error"><?php echo $error;?></span>
   	    <input type="text" name="user" placeholder="Username" value="<?php echo $name;?>">
    	<input type="password" name="pass" placeholder="Password" value="<?php echo $password;?>">
    	<input type="submit" name="login" class="login login-submit" value="login">
 	 </form>
     <div class="login-help">
    	<a href="register.php">Register</a> • <a href="#">Forgot Password</a>
 	 </div>
     </div>
 </div>
	</body>
</html>
