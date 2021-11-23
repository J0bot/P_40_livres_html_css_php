<?php 
 //Auteur : José Carlos Gasser
 //Date : 02.11.2021
 //Description : Controller de l'application

include("model/model.php");
include("view/view.php");

if (isset($_GET["page"])) {
    switch ($_GET["page"]) {
        case 'home':
            $conn = new Database();
            $list_books = $conn->getFiveLastBooks();
            include("view/page/home.php");
            break;
        case 'list':
            $conn = new Database();
            $list_books = $conn->getAllBooksList();
            include("view/page/book/list.php");
            break;
        case 'detail':
            if (isset($_GET["bookId"])) {
                $conn = new Database();
                $book = $conn->getBook($_GET["bookId"]);
                if ($book != null) {
                    include("view/page/book/detail.php");
                }
            }
    }
}
else
{
    $url = "?page=home";
    header( "Location: $url" );
}

$conn = new Database;
$list_shit = $conn->getBook(2);
//var_dump($list_shit);
?>