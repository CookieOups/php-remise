<?php
// fonction pour afficher les erreurs d'un formulaire
// la variable $errors est un tableau
function afficher_erreurs($errors) {

	// si il y a des erreurs
	if (sizeof($errors) > 0) {
		echo '<ul id="errors_form" style="color:red;text-align:center">';

		// on affiche toutes les erreurs
		foreach($errors as $error) {
			echo '<li>' . $error . '</li>';
		}

		echo '</ul>';
	}
}

// fonction qui vérifie si le visiteur est connecté
function est_connecte() {

	// j'utilise global car je dois accéder à la variable $db pour ma requete
	global $db;

	// je récupère la valeur du cookies
	$cleUnique = $_COOKIE["trendy"];

	// je considère que l'utilisateur n'est pas connecté
	$connecte = false;

	// si il y a un cookies, je vérifie si la clé est associée à un compte
	if (!empty($cleUnique)) {

		try {
			$query = $db->prepare("SELECT * FROM membres WHERE cleUnique = :cle");
			$query->bindParam(':cle', $cleUnique);
			$query->execute();

			// fetch récupère un seul résultat,
			$rows = $query->fetch(PDO::FETCH_ASSOC);
		}
		catch(PDOException $e){
			die('Erreur : '.$e->getMessage());
		}

		// si il y a un résultat, alors le membre existe bien et il est connecté
		if ($rows) {
			$connecte = true;
		}
	}

	return $connecte;
}

// fonction qui vérifie si le visiteur est connecté
function membre_infos() {
	
	// j'utilise global car je dois accéder à la variable $db pour ma requete
	global $db;

	// je récupère la valeur du cookies
	$cleUnique = $_COOKIE["trendy"];

	// je considère que l'utilisateur n'est pas connecté
	$connecte = false;

	// si il y a un cookies, je vérifie si la clé est associée à un compte
	if (!empty($cleUnique)) {

		try {
			$query = $db->prepare("SELECT * FROM membres WHERE cleUnique = :cle");
			$query->bindParam(':cle', $cleUnique);
			$query->execute();

			// fetch récupère un seul résultat,
			$rows = $query->fetch(PDO::FETCH_ASSOC);
		}
		catch(PDOException $e){
			die('Erreur : '.$e->getMessage());
		}
	}

	return $rows;
}

// fonction qui redirige tous ceux qui ne sont pas identifiés comme membres (les visiteurs donc)
function membre_uniquement() {

	// si le visiteur n'est pas connecté, on le redirige vers le formulaire de connexion
	if (!est_connecte()) {
		header("location: become-member.php");
	}
}

function visiteur_uniquement() {

	// si le visiteur est connecté, on le redirige vers la page d'accueil
	if (est_connecte()) {
		header("location: index.php");
	}
}
?>