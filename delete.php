<?php
include 'connexion.php';
// echo "delete";
$ref=$_GET['id'];
$db -> query("delete from membres where id=$ref");

// echo $sql;


header('location:liste.php');

?>