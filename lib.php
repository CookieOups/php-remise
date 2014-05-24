<?php

function convertDate($date){
	$dateExplode = explode('-', $date);
	// explode découpe $date quand il rencontre - . il renvoie un tableau avec la chaîne découpée
	// donc $dateExplode[0] = Y (année), $dateExplode[1] = m (mois), $dateExplode[2] = d (jour)
	$newDate = $dateExplode[2] . '/' . $dateExplode[1] . '/' . $dateExplode[0];
	// nouvelle date au format fr
	return $newDate; //on renvoie la date
}

?>