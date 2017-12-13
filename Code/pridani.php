<!DOCTYPE HTML>
<?php
    session_start();
    $_SESSION['www']= 'pridani';
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
	$secces = "";
	$tema = "";
	
	include('connect.php');
	
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
				
				$tema = $_POST["Tema"];
				
				$sql="INSERT INTO article (Titule,Tema,Comment,Name,Nick) VALUES('$title','$tema','$comment','$target_file','$userName')";
				$result=mysqli_query($con,$sql);
				
				if (!file_exists($target_file)) {
				 	if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
       					$secces .= '* soubor se podařilo nahrát ' .$rename .'<br>';
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
	<?php 
	include('topMenu.php');
	?>  
    <div id="wrapper">
    <div class="login-card">
     <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
     	<span class="error"><?php echo $error;?></span><span class="secces"><?php echo $secces;?></span>
   	    <input type="text" name="title" placeholder="Titul" value="<?php echo $title;?>">
        <textarea name="comment" placeholder="Komentář" rows="5" cols="24" class="Commentstyle"><?php echo $comment;?></textarea>
        <select name="Tema" class="styled-select">
        <?php
		$sql="SELECT * FROM tema";
		$result=mysqli_query($con,$sql);
		$count=mysqli_num_rows($result);
		  while ($row = mysqli_fetch_assoc($result)){
			  echo '<option value="'.$row["Tema"].'">'.$row["Tema"].'</option>';
		  }
		?> 
 		 </select>
        <input type="file" name="file" class="filestyle"  id="fileToUpload" >
    	<input type="submit" name="login" class="login login-submit" value="poslat k revizi">
 	 </form>
     </div>
 </div>
 <?php
	include('bottom.php');
	?> 
	</body>
</html>
