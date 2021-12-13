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
                        $bookAverage = $conn->getAverageRating($id);
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
                if (checkAdmin()!=0){
                    $userName = $_GET["userId"];
                    $conn = new Database();
                    $userId = $conn->getUserId($userName);
                    if ($userId!=null) {
                        $userBooksNumber = $conn->getUserBooks($userId);
                        $userEntryDate = $conn->getUserEntryDate($userId);
                        $userReviews = $conn->getUserReviews($userId);
                        include("view/page/user/detail.php");
                    }
                    else
                    {
                        echo "lmao no";
                    }
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
        
        if (isset($_POST["uname"]) && isset($_POST["psw"])) {
            $useName = htmlspecialchars($_POST["uname"]);
            $usePassword = htmlspecialchars($_POST["psw"]);
            $usePassword = password_hash($usePassword,PASSWORD_BCRYPT);
            $useRights = isset($_POST["admin"]) ? (($_POST["admin"]=="on") ? 1 : 0) : 0;
            $conn = new Database();
            if ($conn->CheckIfUserExists($useName)==0) {
                $conn->addUser($useName,$usePassword,$useRights);
                echo "user ".$useName." créé";
                echo "<script>setTimeout(function(){window.location.href = '?page=addUser';}, 2000);</script>";
            }
            else
            {
                echo "cet utilisateur existe déjà";
            }
        }
    }

    //Si on arrive sur une action de type addBook
    if ($_GET["action"]=="addBook") {

        //Si on arrive sur cette page grace à une requete de type POST, on va bien tout vérifier
        if ($_SERVER['REQUEST_METHOD']=='POST') {
            //Si tous les champs demandés sont isset, on peut continuerr
            if (isset($_FILES['bookImage']) && isset($_POST["title"]) && isset($_POST["auteurNom"]) && isset($_POST["auteurPrenom"])
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

                // S'il y a une erreur dans un des champs, on va mettre 0 comme valeur à la variable erreur (exemple : autNameErr)

                $booTitleErr = ($_POST["title"] != "" && strlen($_POST["title"])<50) ? 1 : 0;
                $booTitle = htmlspecialchars($_POST["title"]);

                $autLastNameErr = ($_POST["auteurNom"] != "" && strlen($_POST["auteurNom"])<50) ? 1 : 0;
                $autLastName = htmlspecialchars($_POST["auteurNom"]) ;
                
                $autFirstNameErr = ($_POST["auteurPrenom"] != "" && strlen($_POST["auteurPrenom"])<50) ? 1 : 0;
                $autFirstName = htmlspecialchars($_POST["auteurPrenom"]) ;

                $catNameErr = ($_POST["categorie"] != "" && strlen($_POST["categorie"])<50) ? 1 : 0;
                $catName = htmlspecialchars($_POST["categorie"]);

                $pubNameErr =  ($_POST["editeur"] != "" && strlen($_POST["editeur"])<50) ? 1 : 0;
                $pubName = htmlspecialchars($_POST["editeur"]);
                
                $booPublishingYearErr = ($_POST["yearEdition"] > -5000 and $_POST["yearEdition"] <= date("Y") ) ? 1 : 0;
                $booPublishingYear = htmlspecialchars($_POST["yearEdition"]);
                
                $booNumberOfPagesErr = $_POST["pageNumber"] > 0 ? 1 : 0;
                $booNumberOfPages = htmlspecialchars($_POST["pageNumber"]);
                
                $booTeaserErr = $_POST["pdfLink"] != "" ? 1 : 0;
                $booTeaser = htmlspecialchars($_POST["pdfLink"]);
                
                $booSummaryErr = $_POST["description"] != "" ? 1 : 0;
                $booSummary = htmlspecialchars($_POST["description"]);

                //S'il y a une erreur on va retourner dans la page d'ajout
                if ($booTitleErr==0 or $autLastNameErr==0 or $autFirstNameErr==0
                or $catNameErr==0 or $pubNameErr==0 
                or $booPublishingYearErr==0 or $booNumberOfPagesErr==0 
                or $booTeaserErr==0 or $booSummaryErr==0) {
                    $conn = new Database();
                    $authors = $conn->getAllAuthors();
                    $categories = $conn->getAllCategories();
                    $publishers = $conn->getAllPublishers();
                    include("view/page/book/add.php");
                }
                // Si on a plus d'erreur on peut envoyer les infos à la DB
                else 
                {
                    $conn = new Database();

                    //On check si certains champs existent déjà dans la db

                    $idAuthor = $conn->checkAuthor($autFirstName, $autLastName);
                    //Si l'auteur n'existe pas, on va en créer un nouveau
                    if ($idAuthor==null) {
                       $conn->insertAuthor($autFirstName, $autLastName);
                       $idAuthor = $conn->checkAuthor($autFirstName, $autLastName);

                    }

                    $idCategory = $conn->checkCategory($catName);
                    //Si la categorie n'existe pas, on va en créer un nouveau

                    if ($idCategory==null) {
                        $conn->insertCategory($catName);
                        $idCategory = $conn->checkCategory($catName);
                    }

                    
                    $idPublisher = $conn->checkPublisher($pubName);
                    //Si l'editeur n'existe pas on l'ajoute
                    if ($idPublisher==null) {
                        $conn->insertPublisher($pubName);
                        $idPublisher = $conn->checkPublisher($pubName);
                    }

                    $idUser = $conn->getUserId($_SESSION["username"]);

                    $conn->insertBook($booTitle, $idCategory, $idAuthor, $idPublisher,$booPublishingYear, $booSummary, $booTeaser,$booNumberOfPages, $booCover,$idUser);

                    $idBook = $conn->getBookId($booTitle);
                    echo "<script>setTimeout(function(){window.location.href = '?page=detail&bookId=$idBook';}, 500);</script>";
                }                
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

                    $_SESSION["username"] = $useLogin;
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

    if ($_GET["action"]=="rate") {
        if (checkAdmin()!=0) {
            if (isset($_GET["bookId"])) {
                $rating = 0;
                if (isset($_POST["rating"])) {
                    $rating = $_POST["rating"];
                }
                $conn = new Database;
                $userId = $conn->getUserId($_SESSION["username"]);
                $conn->addRating($rating,$_GET["bookId"],$userId);
                echo("<script>location.href = '?page=detail&bookId=".$_GET["bookId"]."';</script>");
            }
        }
        echo("<script>location.href = '?page=detail&bookId=".$_GET["bookId"]."';</script>");
    }
}
else {
    include("view/page/404.php");
}

/**
 * Check si droit d'admin ou pas
 *
 * @return int 0: disconnected, 1:admin, 2:user
 */
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

//TOUT CE QUI CONCERNE LES COOKIES, pris de https://cookieconsent.popupsmart.com/

?>

<script type="text/javascript" src="https://cookieconsent.popupsmart.com/src/js/popper.js"></script><script> window.start.init({Palette:"palette5",Mode:"floating right",Theme:"block",Message:"En utilisant notre site, vous acceptez que nous utilisions des cookies pour offrir une meilleure expérience du site.",ButtonText:"J'ai compris !",})</script>