<?php 
 //Auteur : José Carlos Gasser
 //Date : 02.11.2021
 //Description : Controller de l'application

include("model/model.php");

$conn = new Database;
$list_shit = $conn->getBook(2);
var_dump($list_shit);
?>