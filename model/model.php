<?php 
//Auteur : José Carlos Gasser
//Date : 02.11.2021
//Description : ce fichier va concerner tout ce qui est de la connexion à la db


//Cette classe va permettre la connexion avec la db
//Tout ce code a énormément de similitude avec le travail de module php/mysql de José Gasser car tout a été repris et adapté par lui-même pour ce projet
class Database {
    public $pdo;

    /**
     * Constructeur de la classe Database
     */
    function __construct()
    {
        //On va inclure le tableau qui contient les informations de connexion
        include('config.php');

        //On va utiliser PDO pour parler avec la db, et pour ce faire il faut commencer par se connecter
        try
        {
            $dsn = "mysql:host=" . $login["ip"] . ";dbname=" . $login["db"]; 
            $this->pdo=new PDO($dsn,$login['user'],$login['pass']);
        
            //Activer le mode exeption du pdo
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        //Si on arrive pas à se connecter ça va nous envoyer un message d'erreur
        catch(PDOException $e)
        {
            echo "Impossible de se connecter à la base de données, avec le code d'erreur : \n";
            echo $e->getMessage(); 
        }
    }   


    /**
     * permet de préparer et d’exécuter une requête de type simple (sans where)
     *
     * @param string $query
     * @return array
     */
    private function querySimpleExecute($query)
    {
        $req = $this->pdo->query($query);
        $arrayData = $this->formatData($req);
        $this->unsetData($req);
        return $arrayData;
    }

    /**
     * permet de préparer, de binder et d’exécuter une requête (select avec where ou insert, update et delete)
     *
     * @param string $query
     * @param array $binds
     * @return array
     */
    private function queryPrepareExecute($query, $binds)
    {
        $req = $this->pdo->prepare($query);

        foreach($binds as $bind)
        {
            $req->bindValue($bind['marker'], $bind['var'], $bind['type']);
        }
        $req->execute();

        $dataArray = $this->formatData($req);

        $this->unsetData($req);

        return $dataArray;
    }

    /**
    * traiter les données pour les retourner par exemple en tableau associatif 
    * (avec PDO::FETCH_ASSOC)
    *
    *@param PDOStatement $req 
    */
    private function formatData($req)
    {
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
    * vide le jeu d’enregistrement
    *
    *@param $req
    *@return void
    */
    private function unsetData($req)
    {
        $req->closeCursor();
    }

    /**
     * Vérifie si un livre existe
     *
     * @param int $id
     * @return bool 
     */
    public function checkIfBookExists($id)
    {
        $query ="SELECT idBook FROM t_book WHERE idBook=:id";
        $binds = array(
            0 => array (
                'var' => $id,
                'marker' => ':id',
                'type'  => PDO::PARAM_STR
            )
        );
        $result= $this->queryPrepareExecute($query,$binds);
        
        if ($result!=null) {
            return 1;
        }
        return 0;
    }


    /**
     * Cette fonction va nous donner toutes les informations sur un livre et nous retourner un tableau
     *
     * @param int $id
     * @return array
     */
    public function getBook($id)
    {
        $query ="SELECT idBook,booTeaser, booTitle, booPublishingYear, booSummary, booNumberOfPages, booCover, booReviewAverage, autLastName, autFirstName, pubName, useName, catName  FROM t_book 
        INNER JOIN t_author on t_book.idAuthor = t_author.idAuthor
        INNER JOIN t_category on t_book.idCategory = t_category.idCategory
        INNER JOIN t_publisher on t_book.idPublisher = t_publisher.idPublisher
        INNER JOIN t_user on t_book.idUser = t_user.idUser
        WHERE idBook=:id";

        $binds = array(
            0 => array (
                'var' => $id,
                'marker' => ':id',
                'type'  => PDO::PARAM_STR
            )
        );

        return $this->queryPrepareExecute($query, $binds);
    }

    
    /**
     * Cette fonction retourne les 5 derniers livres ajoutés
     *
     * @return array
     */
    public function getFiveLastBooks()
    {
        //A FAIRE : faut que la query grab les 5 derniers livres ajoutés, du coup faut ajouter la date
        $query = "SELECT idBook, booTitle, booCover FROM t_book ORDER BY idBook DESC LIMIT 5";

        $result = $this->querySimpleExecute($query);

        return $result;
    }

    /**
     * Retourne tous les livres de la base de données
     * 
     * @return array 
     */
    public function getAllBooksList()
    {
        $query = "SELECT idBook,catName , booTitle, booCover, useName, autLastName, autFirstName  FROM t_book
        INNER JOIN t_author on t_book.idAuthor = t_author.idAuthor
        INNER JOIN t_user on t_book.idUser = t_user.idUser
        INNER JOIN t_category on t_book.idCategory = t_category.idCategory
        ORDER BY booTitle ASC";

        $result = $this->querySimpleExecute($query);

        return $result;
    }

    /**
     * Retourne tous les livres pour une catégorie donnée
     * 
     * @return array 
     */
    public function getCategoryBookList($catName)
    {
        $query = "SELECT idBook, catName , booTitle, booCover, useName, autLastName, autFirstName  FROM t_book
        INNER JOIN t_author on t_book.idAuthor = t_author.idAuthor
        INNER JOIN t_user on t_book.idUser = t_user.idUser
        INNER JOIN t_category on t_book.idCategory = t_category.idCategory
        WHERE catName=:catName";

        $binds = array(
            0 => array (
                'var' => $catName,
                'marker' => ':catName',
                'type'  => PDO::PARAM_STR
            )
        );

        $arrayData = $this->queryPrepareExecute($query, $binds);
        if ($arrayData!=null) {
            return $arrayData;
        }
        return null;
    }



    /**
     * Retourne tous les auteurs de la db dans un tableau
     *
     * @return array
     */
    public function getAllAuthors()
    {
        $query = "SELECT idAuthor, autLastName, autFirstName FROM t_author";
        
        $result = $this->querySimpleExecute($query);

        return $result;
    }
    /**
     * retourne toutes les catégories de livres existantes dans un tableau
     *
     * @return array
     */
    public function getAllCategories()
    {
        $query = "SELECT idCategory, catName FROM t_category";
        
        $result = $this->querySimpleExecute($query);

        return $result;
    }

    /**
     * Retourne tous les éditeurs dans un tableau
     *
     * @return array
     */
    public function getAllPublishers()
    {
        $query = "SELECT idPublisher, pubName FROM t_publisher";
        
        $result = $this->querySimpleExecute($query);

        return $result;
    }

    /**
     * Retourne toutes les données liées à l'utilisateur
     *
     * @param string $useName pseudo de l'utilisateur
     * @return array
     */
    public function getUserData($useName)
    {
        $query = "SELECT useName FROM t_user WHERE useName=:useName";
        
        $binds = array(
            0 => array (
                'var' => $useName,
                'marker' => ':useName',
                'type'  => PDO::PARAM_STR
            )
        );
        $result = $this->queryPrepareExecute($query,$binds);

        return $result;
    }

    /**
     * Retourne l'id de l'utilisateur à partir du pseudo
     *
     * @param string $useName pseudo de l'utilisateur
     * @return int
     */
    public function getUserId($useName)
    {
        $query = "SELECT idUser FROM t_user WHERE useName=:useName";
        $binds = array(
            0 => array (
                'var' => $useName,
                'marker' => ':useName',
                'type'  => PDO::PARAM_STR
            )
        );

        $arrayData = $this->queryPrepareExecute($query,$binds);
        if (isset($arrayData[0]["idUser"])) {
            return $arrayData[0]["idUser"];
        }
        return null;
    }

    /**
     * Ajoute un nouvel utilisateur à la BD
     * 
     * @return array 
     */
    public function addUser($useName,$usePassword,$useRights)
    {
        $query = "INSERT INTO t_user (useName,usePassword,useRights,useEntryDate) VALUES (:useName,:usePassword,:useRights, NOW())";
        $binds = array(
            0 => array (
                'var' => $useName,
                'marker' => ':useName',
                'type'  => PDO::PARAM_STR
            ),
            1 => array (
                'var' => $usePassword,
                'marker' => ':usePassword',
                'type'  => PDO::PARAM_STR
            ),
            2 => array (
                'var' => $useRights,
                'marker' => ':useRights',
                'type'  => PDO::PARAM_STR
            )
        );

        $this->queryPrepareExecute($query,$binds);
    }
    

    //Fonctions qui concernent le login 

    /**
     * Vérifie si un utilisateur est existant
     *
     * @param string $useName pseudo de l'utilisateur
     * @return bool
     */
    public function CheckIfUserExists($useName)
    {
        $query = "SELECT useName FROM t_user WHERE useName=:useName";
        
        $binds = array(
            0 => array (
                'var' => $useName,
                'marker' => ':useName',
                'type'  => PDO::PARAM_STR
            )
        );

        $arrayData = $this->queryPrepareExecute($query,$binds);

        foreach($arrayData as $user)
        {
            if ($user["useName"] == $useName) {
                return 1;
            }   
        }
        return 0;
    }

    /**
     * Vérifie si le mot de passe de l'utilisateur est correct
     * Fonctionne uniquement avec des mots de passe hashés
     *
     * @param string $useName pseudo de l'utilisateur
     * @param string $usePassword mot de passe de l'utilisateur hashé
     * @return bool vérifié si true
     */
    public function CheckPassword($useName, $usePassword)
    {
        $query = "SELECT usePassword FROM t_user WHERE useName=:useName";
        $binds = array(
            0 => array (
                'var' => $useName,
                'marker' => ':useName',
                'type'  => PDO::PARAM_STR
            )
        );

        $hashed_psw = $this->queryPrepareExecute($query,$binds);
        if (password_verify($usePassword,$hashed_psw[0]["usePassword"])) {
            return 1;
        }
        return 0;
    }


    /**
     * Retourne les droits d'accès de l'utilisateur
     *
     * @param string $useName pseudo de l'utilisateur
     * @return bool true = droits d'accès 
     */
    public function GetUserRights($useName){
        $query = "SELECT useRights FROM t_user WHERE useName=:useName"; 
        $binds = array(
            0 => array (
                'var' => $useName,
                'marker' => ':useName',
                'type'  => PDO::PARAM_STR
            )
        );
        $rights = $this->queryPrepareExecute($query,$binds);
        if (isset($rights[0]["useRights"])) {
            if ($rights[0]["useRights"]== 1) {
                return 1;
            }
        }
        return 0;
    }


    //Fonctions liées à l'ajout d'un livre

    /**
     * Cette fonction check si un autheur existe
     *
     * @param string $autFirstName 
     * @param string $autLastName
     * @return int retourne son id s'il existe pas et NULL s'il n'existe pas
     */
    public function checkAuthor($autFirstName, $autLastName)
    {
        $query = "SELECT idAuthor FROM t_author WHERE autFirstName=:autFirstName AND autLastName=:autLastName";
        $binds = array (
            0 => array (
                'var' => $autFirstName,
                'marker' => ':autFirstName',
                'type'  => PDO::PARAM_STR
            ),
            1 => array (
                'var' => $autLastName,
                'marker' => ':autLastName',
                'type'  => PDO::PARAM_STR
            )
        );
        $arrayData = $this->queryPrepareExecute($query,$binds);
        if (isset($arrayData[0]["idAuthor"])) {
            return $arrayData[0]["idAuthor"];
        }
        return null;
    }

    /**
     * Insertion d'un autheur qui n'existe pas
     *
     * @param string $autFirstName
     * @param string $autLastName
     * @param string $autBirthDate
     * @param string $autDeathDate
     * @param string $autNationality
     * @return int retourne l'id du livre qui vient d'être créé
     */
    public function insertAuthor($autFirstName, $autLastName, $autBirthDate=null, $autDeathDate=null, $autNationality=null)
    {
        $query = "INSERT INTO t_author SET autFirstName=:autFirstName, autLastName=:autLastName, autBirthDate=:autBirthDate, autDeathDate=:autDeathDate, autNationality=:autNationality;";
            
        $binds = array (
            0 => array (
                'var' => $autFirstName,
                'marker' => ':autFirstName',
                'type'  => PDO::PARAM_STR
            ),
            1 => array (
                'var' => $autLastName,
                'marker' => ':autLastName',
                'type'  => PDO::PARAM_STR
            ),
            2 => array (
                'var' => $autBirthDate,
                'marker' => ':autBirthDate',
                'type'  => PDO::PARAM_STR
            ),
            3 => array (
                'var' => $autDeathDate,
                'marker' => ':autDeathDate',
                'type'  => PDO::PARAM_STR
            ),
            4 => array (
                'var' => $autNationality,
                'marker' => ':autNationality',
                'type'  => PDO::PARAM_STR
            )
        );
        $this->queryPrepareExecute($query,$binds);
    }

    /**
     * On check si la categorie existe
     *
     * @param string $catName
     * @return int retourne l'id de la categorie si elle existe
     */
    public function checkCategory($catName)
    {
        $query = "SELECT idCategory  FROM t_category WHERE catName=:catName;";
        $binds = array (
            0 => array (
                'var' => $catName,
                'marker' => ':catName',
                'type'  => PDO::PARAM_STR
            ),
        );
        
        $arrayData = $this->queryPrepareExecute($query,$binds);
        if (isset($arrayData[0]["idCategory"])) {
            return $arrayData[0]["idCategory"];
        }
        return null;
    }

    /**
     * Va ajouter une categorie dans la db
     *
     * @param string $catName
     * @param string $catDescription
     * @return int retourne l'id du livre qu'on vient de créer
     */
    public function insertCategory($catName, $catDescription=null)
    {
        $query = "INSERT INTO t_category SET catName=:catName, catDescription=:catDescription;";
            
        $binds = array (
            0 => array (
                'var' => $catName,
                'marker' => ':catName',
                'type'  => PDO::PARAM_STR
            ),
            1 => array (
                'var' => $catDescription,
                'marker' => ':catDescription',
                'type'  => PDO::PARAM_STR
            )
        );
        $this->queryPrepareExecute($query,$binds);
    }

    /**
     * Check si l'éditeur existe
     *
     * @param string $pubName
     * @return int NULL : existe pas, sinon return son id
     */
    public function checkPublisher($pubName)
    {
        $query = "SELECT idPublisher FROM t_publisher WHERE pubName=:pubName";
        $binds = array (
            0 => array (
                'var' => $pubName,
                'marker' => ':pubName',
                'type'  => PDO::PARAM_STR
            )
        );

        $arrayData = $this->queryPrepareExecute($query,$binds);
        if (isset($arrayData[0]["idPublisher"])) {
            return $arrayData[0]["idPublisher"];
        }
        return null;
    }

    /**
     * Insertion d'un éditeur
     *
     * @param string $pubName
     * @param string $pubCreationDate
     * @param string $pubCountry
     * @return int l'id du publisher créé
     */
    public function insertPublisher($pubName, $pubCreationDate=null, $pubCountry=null)
    {
        $query = "INSERT INTO t_publisher SET pubName=:pubName, pubCreationDate=:pubCreationDate, pubCountry=:pubCountry;";
            
        $binds = array (
            0 => array (
                'var' => $pubName,
                'marker' => ':pubName',
                'type'  => PDO::PARAM_STR
            ),
            1 => array (
                'var' => $pubCreationDate,
                'marker' => ':pubCreationDate',
                'type'  => PDO::PARAM_STR
            ),
            2 => array (
                'var' => $pubCountry,
                'marker' => ':pubCountry',
                'type'  => PDO::PARAM_STR
            )
        );
        $this->queryPrepareExecute($query,$binds);
    }

  
    /**
     * Ajouter un livre dans la db
     *
     * @param string $booTitle
     * @param string $idCategory
     * @param string $idAuthor
     * @param string $idPublisher
     * @param string $booPublishingYear
     * @param string $booSummary
     * @param string $booTeaser
     * @param string $booNumberOfPages
     * @param string $booCover
     * @param string $idUser
     * @param string $booLanguage
     * @return int on retourne l'id du livre
     */
    public function insertBook($booTitle, $idCategory, 
    $idAuthor, $idPublisher,$booPublishingYear,
    $booSummary, $booTeaser,$booNumberOfPages,
    $booCover,$idUser,$booLanguage="english")
    {
        $query = "INSERT INTO t_book SET booTitle=:booTitle, 
        idCategory=:idCategory, idAuthor=:idAuthor,idPublisher=:idPublisher,
        booPublishingYear=:booPublishingYear,booSummary=:booSummary,booTeaser=:booTeaser,
        booNumberOfPages=:booNumberOfPages, booCover=:booCover,idUser=:idUser, booLanguage=:booLanguage";
        
        $binds = array (
            0 => array (
                'var' => $booTitle,
                'marker' => ':booTitle',
                'type'  => PDO::PARAM_STR
            ),
            1 => array (
                'var' => $idCategory,
                'marker' => ':idCategory',
                'type'  => PDO::PARAM_STR
            ),
            2 => array (
                'var' => $idAuthor,
                'marker' => ':idAuthor',
                'type'  => PDO::PARAM_STR
            ),
            3 => array (
                'var' => $idPublisher,
                'marker' => ':idPublisher',
                'type'  => PDO::PARAM_STR
            ),
            4 => array (
                'var' => $booPublishingYear,
                'marker' => ':booPublishingYear',
                'type'  => PDO::PARAM_STR
            ),
            5 => array (
                'var' => $booSummary,
                'marker' => ':booSummary',
                'type'  => PDO::PARAM_STR
            ),
            6 => array (
                'var' => $booTeaser,
                'marker' => ':booTeaser',
                'type'  => PDO::PARAM_STR
            ),
            7 => array (
                'var' => $booNumberOfPages,
                'marker' => ':booNumberOfPages',
                'type'  => PDO::PARAM_STR
            ),
            8 => array (
                'var' => $idUser,
                'marker' => ':idUser',
                'type'  => PDO::PARAM_STR
            ),
            9 => array (
                'var' => $booCover,
                'marker' => ':booCover',
                'type'  => PDO::PARAM_STR
            ),
            10 => array (
                'var' => $booLanguage,
                'marker' => ':booLanguage',
                'type'  => PDO::PARAM_STR
            )
        );
        
        $this->queryPrepareExecute($query,$binds);
    }

    /**
     * Retourne l'id d'un livre à partir de son titre
     *
     * @param string $booTitle
     * @return int l'id du livre
     */
    public function getBookId($booTitle)
    {
        $query = "SELECT idBook FROM t_book WHERE booTitle=:booTitle";
        $binds = array (
            0 => array (
                'var' => $booTitle,
                'marker' => ':booTitle',
                'type'  => PDO::PARAM_STR
            )
        );
        $arrayData = $this->queryPrepareExecute($query,$binds);
        return $arrayData[0]["idBook"];
    }

    /**
     * Retourne le nombre de livres ajoutés par un utilisateur
     *
     * @param int $idUser
     * @return int nombre de livres de l'utilisateur
     */
    public function getUserBooks($idUser)
    {
        $query = "SELECT COUNT(booTitle) as nbBooks FROM t_book WHERE idUser = :idUser ";
        $binds = array (
            0 => array (
                'var' => $idUser,
                'marker' => ':idUser',
                'type'  => PDO::PARAM_STR
            )
        );

        $arrayData = $this->queryPrepareExecute($query,$binds);
        return $arrayData[0]["nbBooks"];
    }
    
    /**
     * Retourne la date d'inscription de l'utilisateur
     *
     * @param int $idUser
     * @return string date au format YYYY-MM-dd
     */
    public function getUserEntryDate($idUser)
    {
        $query = "SELECT useEntryDate FROM t_user WHERE idUser = :idUser ";
        $binds = array (
            0 => array (
                'var' => $idUser,
                'marker' => ':idUser',
                'type'  => PDO::PARAM_STR
            )
        );

        $arrayData = $this->queryPrepareExecute($query,$binds);
        return $arrayData[0]["useEntryDate"];
    }

    /**
     * Retourne le nombre de notes postées par l'utilisateur
     *
     * @param int $idUser
     * @return int nombre de reviews, null si inexistant
     */
    public function getUserReviews($idUser)
    {
        $query = "SELECT COUNT(idReview) as nbReviews FROM t_review WHERE idUser=:idUser ";
        $binds = array (
            0 => array (
                'var' => $idUser,
                'marker' => ':idUser',
                'type'  => PDO::PARAM_STR
            )
        );

        $dataArray = $this->queryPrepareExecute($query,$binds);
        if (isset($dataArray[0]["nbReviews"])) {
            return $dataArray[0]["nbReviews"];
        }
        return null;
    }

    /**
     * Ajoute la note d'un utilisateur
     *
     * @param int $rating note de l'utilisateur
     * @param int $idBook
     * @param int $username pseudo de l'utilisateur
     * @return void
     */
    public function addRating($rating, $idBook ,$idUser)
    {
        $query = "INSERT INTO t_review SET revScore=:rating, idBook=:idBook, idUser=:idUser";
        $binds = array (
            0 => array (
                'var' => $rating,
                'marker' => ':rating',
                'type'  => PDO::PARAM_STR
            ),
            3 => array (
                'var' => $idUser,
                'marker' => ':idUser',
                'type'  => PDO::PARAM_STR
            ),
            2 => array (
                'var' => $idBook,
                'marker' => ':idBook',
                'type'  => PDO::PARAM_STR
            )
        );

        $this->queryPrepareExecute($query,$binds);
    }
    
    /**
     * Retourne la note moyenne des utilisateurs d'un livre
     *
     * @param int $idBook
     * @return int retourne null si inexistant
     */
    public function getAverageRating($idBook)
    {
        $query = "SELECT ROUND(AVG(revScore)) as average FROM t_review WHERE  idBook=:idBook";
        $binds = array (
            0 => array (
                'var' => $idBook,
                'marker' => ':idBook',
                'type'  => PDO::PARAM_STR
            )
        );
    
        $dataArray = $this->queryPrepareExecute($query,$binds);
        if (isset($dataArray[0]["average"])) {
            return $dataArray[0]["average"];
        }
        return null;
    }


    /**
     * Fonction de recherche d'un livre
     *
     * @param string $bookName
     * @return array liste des livres trouvés
     */
    public function searchBook($bookName)
    {
        $pattern ="%" .$bookName . "%";
        $query = "SELECT idBook, catName, booTitle, booCover, useName, autLastName, autFirstName FROM t_book
        INNER JOIN t_author on t_book.idAuthor = t_author.idAuthor
        INNER JOIN t_user on t_book.idUser = t_user.idUser
        INNER JOIN t_category on t_book.idCategory = t_category.idCategory
        WHERE booTitle LIKE :pattern
        ORDER BY booTitle ASC";
        
        $binds = array (
            0 => array (
                'var' => $pattern,
                'marker' => ':pattern',
                'type'  => PDO::PARAM_STR
            )
        );
    
        $dataArray = $this->queryPrepareExecute($query,$binds);
        if (isset($dataArray[0]["average"])) {
            return $dataArray[0]["average"];
        }
        

        return $dataArray;    
    }
}
?>