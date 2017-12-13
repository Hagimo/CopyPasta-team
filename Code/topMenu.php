<?php
echo '<div id="pagetop">';
	echo '<ul class="topul" id="topul">';
 	echo '<li><a href="Index.php" class="Title1">LOGOS</a></li>';
 	echo '<li><a href="Index.php" class="Title2">POLYTECHNIKOS</a></li>';
		   if (!isset($_SESSION['user'])) {
			  echo '<li style="float:right" ><a href="login.php" class="btn">login</a></li>';
			  echo '<li style="float:right"><a href="register.php" class="btn">register</a></li>';
		  }
		  else
		  {
			  echo '<li style="float:right" class="dropdown" ><button class="dropbtn">' .$_SESSION['user']. '</button><div class="dropdown-content"><a href="prispevky.php" class="dropmenu">Seznam píspěvků</a><a href="logout.php" class="dropmenu">Odhlasit</a></div></li>';
			  echo '<li style="float:right"><a href="pridani.php" class="btn pic"><img border="0" alt="Home" src="images/article-black.png" width="20" height="20"></a></li>';
		  }
        
	echo '</ul>';
	echo '<ul>';
	if($_SESSION['www'] == 'index'){echo '<li><a href="Index.php" class="active hav pic"><img border="0" alt="Home" src="images/home-red.png" width="30" height="30"></a></li>';}
	else{echo '<li><a href="Index.php" class="hav pic"><img border="0" alt="Home" src="images/home-blue.png" width="30" height="30"></a></li>';}
		if($_SESSION['www'] == 'casopisy'){echo '<li><a href="casopisy.php" class="active hav">Čísla časopisu</a></li>';}
		else{echo '<li><a href="casopisy.php" class="hav">Čísla časopisu</a></li>';}
		 if (isset($_SESSION['user']) && isset($_SESSION['type'])) {
			    if ($_SESSION['type'] == "admin") {
					if($_SESSION['www'] == 'admin'){echo '<li style="float:right" ><a href="admin.php" class="active hav">Administrační panel</a></li>';}
				    else{echo '<li style="float:right" ><a href="admin.php" class="hav">Administrační panel</a></li>';}
				}
		 }
		if($_SESSION['www'] == 'about'){echo '<li style="float:right" ><a href="about.php" class="active hav">Informace</a></li>';}
		else{echo '<li style="float:right" ><a href="about.php" class="hav">Informace</a></li>';}
		   if (isset($_SESSION['user']) && isset($_SESSION['type'])) {
			    if ($_SESSION['type'] == "redaktor" || $_SESSION['type'] == "admin") {
				   include('connect.php');
				   $sql="SELECT * FROM article";
				   $result=mysqli_query($con,$sql);
				   $count = 0;
				   while ($row = mysqli_fetch_assoc($result)) {
					if($row["Revize"] <= 1)
					  {
						$count++;
					  }
				   }
				   if($_SESSION['www'] == 'revize'){echo '<li style="float:right" ><a href="revize.php" class="active hav">Revize <u class="NotifNum">'.$count.'</u></a></li>';}
				   else{echo '<li style="float:right" ><a href="revize.php" class="hav">Revize <u class="NotifNum">'.$count.'</u></a></li>';}
			   		if($_SESSION['www'] == 'pidaniCasopisu'){echo '<li style="float:right" ><a href="pidaniCasopisu.php" class="active hav">Přidání časopisu</a></li>';}
				   else{echo '<li style="float:right" ><a href="pidaniCasopisu.php" class="hav">Přidání časopisu</a></li>';}
			   }
		   }
       echo '</ul>';
    echo '</div>';
    ?>