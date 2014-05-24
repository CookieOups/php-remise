<?php
include_once "php/connexion_db.php";

visiteur_uniquement();

$inscription_terminee = false;

if($_POST)	{
	
	
	extract($_POST);

	// $errors est un tableau qui va contenir toutes les erreurs
	$errors = array();
	$motif="#[^a-zA-Z' ]#";
	
	
	// On supprime les espaces vides avant et après la valeur des champs
	$username = trim($username);
	$mail = trim($mail);

	// Si le nom d'utilisateur est vide
	if (empty($username))  {
		// Alors on l'ajoute dans le tableau $errors
		$errors[] = "Donne nous un pseudo, stp !";
	}
	// Sinon si le nom d'utilisateur contient des caractères interdits
	elseif (preg_match($motif,$username)) {
		$errors[] = "Ton nom d'utilisateur ne doit contenir que des lettres, espaces ou apostrophes.";
	}

	// Si le mot de passe est vide
	if (empty($password1))  {
		$errors[] = "Ecris un mot de passe, stp !";
	}
	// Si le mot de passe de confirmation est vide
	if (empty($password2))  {
		$errors[] = "Retape ton mot de passe.";
	}
	// Si les mots de passes ne sont pas vides et sont différents
	if(!empty($password1) && !empty($password2) && $password1 != $password2) {
		$errors[] = "Tes mots de passe sont différents.";
	}
	// Si l'email est vide
	if (empty($mail))  {
		$errors[] = "Donne nous une addesse email, stp!";
	}
	// Sinon si l'email est incorrect
	elseif(!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
		$errors[] = "Ton adresse email n'est pas correcte.";
	}
	
	// sizof compte le nombre d'éléments dans le tableau $errors
	// si sizeof retourne 0, il n'y a pas d'erreur
	if (sizeof($errors) == 0) {

		// on vérifie si le nom d'utilisateur est déjà utilisé
		try {
			$query = $db->prepare("SELECT * FROM membres WHERE pseudo = :username");
			$query->bindParam(':username', $username);
			$query->execute();

			// fetch récupère un seul résultat
			$rows = $query->fetch(PDO::FETCH_ASSOC);
		}
		catch(PDOException $e){
			die('Erreur : '.$e->getMessage());
		}

		// fetch() renvoie true si il y a un résultat
		// fetch() renvoie false si il y n'a pas de résultat
		// exemple: if ($rows) ====> un résultat
		// exemple: if ($rows == true) ====> un résultat
		// exemple: if (!$rows) ====> pas de résultat
		// exemple: if ($rows == false) ====> pas de résultat
		if ($rows) {
			$errors[] = "Ce pseudo est déjà enregistré !";
		}
		
	}

	if (sizeof($errors) == 0) {

		// on vérifie si l'adresse email est déjà utilisée
		try{
			$query = $db->prepare("SELECT * FROM membres WHERE email = :mail");
			$query->bindParam(':mail', $mail);
			$query->execute();
			$rows = $query->fetch(PDO::FETCH_ASSOC);
		}
		catch(PDOException $e){
			die('Erreur : '.$e->getMessage());
		}

		if ($rows) {
			$errors[] = "Cette adresse email est déjà enregistrée !";
		}
		
	}

	if (sizeof($errors) == 0) {

		// on inscrit le membre dans la base de données
		try{
			$dateInscription = date('Y-m-d');
			$password_crypte = sha1($password1);

			$query = $db->prepare('INSERT INTO membres (pseudo,motdepasse,email,dateInscription) VALUES (:username,:password,:mail,:dateInscription)');
			$query->bindParam(':username', $username);
			$query->bindParam(':password', $password_crypte);
			$query->bindParam(':mail', $mail);
			$query->bindParam(':dateInscription', $dateInscription);
			$query->execute();






			$sujet = "Bienvenue !";

			$message = "";
			$message .= "Bonjour $username,

Merci de ton inscription sur Trendy !

Grâce à ton inscription sur Trendy tu peux maintenant, en plus de consulter toutes nos astuces, te crééer un profil complet sur lequel tu peux ajouter tes astuces préférées à tes favoris. 
Mais si tu as des astuces que tu aimerais partager, tu le peux maintenant via ton profil !

Tu peux donc maintenant pleinement profiter de Trendy donc amuse toi $username !

Bonne journée !";


			$headers ='From: '.$mail." "; // ici l'expediteur du mail
			$headers .='Reply-To: trendymode0@gmail.com'." "; // ici l'adresse de réponse (facultatif)
			$headers .='Content-Type: text/plain; charset="utf-8"'." "; // ici on envoie le mail au format texte encodé en UTF-8
			$headers .='Content-Transfer-Encoding: 8bit'; //ww ici on précise qu'il y a des caractères accentués

			$mail_envoye = @mail($mail, $sujet, $message, $headers);

			if (!$mail_envoye) {
				$errors[] = "Une erreur s'est produite, le mail n'a malheureusement pas pu être envoyé. Veux-tu bien réessayer ?";
			}
			else {
			$inscription_terminee = true;
			}
		}
		catch(PDOException $e){
			echo 'Erreur : '.$e->getMessage();
		}

	}
}

include 'inc/header.php';
?>

			<div class="cover-2"></div>


			<div class="container">
<?php
// permet de savoir si l'utilisateur vient de s'inscrire
if ($inscription_terminee) {
?>
				<h2>Inscription terminée !</h2>
				<div class="become-member">
					<p class="big">Bienvenue dans la communauté Trendy !</p>
					<p>Tu peux maintenant te <a href="connexion.php">connecter</a>  et ajouter tes astuces!</p>
				</div>
<?php
}
else {
?>
				<h2 class="bottom">Inscris toi et rejoins la communauté Trendy !</h2>

				<form id="ajout-form" method="post" action="inscription.php">

<?php
// si le formulaire est posté, on affiche les erreurs (si il y en a)
if ($_POST) {
	afficher_erreurs($errors);
}
?>

<!-- 					<div class="champ">
						<input type="text" name="name" id="name" placeholder="Ton nom" value="<?php echo $name; ?>">
					</div> -->


					<div class="champs">
						<input type="text" name="username" id="username" placeholder="Ton nom d'utilisateur" value="<?php echo $username; ?>">
					</div>

					<div class="champs">
						<input type="password" name="password1" id="password1" placeholder="Ton mot de passe" value="<?php echo $password1; ?>">
					</div>

					<div class="champs">
						<input type="password" name="password2" id="password2" placeholder="Retape ton mot de passe" value="<?php echo $password2; ?>">
					</div>

					<div class="champs">
						<input type="text" name="mail" id="mail" placeholder="Ton adresse email" value="<?php echo $mail; ?>">
					</div>

					<p>Déjà inscrite ? Alors <a href="connexion.php">connecte-toi</a>!</p>

					<div class="submit">				
						<input type="submit" value="Propose tes astuces !">
					</div>
				</form>
<?php
}
?>



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