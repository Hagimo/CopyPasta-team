<!DOCTYPE HTML>
<?php
    session_start();
    $_SESSION['www']= 'forgot';
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
				pagetop.style.height = "160px";
				topul.style.height = "50px";
				topul.style.paddingBottom = "1%";
			}
		}
		window.addEventListener("scroll", yScroll);
	</script>
	</head>
	<body>
    <?php
	include('connect.php');
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (!empty($_POST["email"])) {
			$email = $_POST["email"];
			$sql="SELECT * FROM user WHERE Email='$email'";
			$result=mysqli_query($con,$sql);
			 while ($row = mysqli_fetch_assoc($result)) {
				 $heslo = generateRandomString(7);
				 $password = password_hash($heslo, PASSWORD_DEFAULT);
				 $nick =  $row["Nick"];
				 $message = 'Dobry den pane '.$nick.',
				 vase Nove helo k portalu LOGOS POLYTECHNIKOS je "'.$heslo.'" ';
				 mail($email, "Obnovení hesla", $message, "From: DoNotReplay@LogosPoly.cz");
				 $sql2="UPDATE user SET Pass='$password' WHERE Nick='$nick'";
			     mysqli_query($con,$sql2);
			 }
		}
	}
	
	function generateRandomString($length = 10) {
    	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
   		$charactersLength = strlen($characters);
    	$randomString = '';
   		 for ($i = 0; $i < $length; $i++) {
       		 $randomString .= $characters[rand(0, $charactersLength - 1)];
    	}
   	 return $randomString;
	}
	
	include('topMenu.php');
	?> 
    <div id="wrapper">
  	<div class="login-card">
     <h3>Zapomněl jste heslo?</h3>
     <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
     <input type="email" name="email" placeholder="email@adress.com">
     <input type="submit" name="poslat" class="login login-submit" value="poslat">
     </form>
     </div>
    </div>
    <?php
	include('bottom.php');
	?> 
	</body>
</html>
