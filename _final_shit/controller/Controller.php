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
        case 'addUser':
            include("view/page/user/add.php");
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
            elseif(isset($_GET["userId"]))
            {
                $id = $_GET["userId"];
                $conn = new Database();
                $userData = $conn->getUserData($id);
                if ($userData!=null) {
                    include("view/page/user/detail.php");
                }
                else
                {
                    echo "lmao no";
                }
            }
            break;

        default :
            include("view/page/404.php");
            break;
    }
}
elseif (isset($_GET["action"])) {
    if ($_GET["action"]=="addUser") {
        $useName = htmlspecialchars($_POST["uname"]);
        $usePassword = htmlspecialchars($_POST["psw"]);
        $useRights = ($_POST["admin"]=="on") ? 1 : 0;
    }
}
else {
    include("view/page/404.php");
}
?>