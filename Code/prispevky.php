<!DOCTYPE HTML>
<?php
    session_start();
    $_SESSION['www']= 'prispevky';
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
	include('topMenu.php');
	?> 
    <div id="wrapper">
    <?php
	
	include('connect.php');
	if (isset($_SESSION['user'])) {
	  $name = $_SESSION['user'];
	  $sql="SELECT Titule,Revize FROM article WHERE Nick='$name'";
	  $result=mysqli_query($con,$sql);
	  $count=mysqli_num_rows($result);
	  if($count > 0)
	  {
	   echo '<div class="Main-card">';
			echo '<h2>Aktualní přispěvky</h2>';
			echo '<table align="center">';
			echo '<tr>';
			echo ' <th class="tbltop">Titul</th>';
			echo ' <th class="tbltop">potvrzení</th>';
			echo ' </tr>';
			  while ($row = mysqli_fetch_assoc($result)) {
				  echo '<tr>';
				  echo '<th>'.$row["Titule"].'</th>';
    			  echo '<th>';
				  switch($row["Revize"])
				  {
					  case 0:
					  echo 'čeká na revizi';
					  break;
					  case 1:
					  echo 'v revizi';
					  break;
					  case 2:
					  echo 'potvrzeno';
					  break;
					  case 3:
					  echo 'zamitnuto';
					  break;
				  }
				  echo '</th>';
				  echo ' </tr>';
			  }
			echo '</table>';
		echo '</div>';
		echo '<div class="Main-card">';
			echo '<h2>Historie přispěvků</h2>';
			echo '<table align="center">';
			echo '<tr>';
			 echo '<th class="tbltop">Titul</th>';
			echo '<th class="tbltop">status</th>';
			echo '</tr>';
			  while ($row = mysqli_fetch_assoc($result)) {
				  if($row["Revize"] >= 4)
			 	 {
				  echo '<tr>';
				  echo '<th>'.$row["Titule"].'</th>';
    			  echo '<th>';
				  switch($row["Revize"])
				  {
					  case 4:
					  echo 'potvrzeno';
					  break;
					  case 5:
					  echo 'zamitnuto';
					  break;
				  }
				  echo '</th>';
				  echo ' </tr>';
			 	 }
			  }
			
			echo '</table>';
		echo '</div>';
	  }
	  else
	  {
		    echo '<div class="Main-card">';
			echo '<h2>Nemáte žádné přispěvky</h2>';
			echo '<h3>klikněte na <a href="pridani.php"><img border="0" alt="Home" src="images/article-black.png" width="20" height="20"></a> pokud chcete přidat noví přispěvek </h3>';
			echo '</div>';
	  }
	}
    ?>
</div>
 <?php
	include('bottom.php');
	?> 
	</body>
</html>
