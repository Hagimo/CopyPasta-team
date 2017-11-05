<!DOCTYPE HTML>
<?php
    session_start();
?>
<html lang="cs">
	<head>
    <link rel="stylesheet" type="text/css" href="css/mystyle.css">
	</head>
	<body>
	<ul class="topul">
    	<li><a href="Index.php" class="Title1">LOGOS</a></li>
        <li><a href="Index.php" class="Title2">POLYTECHNIKOS</a></li>
          <?php
		  if (!isset($_SESSION['user'])) {
			  echo '<li style="float:right" ><a href="login.php" class="btn">login</a></li>';
			  echo '<li style="float:right"><a href="register.php" class="btn">register</a></li>';
		  }
		  else
		  {
			  echo '<li style="float:right" ><a href="logout.php" class="btn">' .$_SESSION['user']. '</a></li>';
		  }
        ?>
	</ul>
	<ul>
	  <li><a href="Index.php" class="active hav pic"><img border="0" alt="Home" src="images/home-red.png" width="30" height="30"></a></li>
		<li><a href="casopisy.php" class="hav">Čísla časopisu</a></li>
		<li style="float:right" ><a href="about.php" class="hav">Napište nám</a></li>
		<li style="float:right" ><a href="revize.php" class="hav">Revize <u class="NotifNum">0</u></a></li>
	</ul>
	</body>
</html>
