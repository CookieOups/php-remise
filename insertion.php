<?php

// connexion
require 'connexion.php';
// suite
echo "<br>suite<br>";

$nom='toto';
$prenom='albert';

try{
		$sql="insert into membres(name,username,password,mail) values('$name','$username','$password','$mail')";
	//	echo $sql;
		$count=$db->exec($sql);
		echo "Nbre : ".$count;
	}
catch(PDOException $e)
	{
		echo 'Erreur : '.$e->getMessage();
	}

?>
