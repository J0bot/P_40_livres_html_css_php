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
        case 'add':
            $conn = new Database();
            $authors = $conn->getAllAuthors();
            $categories = $conn->getAllCategories();
            $publishers = $conn->getAllPublishers();
            include("view/page/book/add.php");
            break;
        case 'detail':
            if (isset($_GET["bookId"])) {
                $id = $_GET["bookId"];
                $conn = new Database();
                
                if ($conn->checkIfBookExists($id)==1) {
                    $book = $conn->getBook($id);
                    $previousBook = ($conn->checkIfBookExists($id-1)==1) ? $id-1 : $id ;
                    $nextBook = ($conn->checkIfBookExists($id+1)==1) ? $id+1 : $id ;
                    include("view/page/book/detail.php");
                }
                else
                {
                    echo "this book is not in our databases (attentions on en a plusieurs)";
                }
            }
            break;
    }
}
else
{
    include("view/page/404.php");
}

$conn = new Database;
$list_shit = $conn->getBook(2);
//var_dump($list_shit);
?>