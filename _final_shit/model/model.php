<?php 
 //Auteur : José Carlos Gasser
 //Date : 02.11.2021
 //Description : ce fichier va concerner tout ce qui est de la connection à la db


//Cette classe va permettre la connection avec la db
//Tout ce code a énormément de similitude avec le travail de module php/mysql de José Gasser car tout a été repris et adapté par lui-même pour ce projet
class Database {
    public $pdo;

    //Constructeur de la classe DAtabase
    function __construct()
    {
        //On va inclure le array qui contient les infos de connection
        include('config.php');

        //On va utiliser PDO pour parler avec la db, et pour ce faire il faut commencer par se connecter
        try
        {
            $dsn = "mysql:host=" . $login["ip"] . ";dbname=" . $login["db"]; 
            $this->pdo=new PDO($dsn,$login['user'],$login['pass']);
        
            // Activer le mode exeption du pdo
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "On est dans la matrice";
        }
        //Si on arrive pas à se connecter ça va nous trow un message d'erreur
        catch(PDOException $e)
        {
        echo "Impossible de se connecter à la base de données, avec le code d'erreur : \n";
        echo $e->getMessage(); 
        }
    }   

    /**
    * permet de préparer et d’exécuter une requête de type simple (sans where)
    */
    private function querySimpleExecute($query)
    {
        $req = $this->pdo->query($query);
        $data_array = $this->formatData($req);
        $this->unsetData($req);
        return $data_array;
    }

    /**
    *  traiter les données pour les retourner par exemple en tableau associatif (avec PDO::FETCH_ASSOC)
    */
    private function formatData($req)
    {
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
    * vide le jeu d’enregistrement
    */
    private function unsetData($req)
    {
        $req->closeCursor();
    }

    public function checkIfBookExists($id)
    {
        $stmt = $this->pdo->prepare("SELECT idBook FROM t_book WHERE idBook='$id'");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        
        if ($result!=null) {
            return 1;
        }
        return 0;
    }

    //Cette fonction va nous donner toutes les informations sur un livre et nous retourner un tableau
    public function getBook($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM t_book 
        INNER JOIN t_author on t_book.idAuthor = t_author.idAuthor
        INNER JOIN t_category on t_book.idCategory = t_category.idCategory
        INNER JOIN t_publisher on t_book.idPublisher = t_publisher.idPublisher
        WHERE idBook=$id");
        $stmt->execute();

        //format data
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //clear the results
        $stmt->closeCursor();

        return $result;
    }

    //Cette fonction retourne les 5 derniers livres ajoutés
    public function getFiveLastBooks()
    {
        //A FAIRE : faut que la query grab les 5 derniers livres ajoutés, du coup faut ajouter la date
        $query = "SELECT idBook, booTitle, booCover FROM t_book LIMIT 5";

        $result = $this->querySimpleExecute($query);

        return $result;
    }

    public function getAllBooksList()
    {
        $query = "SELECT idBook, booTitle, booCover, useName, autLastName, autFirstName  FROM t_book
        INNER JOIN t_author on t_book.idAuthor = t_author.idAuthor
        INNER JOIN t_user on t_book.idUser = t_user.idUser";

        $result = $this->querySimpleExecute($query);


        return $result;
    }

    public function getAllAuthors()
    {
        $query = "SELECT idAuthor, autLastName, autFirstName FROM t_author";
        
        $result = $this->querySimpleExecute($query);

        return $result;
    }

    public function getAllCategories()
    {
        $query = "SELECT idCategory, catName FROM t_category";
        
        $result = $this->querySimpleExecute($query);

        return $result;
    }

    public function getAllPublishers()
    {
        $query = "SELECT idPublisher, pubName FROM t_publisher";
        
        $result = $this->querySimpleExecute($query);


        return $result;
    }

    //LOGIN STUFF
    //ça va checker si un user existe
    public function CheckIfUserExists($useName)
    {
        $query = "SELECT useName FROM t_user WHERE useName='"."$useName"."'";
        $data_array = $this->querySimpleExecute($query);
        foreach($data_array as $user)
        {
            if ($user["useName"] == $useName) {
                return 1;
            }   
        }
        return 0;
    }

    //pour que ça marche, il nous faut des mdp hashés dans la db
    public function CheckPassword($useName, $usePassword)
    {
        $query = "SELECT usePassword FROM t_user WHERE useName='"."$useName"."'";
        $hashed_psw = $this->querySimpleExecute($query);
        if (password_verify($usePassword,$hashed_psw[0]["usePassword"])) {
            return 1;
        }
        return 0;
    }


    //Cette fonction n'existe pas encore pck on a pas mis les droits pour un user
    /*
    public function GetUserRights($useName){
        $query = "SELECT useAdministrator FROM t_user WHERE useName='"."$useName"."'"; 
        $rights = $this->querySimpleExecute($query);
        if (isset($rights[0]["useAdministrator"])) {
            if ($rights[0]["useAdministrator"]== 1) {
                return 1;
            }
        }
        return 0;
    }
    */
}
?>