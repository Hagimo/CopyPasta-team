<!DOCTYPE HTML>
<?php
    session_start();
	$_SESSION['www']= 'revize';
	 if (isset($_SESSION['user'])) {
	 	if ($_SESSION['type'] != "redaktor" && $_SESSION['type'] != "admin") {
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
	
	$file = "";
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if(isset($_POST['Id'])){
			$Id = $_POST['Id'];
		}
		if(isset($_POST['Stahnout'])){
			
			$sql="UPDATE article SET Revize='1' WHERE Article_id='$Id'";
			mysqli_query($con,$sql);
			$sql="SELECT Name FROM article WHERE Article_id='$Id'";
			mysqli_query($con,$sql);
			$result=mysqli_query($con,$sql);
			$count=mysqli_num_rows($result);
			$arr = mysqli_fetch_assoc($result);
			$file = $arr["Name"];
			header('Content-Description: File Transfer');
    		header('Content-Type: application/octet-stream');
   			header('Content-Disposition: attachment; filename="'.basename($file).'"');
   		 	header('Expires: 0');
    		header('Cache-Control: must-revalidate');
    		header('Pragma: public');
    		header('Content-Length: ' . filesize($file));
    		readfile($file);
    		
		}
		if(isset($_POST['Potvrdít'])){
			$sql="UPDATE article SET Revize='2' WHERE Article_id='$Id'";
			mysqli_query($con,$sql);
		}
		if(isset($_POST['Nepotvrdit'])){
			$sql="UPDATE article SET Revize='3' WHERE Article_id='$Id'";
			mysqli_query($con,$sql);
		}
		if(isset($_POST['Editace'])){
			$sql="UPDATE article SET Revize='0' WHERE Article_id='$Id'";
			mysqli_query($con,$sql);
		}
	}
	
	

	include('topMenu.php');
	?> 
    <div id="wrapper">
    <?php
	
	
	$sql="SELECT * FROM article";
	$result=mysqli_query($con,$sql);
	$count=mysqli_num_rows($result);
	if (isset($_SESSION['user'])) {
		  echo '<div class="Main-card">';
			echo '<h2>Nepotvrzené přispjevky</h2>';
			echo '<table align="center">';
			echo '<tr>';
			echo ' <th class="tbltop">Autor</th>';
			echo ' <th class="tbltop">Titul</th>';
			echo ' <th class="tbltop">Téma</th>';
			echo ' <th class="tbltop">Komentař</th>';
			echo ' <th class="tbltop">Spracováva se</th>';
			echo ' <th class="tbltop">Potvrdít</th>';
			echo ' <th class="tbltop">Nepotvrdit</th>';
			echo ' </tr>';
			  while ($row = mysqli_fetch_assoc($result)) {
				  if($row["Revize"] <= 1)
				  {
				  echo '<tr>';
				  echo '<th>'.$row["Nick"].'</th>';
				  echo '<th>'.$row["Titule"].'</th>';
				  echo '<th>'.$row["Tema"].'</th>';
				  echo '<th>'.$row["Comment"].'</th>';
				  echo '<form method="post" action=" '. htmlspecialchars($_SERVER["PHP_SELF"]).' ">';
				  echo '<input type="hidden" name="Id" value="'.$row["Article_id"].'">';
				  echo '<th><input type="submit" class="login table-submit" name="Stahnout" value="Stahnout"></th>';
				  echo '<th><input type="submit" class="login table-submit" name="Potvrdít" value="Potvrdít"></th>';
				  echo '<th><input type="submit" class="login table-submit" name="Nepotvrdit" value="Nepotvrdit"></th>';
				  echo '</form>';
				  echo ' </tr>';
				  }
			  }
			echo '</table>';
		echo '</div>';
		$result=mysqli_query($con,$sql);
		 echo '<div class="Main-card">';
			echo '<h2>Spracované přispjevky</h2>';
			echo '<table align="center">';
			echo '<tr>';
			echo ' <th class="tbltop">Autor</th>';
			echo ' <th class="tbltop">Titul</th>';
			echo ' <th class="tbltop">Téma</th>';
			echo ' <th class="tbltop">Komentař</th>';
			echo ' <th class="tbltop">Status</th>';
			echo ' <th class="tbltop">Editace</th>';
			echo ' </tr>';
			  while ($row = mysqli_fetch_assoc($result)) {
				  if($row["Revize"] >= 2)
				  {
				  echo '<tr>';
				  echo '<th>'.$row["Nick"].'</th>';
				  echo '<th>'.$row["Titule"].'</th>';
				  echo '<th>'.$row["Tema"].'</th>';
				  echo '<th>'.$row["Comment"].'</th>';
				  echo '<th>';
				  switch($row["Revize"])
				  {
					  case 2:
					  echo 'potvrzeno';
					  break;
					  case 3:
					  echo 'zamitnuto';
					  break;
				  }
				  echo '</th>';
				  echo '<form method="post" action=" '. htmlspecialchars($_SERVER["PHP_SELF"]).' ">';
				  echo '<input type="hidden" name="Id" value="'.$row["Article_id"].'">';
				  echo '<th><input type="submit" class="login table-submit" name="Editace" value="Editace"></th>';
				  echo '</form>';
				  echo ' </tr>';
				  }
			  }
			echo '</table>';
		echo '</div>';
		
	}
    ?>
</div>
 <?php
	include('bottom.php');
	?> 
	</body>
</html>
