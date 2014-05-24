<html>
<head>
	<title></title>
</head>
<meta charset="utf-8" />
<body>

<?php

	if($_POST)	{
		
		
		extract($_POST);
		$erreur=0;
		$msg="";
		$motif="#[^a-zA-Z' ]#";
		$motifb="#^ #"; //est ce que ça debute parle blanc
		$motifc="# $#"; // finit par le blanc
		$motif="#[^a-zA-Z' ]#";
		$motife = "#[^0-9]#";
		$motif="#@|%|t|e#i";
		
		if($name == "" || $username == ""||$password ==""||$mail =="")  {
					
			$erreur = 1;
		}
		
		
		if(preg_match($motif,$name)||preg_match($motifb,$name)||preg_match($motifc,$name)) {
			
			$erreur = 1;
		}
		
		if(preg_match($motif,$username)||preg_match($motifb,$username)||preg_match($motifc,$username)) {
			
			$erreur = 1;
		}
		
		if(preg_match($motif,$mail)||preg_match($motifb,$mail)||preg_match($motifc,$mail)) {
			
			$erreur = 1;
		}
		
		
		if($erreur==1) {
			
			echo "Il y a une erreur"; echo '</br>';
			if($name =="") {
				
				$msg.="le nom est vide </br>";
				
			}
			if($username =="") {
				
				$msg.="le nom d'utilisateur est vide </br>";
			}
			
			
			
			if($password =="") {
				
				$msg.="le mot de passe est vide </br>";
			}
			
			if($mail =="") {
				
				$msg.="Le mail est vide </br>";
			}
			
			
			echo $msg; echo '</br>';
			echo "<a href='inscription.php'>Retour au formulaire</a>";
		}
		else {

			 "Votre formulaire a bien été rempli </br>";
			echo "<pre>";
			
			print_r($_POST);
			
			echo "</pre>";
			include "connexion.php";
		
			try{
				$date = date('Y-m-d');
				$sql="insert into membres(name,username,password,mail,date) values('$name','$username','$password','$mail','$postal','$date')";
				$count=$db->exec($sql);
				
				echo "<hr>";

				include('liste.php');
				}
			catch(PDOException $e){
			echo 'Erreur : '.$e->getMessage();
			}

		}		
	}
?>


</body>
</html>