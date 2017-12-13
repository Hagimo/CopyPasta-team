<!DOCTYPE HTML>
<?php
    session_start();
    $_SESSION['www']= 'login';
?>
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
	
	include('connect.php');
	
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
	 <?php
	include('topMenu.php');
	?> 
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
 <?php
	include('bottom.php');
	?> 
	</body>
</html>
