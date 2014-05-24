<?php
session_start();

// Rapporte toutes les erreurs à part les E_NOTICE
error_reporting(E_ALL ^ E_NOTICE);

function connexion() {
	// mysql hostname
	$hostname ="localhost";
	// mysql username
	$username = "amandineclerc";
	//mysql password
	$password = "qd2zetSEBVdZcX9i";

	try {
		
		$db = new PDO("mysql:host=$hostname;dbname=amandineclerc", $username,$password);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$db->exec('SET NAMES utf8');
		return $db;
	}

	catch(PDOException $e) {
		
		die("erreur : ".$e->getMessage());
	}
}

$db = connexion();

include("fonctions.php");
?>
