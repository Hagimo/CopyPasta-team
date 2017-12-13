<!DOCTYPE HTML>
<?php
    session_start();
    $_SESSION['www'] = 'admin';
	 if (isset($_SESSION['user'])) {
	 	if ($_SESSION['type'] != "admin") {
			   header('Location: Index.php');
		}
	}
	else {
	header('Location: Index.php');
	}
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
	include('connect.php');
	
	$name = "";
	$password = "";
	$password_re = "";
	$email = "";
	$error = "";
	$type = "user";
	$nick = "";
	$cas2 = "";
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (!empty($_POST['Potvrdít'])) {
  			 if (!empty($_POST["Smazat"])) {
				  if($_POST["Smazat"] == "Smazat")
				  {
					  $nick = $_POST["Nick"];
					  $sql="DELETE FROM user WHERE Nick='$nick'";
					  mysqli_query($con,$sql);
				  }
				  else
				  {
					  $nick = $_POST["Nick"];
					  $type = $_POST["Type"];
					  $sql="UPDATE user SET  Type='$type'  WHERE Nick='$nick'";
					  mysqli_query($con,$sql);
					  
					  $sql3="SELECT * FROM ban WHERE Nick='$nick'";
	        		  $result3=mysqli_query($con,$sql3);
					  if($_POST["Ban"] == "Nemá")
					  {
						  if(mysqli_num_rows($result3) == 0){
						  }
						  else
						  {
							    $sql="DELETE FROM ban WHERE Nick='$nick'";
								mysqli_query($con,$sql);
						  }
					  } 
					  else
					  {
						  if(mysqli_num_rows($result3) == 0){
							  switch($_POST["Ban"])
							  {
								  case "1 den": 
								  				$cas2 = date('y-m-d', strtotime("+1 days"));
								  				$sql="INSERT INTO ban VALUES  ('$nick','$cas2')";
												mysqli_query($con,$sql);
								  	break;
								  case "1 tyden":
								 			    $cas2 = date('y-m-d', strtotime("+1 week"));
								  				$sql="INSERT INTO ban VALUES  ('$nick','$cas2')";
												mysqli_query($con,$sql);
								  	break;
								  case "1 rok":
								  				$cas2 = date('y-m-d', strtotime("+1 year"));
								  				$sql="INSERT INTO ban VALUES  ('$nick','$cas2')";
												mysqli_query($con,$sql);
								  	break;
								   case "10 let":
								   				$cas2 = date('y-m-d', strtotime("+10 year"));
								  				$sql="INSERT INTO ban VALUES  ('$nick','$cas2')";
												mysqli_query($con,$sql);
								  	break;
							  }
						  }
						  else
						  {
							  switch($_POST["Ban"])
							  {
								  case "1 den":
								 				$cas2 = date('y-m-d', strtotime("+1 days"));
								  				$sql="UPDATE ban SET Doba='$cas2' WHERE Nick='$nick'";
												mysqli_query($con,$sql);
								  	break;
								  case "1 tyden":
								  			   $cas2 = date('y-m-d', strtotime("+1  week"));
								  				$sql="UPDATE ban SET Doba='$cas2' WHERE Nick='$nick'";
												mysqli_query($con,$sql);
								  	break;
								  case "1 rok":
								  				$cas2 = date('y-m-d', strtotime("+1 year"));
								  				$sql="UPDATE ban SET Doba='$cas2' WHERE Nick='$nick'";
												mysqli_query($con,$sql);
								  	break;
								   case "10 let":
								   				$cas2 = date('y-m-d', strtotime("+10 year"));
								  				$sql="UPDATE ban SET Doba='$cas2' WHERE Nick='$nick'";
												mysqli_query($con,$sql);
								  	break;
								   default:
								  		        //$cas2 = ('y-m-d', strtotime($_POST["Ban"]));
								  				//$sql="INSERT INTO ban SET Doba='$cas2' WHERE Nick='$nick'";
												//mysqli_query($con,$sql);
									break;
							  }
						  }
					  }
				  }
			 }
		}
		if (!empty($_POST['Pridat'])) {
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
								$type = $_POST["Type"];
								$password = password_hash($password_re, PASSWORD_DEFAULT);
								mysqli_query($con,"INSERT INTO user VALUES('$name','$password','$email', '$type')");
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
	}
	
	function test_input($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
	
	include('topMenu.php');
	?>  
    <div id="wrapper">
    <?php
    $sql="SELECT * FROM user";
	$result=mysqli_query($con,$sql);
	
	
	if (isset($_SESSION['user'])) {
       echo '<div class="Main-card">';
	   echo '<h2>Existujici uživatelé</h2>';
	        echo '<table align="center">';
			echo '<tr>';
			echo ' <th class="tbltop">Nick</th>';
			echo ' <th class="tbltop">Email</th>';
			echo ' <th class="tbltop">Typ</th>';
			echo ' <th class="tbltop">Ban</th>';
			echo ' <th class="tbltop">Smazat</th>';
			echo ' <th class="tbltop">Potvrdit</th>';
			echo ' </tr>';
	   while ($row = mysqli_fetch_assoc($result)) {
		    echo '<tr>';
		    echo '<th>'.$row["Nick"].'</th>';
			echo '<th>'.$row["Email"].'</th>';
			echo '<form method="post" action=" '. htmlspecialchars($_SERVER["PHP_SELF"]).' ">';
			echo '<input type="hidden" name="Nick" value="'.$row["Nick"].'">';
			echo '<th>';
			echo '<select name="Type" class="styled-select">';
			$sql2="SELECT * FROM usertype";
	        $result2=mysqli_query($con,$sql2);
			while ($row2 = mysqli_fetch_assoc($result2)) {
				if($row2["Type"] == $row["Type"])
				{
					echo '<option value="'.$row2["Type"].'" selected>'.$row2["Type"].'</option>';
				}
				else
				{
					echo '<option value="'.$row2["Type"].'">'.$row2["Type"].'</option>';
				}
			}
			echo '</select>';
			echo '</th>';
			echo '<th>';
			echo '<select name="Ban" class="styled-select">';
			$nick = $row["Nick"];
			$sql3="SELECT * FROM ban WHERE Nick='$nick'";
	        $result3=mysqli_query($con,$sql3);
			if(mysqli_num_rows($result3) == 0){
				echo '<option value="Nemá" selected>Nemá</option>';
				echo '<option value="1 den">1 den</option>';
				echo '<option value="1 tyden">1 tyden</option>';
				echo '<option value="1 rok">1 rok</option>';
				echo '<option value="10 let">10 let</option>';
			}
			else
			{   
			    $res = mysqli_fetch_assoc($result3);
			    echo '<option value="'.$res["Doba"].'" selected>'.$res["Doba"].'</option>';
			    echo '<option value="Nemá">Nemá</option>';
				echo '<option value="1 den">1 den</option>';
				echo '<option value="1 tyden">1 tyden</option>';
				echo '<option value="1 rok">1 rok</option>';
				echo '<option value="10 let">10 let</option>';

			}
			echo '</select>';
			echo '</th>';
			echo '<th>';
			echo '<select name="Smazat" class="styled-select">';
				echo '<option value="Nedělat Nic" selected>Nedělat Nic</option>';
				echo '<option value="Smazat">Smazat</option>';
			echo '</select>';
			echo '</th>';
			echo '<th><input type="submit" class="login table-submit" name="Potvrdít" value="Potvrdít"></th>';
			echo '</form>';
			echo '</tr>';
	   }
	   echo '</table>';
	   echo '</div>';
	   echo '<div class="login-card">';
	    echo '<h2>Přidat nového uživatele</h2>';
		echo '<form method="post" action=" '. htmlspecialchars($_SERVER["PHP_SELF"]).' ">';
		echo '<span class="error">'.$error.'</span>';
		echo '<input type="text" name="user" placeholder="Username">';
    	echo '<input type="password" name="pass" placeholder="Password" >';
        echo '<input type="password" name="passre" placeholder="Confirm Password">';
        echo '<input type="email" name="email" placeholder="email@adress.com">';
		echo '<select name="Type" class="styled-select">';
		$sql2="SELECT * FROM usertype";
	    $result2=mysqli_query($con,$sql2);
			while ($row2 = mysqli_fetch_assoc($result2)) {
			echo '<option value="'.$row2["Type"].'">'.$row2["Type"].'</option>';
			}
			echo '</select>';
		echo '<input type="submit" class="login table-submit" name="Pridat" value="Přidat">';
		echo '</form>';
	   echo '</div>';
    }
	?> 
</div>
 <?php
	include('bottom.php');
	?> 
	</body>
</html>
