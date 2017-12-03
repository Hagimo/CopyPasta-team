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
			  echo '<li style="float:right"><a href="pridani.php" class="btn pic"><img border="0" alt="Home" src="images/article-black.png" width="20" height="20"></a></li>';
		  }
        	?>
	</ul>
	<ul>
	  <li><a href="Index.php" class="hav pic"><img border="0" alt="Home" src="images/home-blue.png" width="30" height="30"></a></li>
		<li><a href="casopisy.php" class="hav">Čísla časopisu</a></li>
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
    <?php
	
	$con=mysqli_connect('localhost','root','') or die(mysql_error());
	mysqli_select_db($con,'polytech');
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
	</body>
</html>
