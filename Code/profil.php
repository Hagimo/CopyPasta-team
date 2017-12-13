<!DOCTYPE HTML>
<?php
    session_start();
    $_SESSION['www']= 'profil';
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
</div>
 <?php
	include('bottom.php');
	?> 
	</body>
</html>
