<!DOCTYPE HTML>
<?php
    session_start();
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
	$title = "";
	$comment = "";
	$error = "";
	
	$con=mysqli_connect('localhost','root','') or die(mysql_error());
	mysqli_select_db($con,'polytech');
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (isset($_FILES["file"]["name"])) {
		if(isset($_SESSION['user']))
		{
			$fileType = pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION);
			
			if (empty($_POST["title"])) {
    			$error .= "* každý přispěvek musí mít titul<br>";
  			}
			else
			{
				$title = test_input($_POST["title"]);
				    if (empty($_POST["comment"])) {
  					}
					else
					{
						$comment = test_input($_POST["comment"]);
					}
					if($fileType != "pdf" && $fileType != "docx")
					{
						$error .= "* Soubor musí být typu: pdf, docx(Word) <br>";
					}
					if($_FILES["file"]["size"] > 5000000)
					{
						$error .= "* Soubor nesmí být větší jak 5MB <br>";
					}
					
			}
			if($error == "")
			{
				$target_dir = "uploads/";
				$name = generateRandomString(20);
				$target_file = $target_dir . $name . '.' . $fileType;
				$rename = test_input($_FILES["file"]["name"]);
				$userName = $_SESSION['user'];
				
				
				$sql="INSERT INTO article (Titule,Comment,Name,Nick) VALUES('$title','$comment','$target_file','$userName')";
				$result=mysqli_query($con,$sql);
				
				if (!file_exists($target_file)) {
				 	if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
       					$error .= '* soubor se podařilo nahrát ' .$rename .'<br>';
    				} else {
        				$error .= '* neznamý error <br>';
   				 	}
				}
				else
				{
					$error .= '* neznamý error <br>';
				}
			}
		 
		}
		}
		else
		{
			$error .= '* php nepodporuje nahravaní souboru <br>';
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
		<?php
		  if (!isset($_SESSION['user'])) {
			  echo '<li style="float:right" ><a href="login.php" class="btn">login</a></li>';
			  echo '<li style="float:right"><a href="register.php" class="btn">register</a></li>';
		  }
		  else
		  {
			  echo '<li style="float:right" class="dropdown" ><button class="dropbtn">' .$_SESSION['user']. '</button><div class="dropdown-content"><a href="prispevky.php" class="dropmenu">Seznam píspěvků</a><a href="logout.php" class="dropmenu">Odhlasit</a></div></li>';
			  echo '<li style="float:right"><a href="pridani.php" class="btn pic"><img border="0" alt="Home" src="images/article-red.png" width="20" height="20"></a></li>';
		  }
        	?>
	</ul>
	<ul>
	  <li><a href="Index.php" class="hav pic"><img border="0" alt="Home" src="images/home-blue.png" width="30" height="30"></a></li>
		<li><a href="casopisy.php" class="hav">Čísla časopisu</a></li>
		<li style="float:right" ><a href="about.php" class="hav">Napište nám</a></li>
		<li style="float:right" ><a href="revize.php" class="hav">Revize <u class="NotifNum">0</u></a></li>
	</ul>
</div>
    <div id="wrapper">
    <div class="login-card">
     <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
     	<span class="error"><?php echo $error;?></span>
   	    <input type="text" name="title" placeholder="Titul" value="<?php echo $title;?>">
        <textarea name="comment" placeholder="Komentář" rows="5" cols="24" class="Commentstyle"><?php echo $comment;?></textarea>
        <input type="file" name="file" class="filestyle"  id="fileToUpload" >
    	<input type="submit" name="login" class="login login-submit" value="poslat k revizi">
 	 </form>
     </div>
 </div>
	</body>
</html>
