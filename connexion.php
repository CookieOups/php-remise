<?php
include_once "php/connexion_db.php";

visiteur_uniquement();

if($_POST)	{
	
	
	extract($_POST);

	// $errors est un tableau qui va contenir toutes les erreurs
	$errors = array();
	
	// On supprime les espaces vides avant et après la valeur des champs
	$username = trim($username);

	// Si le nom d'utilisateur est vide
	if (empty($username) || empty($password))  {
		$errors[] = "Veuillez entrer vos identifiants de connexion.";
	}
	
	// sizof compte le nombre d'éléments dans le tableau $errors
	// si sizeof retourne zéro, alors il n'y a pas d'erreur
	if (sizeof($errors) == 0) {

		// on essaye d'effectuer le code entre try { }
		try {
			$query = $db->prepare("SELECT * FROM membres WHERE pseudo = :username");
			$query->bindParam(':username', $username);
			$query->execute();

			// fetch récupère un seul résultat,
			// contraitement à fetchAll qui peut en récupérer plusieurs
			$rows = $query->fetch(PDO::FETCH_ASSOC);
		}
		// si il y a une erreur qui se produit, on la récupère avec le catch
		catch(PDOException $e){
			die('Erreur : '.$e->getMessage());
		}

		// fetch() renvoie true si il y a un résultat
		// fetch() renvoie false si il y n'a pas de résultat
		// exemple: if ($rows) ====> un résultat
		// exemple: if ($rows == true) ====> un résultat
		// exemple: if (!$rows) ====> pas de résultat
		// exemple: if ($rows == false) ====> pas de résultat
		if ($rows == false) {
			$errors[] = "Aucun compte ne correspond à ce nom d'utilisateur.";
		}
		// on vérifie les mots de passes
		elseif (sha1($password) != $rows["motdepasse"]) {
			$errors[] = "Mot de passe incorrect.";
		}
		else {

			// génère une clé unique qui permettra d'identifier le visiteur grâce au cookie
			$cleUnique = sha1(uniqid(rand(), true));

			// on enregistre la clé unique dans la base de donnée, pour ce membre uniquement
			$query = $db->prepare("UPDATE membres SET cleUnique = :cle WHERE pseudo = :username");
			$query->bindParam(':cle', $cleUnique);
			$query->bindParam(':username', $username);
			$query->execute();

			// on crée le cookies et on stock la clé unique qui permettra d'identifier le visiteur
            setcookie('trendy', $cleUnique, time()+60*60*24*365, '/');

            header("location:profil.php");
            exit();
		}
		
	}
}

include_once 'inc/header.php';
?>

			<div class="cover-2"></div>


			<div class="container">

				<h2 class="bottom">Connecte toi et propose tes astuces !</h2>

				<form id="ajout-form" method="post" action="#" enctype="multipart/form-data">	

<?php
// si le formulaire est posté, on affiche les erreurs (si il y en a)
if ($_POST) {
	afficher_erreurs($errors);
}
?>

					<div class="champs">
						<input type="text" name="username" id="username" placeholder="Ton nom d'utilisateur" value="<?php echo $username; ?>">
					</div>

					<div class="champs">
						<input type="password" name="password" id="password" placeholder="Ton mot de passe" value="<?php echo $password; ?>">
					</div>

					<div class="submit">				
						<input type="submit" value="Je me connecte !">
					</div>
				</form>

			</div><!-- end container -->

			<footer class="footer-top">

				<p class="copyright">&copy; Fait avec amour par Amandine Clerc</a></p>

				<div id="social" class="social">
						<a class="instagram" href="http://instagram.com/trendy_mode0/" target="_blank">Instagram</a>
						<a class="twitter" href="https://twitter.com/Trendy__mode" target="_blank">twitter</a>
						<a class="facebook" href="https://www.facebook.com/trendymode0" target="_blank">facebook</a>
				</div>

				<p><a class="footer-about" href="about.php">A propos de Trendy</a></p>

			</footer>

		</div><!-- end content -->


	<script>

		var navBut = document.getElementById("navBut");
		var header = document.getElementById("header");
		var menu = document.getElementById("menu");
		var logo = document.getElementsByClassName("logo")[0];
		var content = document.getElementsByClassName("content")[0];
		var social = document.getElementsByClassName("social")[0];
		var show = true;

		function showMenu(){

			if(show == true){

				show = false;

				header.className = "";
				menu.className = "";
				social.className = "";
				logo.classList.remove("hide");
				content.classList.add("move");
				social.classList.remove("hide");
			}

			else{

				show = true;

				header.className = "hide";
				menu.className = "hide";
				social.className = "hide";
				logo.classList.add("hide");
				social.classList.add("hide");
				content.classList.remove("move");

			}

		};

		function showMenu(){

			if(show == true){

				show = false;

				header.className = "";
				menu.className = "";
				social.className = "";
				logo.classList.remove("hide");
				content.classList.add("onmousehover");
				social.classList.remove("hide");
			}

			else{

				show = true;

				header.className = "hide";
				menu.className = "hide";
				social.className = "hide";
				logo.classList.add("hide");
				social.classList.add("hide");
				content.classList.remove("onmousehover");

			}

		};

		header.addEventListener("mouseover",showMenu,false);
		header.addEventListener("mouseout",showMenu,true);

		header.addEventListener("click",showMenu,false);

		//http://codepen.io/Metty/pen/dglwH CREDITER 
		// Dropdown Menu
		var dropdown = document.querySelectorAll('.dropdown');
		var dropdownArray = Array.prototype.slice.call(dropdown,0);
		dropdownArray.forEach(function(el){
			var button = el.querySelector('a[data-toggle="dropdown"]'),
					menu = el.querySelector('.dropdown-menu'),
					arrow = button.querySelector('i.icon-arrow');

			button.onclick = function(event) {
				if(!menu.hasClass('show')) {
					menu.classList.add('show');
					menu.classList.remove('hide');
					arrow.classList.add('open');
					arrow.classList.remove('close');
					event.preventDefault();
				}
				else {
					menu.classList.remove('show');
					menu.classList.add('hide');
					arrow.classList.remove('open');
					arrow.classList.add('close');
					event.preventDefault();
				}
			};
		})

		Element.prototype.hasClass = function(className) {
		    return this.className && new RegExp("(^|\\s)" + className + "(\\s|$)").test(this.className);
		};


	</script>
	
</body>
</html>