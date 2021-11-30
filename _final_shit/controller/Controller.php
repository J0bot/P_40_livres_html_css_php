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
            if (checkAdmin()) {
                $conn = new Database();
                $authors = $conn->getAllAuthors();
                $categories = $conn->getAllCategories();
                $publishers = $conn->getAllPublishers();
                include("view/page/book/add.php");
            }
            break;
        case 'addUser':
            if (checkAdmin()) {
                include("view/page/user/add.php");
            }
            break;
        case 'detail':
            if (isset($_GET["bookId"])) {
                if (checkAdmin()!=0) {
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
        
        if (isset($_POST["uname"]) && isset($_POST["psw"]) && isset($_POST["admin"])) {
            $useName = htmlspecialchars($_POST["uname"]);
            $usePassword = htmlspecialchars($_POST["psw"]);
            $usePassword = password_hash($usePassword,PASSWORD_BCRYPT);
            $useRights = ($_POST["admin"]=="on") ? 1 : 0;
            $conn = new Database();
            if ($conn->CheckIfUserExists($useName)==0) {
                $conn->addUser($useName,$usePassword,$useRights);
                echo("<script>location.href = '".$_SERVER['HTTP_REFERER']."';</script>");
            }
            else
            {
                echo "cet utilisateur existe déjà";
            }
        }
        

        
    }

    //Si on arrive sur une action de type addBook
    if ($_GET["action"]=="addBook") {
        var_dump($_POST);

        //Si on arrive sur cette page grace à une requete de type POST, on va bien tout vérifier
        if ($_SERVER['REQUEST_METHOD']=='POST') {
            //Si tous les champs demandés sont isset, on peut continuerr
            if (isset($_FILES['bookImage']) && isset($_POST["title"]) && isset($_POST["auteur"]) 
            && isset($_POST["categorie"]) && isset($_POST["editeur"]) && isset($_POST["yearEdition"]) 
            && isset($_POST["pageNumber"]) && isset($_POST["pdfLink"]) && isset($_POST["description"])) {
                
                /// BOOK COVER STUFF

                //On va vérifier si les champs sont valides, s'ils sont invalides on va dire qu'il y a une erreur
                $booCoverErr = $_FILES['bookImage']['tmp_name'] != null ? 1 : 0;

                $booCover = date("YmdHis"). "_" .$_FILES["bookImage"]["name"];
                $booCoverFolder = "resources/img/";
                move_uploaded_file($_FILES["bookImage"]["tmp_name"], $booCoverFolder.$booCover);
                
                include("controller/resize-image.php");
                
                $resizeImg = new Resize($booCoverFolder.$booCover);

                //hauteur accueil : 320
                //hauteur detial : 350
                //largeur liste : 100
                //On va resize à 350, car c'est la taille la plus grande qu'on a besoin
                $resizeImg->resizeImage(0,350,'portrait');
                $resizeImg->saveImage($booCoverFolder.$booCover,100);
                
                //echo '<img src="resources/img/'.$booCover.'"/>';
                
                /// END OF BOOK COVER STUFF


                $booTitleErr = ($_POST["title"] != "" && strlen($_POST["title"])<50) ? 1 : 0;
                $booTitle = $_POST["title"];

                $autNameErr = ($_POST["auteur"] != "" && strlen($_POST["auteur"])<50) ? 1 : 0;
                $autName = $_POST["auteur"] ;

                $catNameErr = ($_POST["categorie"] != "" && strlen($_POST["categorie"])<50) ? 1 : 0;
                $catName = $_POST["categorie"];

                $pubNameErr =  ($_POST["editeur"] != "" && strlen($_POST["editeur"])<50) ? 1 : 0;
                $pubName = $_POST["editeur"];
                
                $booCoverErr = $_POST["yearEdition"] != null ? 1 : 0;
                $booCover =$_POST["yearEdition"];
                
                $booCoverErr = $_POST["pageNumber"] != null ? 1 : 0;
                $booCover = $_POST["pageNumber"];
                
                $booCoverErr = $_POST["pdfLink"] != null ? 1 : 0;
                $booCover = $_POST["pdfLink"];
                
                $booCoverErr = $_POST["description"] != null ? 1 : 0;
                $booCover = $_POST["description"];

                var_dump($_POST);
                
            }
        }

        if ($_SERVER['REQUEST_METHOD']!='POST') {
            if (checkAdmin()) {
                $conn = new Database();
                $authors = $conn->getAllAuthors();
                $categories = $conn->getAllCategories();
                $publishers = $conn->getAllPublishers();
                include("view/page/book/add.php");
            }
        }
    }

    if ($_GET["action"]=="login") {
        if (isset($_POST["uname"]) and isset($_POST["psw"])) {
            $useLogin = htmlspecialchars($_POST["uname"]);
            $userPassword = htmlspecialchars($_POST["psw"]);
            $_POST["psw"]= "";
            $conn = new Database;
            if($conn->CheckIfUserExists($useLogin)==1)
            {
               if($conn->CheckPassword($useLogin, $userPassword))
                {
                    $_SESSION["logged"] = 1;
                    $adminRights = $conn->GetUserRights($useLogin);

                    $_SESSION["adminRights"] = $adminRights == 1 ? 1 : 0;

                    //Ouais jsp ça marche avec du javascript faut pas chercher
                    echo("<script>location.href = '".$_SERVER['HTTP_REFERER']."';</script>");
               }
               else { echo "password or user wrong";}
            }
            else { echo "password or user wrong";}
        }
        else { echo "password or user wrong";}
    }
    if ($_GET["action"]=="disconnect") {
        $_SESSION["logged"] = 0;
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}
else {
    include("view/page/404.php");
}

function checkAdmin()
{
    if (!isset($_SESSION["logged"])) {$_SESSION["logged"]=0;}

    if ($_SESSION["logged"]==0) {
        include("view/page/not_allowed.php");
        return 0;
    }
    if ($_SESSION["logged"]==1) {
        if ($_SESSION["adminRights"]==1) {
            return 1;
        }
        else
        {
            return 2;
        }
        
    }
    return 0;

}

?>