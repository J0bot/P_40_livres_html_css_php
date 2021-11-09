<?php 
 //Auteur : José Carlos Gasser
 //Date : 02.11.2021
 //Description : Controller de l'application

include("model/model.php");
include("view/view.php");

if (isset($_GET["page"])) {
    switch ($_GET["page"]) {
        case 'home':
            include("view/page/home.php");
            break;
    }
}
else
{
    include("view/page/home.php");
}

$conn = new Database;
$list_shit = $conn->getBook(2);
//var_dump($list_shit);
?>