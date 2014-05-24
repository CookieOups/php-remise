<?php
header('Content-Type: text/html; charset=utf-8');
session_start();

// Rapporte toutes les erreurs à part les E_NOTICE
error_reporting(E_ALL ^ E_NOTICE);

function connexion() {
	// mysql hostname
	$hostname ="localhost";
	// mysql username
	$username = "root";
	//mysql password
	$password = "";

	try {
		
		$db = new PDO("mysql:host=$hostname;dbname=tfe_2014", $username,$password);
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
