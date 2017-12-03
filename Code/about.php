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
        <div class="Main-card-large">
<p >
LOGOS POLYTECHNIKOS je vysokoškolský odborný recenzovaný časopis, který slouží pro publikační aktivity akademických pracovníků Vysoké školy polytechnické Jihlava i jiných vysokých škol, univerzit a výzkumných organizací. Je veden na Seznamu recenzovaných neimpaktovaných periodik vydávaných v ČR (http://www.vyzkum.cz/FrontClanek.aspx?idsekce=733439) a na seznamu recenzovaných odborných a vědeckých časopisů 
<br>
<br>ERIH PLUS - European Reference Index for the Humanities and the Social Sciences (https://dbh.nsd.uib.no/publiseringskanaler/erihplus/periodical/info?id=488187).
Časopis je vydáván od roku 2010 a vychází čtyřikrát ročně. Redakční rada časopisu sestává z interních i externích odborníků. Funkci šéfredaktora zastává prorektor pro tvůrčí činnost Vysoké školy polytechnické Jihlava. Funkce odpovědných redaktorů jednotlivých čísel přísluší vedoucím kateder Vysoké školy polytechnické Jihlava. Veškeré vydávané příspěvky prochází recenzním řízením a jsou pečlivě redigovány. 
<br>
<br>
Tematické a obsahové zaměření časopisu, především na obory sociálně-ekonomické, zdravotnické a technické, reflektuje potřeby oborových kateder Vysoké školy polytechnické Jihlava. Na základě souhlasu odpovědného redaktora mohou katedry poskytnout publikační prostor i odborníkům bez zaměstnanecké vazby k Vysoké škole polytechnické Jihlava.	
</p>
	</div>
    <div class="Main-card-large">
<h2>Šéfredaktor</h2>
<p>doc. Dr. Ing. Jan Voráček, CSc. (Vysoká škola polytechnická Jihlava) <a href="mailto:vspj@vspj.cz">Email</a> </p>

<h3>Redakční rada</h3>
<p>doc. PhDr. Ladislav Benyovszky, CSc. (Univerzita Karlova v Praze)    <a href="mailto:vspj@vspj.cz">Email</a> <br />
prof. PhDr. Ivan Blecha, CSc. (Univerzita Palackého v Olomouci)     <a href="mailto:vspj@vspj.cz">Email</a> <br /> 
doc. RNDr. Helena Brožová, CSc. (Česká zemědělská univerzita v Praze)  <a href="mailto:vspj@vspj.cz">Email</a> <br />
doc. Mgr. Ing. Martin Dlouhý, Dr. (Vysoká škola ekonomická v Praze)    <a href="mailto:vspj@vspj.cz">Email</a> <br />
prof. Ing. Tomáš Dostál, DrSc. (Vysoké učení technické v Brně)    <a href="mailto:vspj@vspj.cz">Email</a> <br />
Ing. Jiří Dušek, Ph.D. (Vysoká škola evropských a regionálních studií)     <a href="mailto:vspj@vspj.cz">Email</a> <br /> 
Ing. Veronika Hedija, Ph.D. (Vysoká škola polytechnická Jihlava)     <a href="mailto:vspj@vspj.cz">Email</a> <br />
doc. PhDr. Martin Hemelík, CSc. (Univerzita Karlova v Praze)     <a href="mailto:vspj@vspj.cz">Email</a> <br />
prof. RNDr. Ivan Holoubek, CSc. (Masarykova univerzita)     <a href="mailto:vspj@vspj.cz">Email</a> <br />
Mgr. Petr Chládek, Ph.D. (Vysoká škola technická a ekonomická a Českých Budějovicích)     <a href="mailto:vspj@vspj.cz">Email</a> <br />
prof. PhDr. Ivo Jirásek, Ph.D. (Univerzita Palackého v Olomouci)      <a href="mailto:vspj@vspj.cz">Email</a> <br />
prof. Ing. Bohumil Minařík, CSc. (Vysoká škola polytechnická Jihlava)      <a href="mailto:vspj@vspj.cz">Email</a> <br />
doc. PhDr. Ján Pavlík (Vysoká škola ekonomická v Praze)      <a href="mailto:vspj@vspj.cz">Email</a> <br />
doc. PhDr. Karel Pstružina, CSc. (Vysoká škola ekonomická v Praze)     <a href="mailto:vspj@vspj.cz">Email</a> <br />
prof. MUDr. Aleš Roztočil, CSc. (Vysoká škola polytechnická Jihlava)       <a href="mailto:vspj@vspj.cz">Email</a> <br />
prof. Ing. Jan Váchal, CSc. (Vysoká škola technická e ekonomická v Českých Budějovicích)      <a href="mailto:vspj@vspj.cz">Email</a> <br />
doc. Ing. Libor Žídek, Ph.D (Masarykova univerzita v Brně)        <a href="mailto:vspj@vspj.cz">Email</a> </p>
</div>
</div>
	
	
	
	
	
	
	
	
	
	
	</body>
</html>
