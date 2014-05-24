<?php
include_once 'php/connexion_db.php';
?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<meta name="viewport" content="user-scalable=no" />
	<title>Trendy</title>
	<link rel="icon" type="image/png" href="img/favicon.png" />
	  <!--[if IE]><link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico" /><![endif]-->
	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/styles.css">
</head>
<body class="<?php echo empty($bodyClass) ? "profil" : $bodyClass; ?>">

		<header id="header" class="hide">
			
<!-- 			<nav>
				<a class="logo hide" href="index.php"><h1>Trendy</h1></a>
				
				<ul id="menu" class="hide">
			
					<li><a class="astuces" href="index.php">Trend</a></li>
					<li><a class="concours" href="concours.php">Concours</a></li>
					<li><a class="marques" href="about.php">A propos</a></li>
					
				</ul>

				<span id="navBut">Button</span>

				<div id="social" class="social hide">
					<a class="instagram" href="http://instagram.com/trendy_mode0/" target="_blank">Instagram</a>
					<a class="twitter" href="https://twitter.com/Trendy__mode" target="_blank">twitter</a>
					<a class="facebook" href="https://www.facebook.com/trendymode0" target="_blank">facebook</a>
				</div>
			</nav> -->
		</header>

		<div class="content">

			<div class="nav-top">

				<h1><a class="logo-navtop" href="index.php">Trendy</a></h1>

				<div class="filter">
					<ul class="menu-nav">
						<li class="menu-hide">
							<a href="index-populaire.php">Populaires</a>		
						</li>
						<li class="menu-hide">
							<a href="index-recente.php">Récentes</a>		
						</li>
					
						<li class="dropdown menu-hide">
							<a href="#" data-toggle="dropdown">Catégories <i class="icon-arrow"></i></a>
							      <ul class="dropdown-menu">
							        <li><a href="index-mode.php">Mode</a></li>
							        <li><a href="index-beaute.php">Beauté</a></li>
							        <li><a href="index-coiffure.php">Coiffure</a></li>
							        <li><a href="index-nail.php">Nail Art</a></li>
							      </ul><!--dropdown menu-->
						</li>
					</ul><!--end menu-nav-->
					<div class="nav-right">
						<ul class="icons">
							<li>
								<form>
									<span class="cover-box">
									<input class="search bottom" type="search" placeholder="Ce que tu cherches" id="the_search" name="the_search">
									</span>
									<label for="the_search" class="iseeyou"></label>
								</form><!--end search-->
							</li>
							<li class="concours-nav"><a href="concours.php">Concours</a></li>
							<li class="profile"><a href="profil.php">Profil</a></li>
<?php
if (est_connecte()) {
	echo '<li class="inscription"><a href="deconnexion.php">Déconnexion</a></li>';
}
else {
	echo '<li class="inscription"><a href="inscription.php">Inscription</a></li>';
}
?>
						</ul><!--end icons-->
					</div><!--end nav-right-->

				</div><!-- end FILTER -->

			</div> <!-- end NAV TOP -->