<style>
#tab1{
	background-color:yellow;
	border-collapse:collapse;	
}
#tab1 td{
	padding:10px;
}

#tab2{
	background-color:green;
	border-collapse:collapse;	
}
#tab2 td{
	padding:3px;
}

</style>
<?php

// connexion
include 'connexion.php';

/*function array_to_html($tab){
	$txt="<table border=1 id='tab2'>";
	foreach($tab as $valeur){
		$txt.="<tr>";
		foreach($valeur as $ligne){
			$txt.= "<td>".$ligne."</td>";
		}
		$txt.="</tr>";
	}
	$txt.="</table>";
	return $txt;
}*/
function convertDate($date){
	$dateExplode = explode('-', $date);
	// explode découpe $date quand il rencontre - . il renvoie un tableau avec la chaîne découpée
	// donc $dateExplode[0] = Y (année), $dateExplode[1] = m (mois), $dateExplode[2] = d (jour)
	$newDate = $dateExplode[2] . '/' . $dateExplode[1] . '/' . $dateExplode[0];
	// nouvelle date au format fr
	return $newDate; //on renvoie la date
}
try{
		$sql="select * from membres";
		$res=$db->query($sql); 	// un objet();
		$getInfos = $res -> fetchAll();
		// $tab est un tableau a DEUX dimensions !!!
		// $tab=$res->fetchAll(PDO::FETCH_ASSOC);	// creation d'un tableau avec les donnes ds $res
		// alternative à foreach ds foreach
		echo '<table border="1">
		<tr>
			<th>Name</th>
			<th>Username</th>
			<th>Password</th>
			<th>mail</th>
			<th>Supprimer</th>
		</tr>
		';
		foreach($getInfos as $row){
			$date = convertDate($row['date']);
			echo '
			<tr>
				<td>' . $row['name'] . '</td>
				<td>' . $row['username'] . '</td>
				<td>' . $row['password'] . '</td>
				<td>' . $row['mail'] . '</td>
				<td>' . $date . '</td>
				<td><a href="delete.php?id=' . $row['id'] .'">[Supprimer]</a></td>
			</tr>';

		}
		echo '</table>';
		
	}
catch(PDOException $e)
	{
		echo 'Erreur : '.$e->getMessage();
	}

?>
