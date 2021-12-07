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
     * permet de préparer, de binder et d’exécuter une requête (select avec where ou insert, update et delete)
     *
     * @param string $query
     * @param array $binds
     * @return array
     */
    private function queryPrepareExecute($query, $binds)
    {
        $req = $this->connector->prepare($query);

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
        $stmt = $this->pdo->prepare("SELECT idBook, booTitle, booPublishingYear, booSummary, booNumberOfPages, booCover, booReviewAverage, autLastName, autFirstName, pubName, useName, catName  FROM t_book 
        INNER JOIN t_author on t_book.idAuthor = t_author.idAuthor
        INNER JOIN t_category on t_book.idCategory = t_category.idCategory
        INNER JOIN t_publisher on t_book.idPublisher = t_publisher.idPublisher
        INNER JOIN t_user on t_book.idUser = t_user.idUser
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

    public function getUserData($useName)
    {
        $query = "SELECT useName FROM t_user WHERE useName='$useName'";
        
        $result = $this->querySimpleExecute($query);

        return $result;
    }

    public function getUserId($useName)
    {
        $query = "SELECT idUser FROM t_user WHERE useName='$useName'";

        return $this->querySimpleExecute($query);
    }

    public function addUser($useName,$usePassword,$useRights)
    {
        $query = "INSERT INTO t_user (useName,usePassword,useRights) VALUES ('$useName','$usePassword','$useRights')";
        $this->pdo->query($query);
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



    public function GetUserRights($useName){
        $query = "SELECT useRights FROM t_user WHERE useName='"."$useName"."'"; 
        $rights = $this->querySimpleExecute($query);
        if (isset($rights[0]["useRights"])) {
            if ($rights[0]["useRights"]== 1) {
                return 1;
            }
        }
        return 0;
    }


    //TOUT PAR RAPPORT À L'AJOUT D'UN OUVRAGE

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
            0 => array (
                'var' => $autLastName,
                'marker' => ':autLastName',
                'type'  => PDO::PARAM_STR
            ),
        );
        
        return $this->queryPrepareExecute($query,$binds);
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
        $query = "INSERT INTO t_author SET autFirstName=:autFirstName, autLastName=:autLastName, autBirthDate=:autBirthDate, autDeathDate=:autDeathDate, autNationality=:autNationality; SELECT idAuthor FROM t_author WHERE autLastName=:autLastName and autFirstName=:autFirstName";
            
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
            return $this->queryPrepareExecute($query, $binds);
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
        
        return $this->queryPrepareExecute($query,$binds);
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
        $query = "INSERT INTO t_category SET catName=:catName, catDescription=:catDescription; SELECT idCategory FROM t_category WHERE catName=:catName";
            
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
            return $this->queryPrepareExecute($query, $binds);
    }

    /**
     * Check si le publisher existe
     *
     * @param string $pubName
     * @return int NULL : exite pas, sinon return son id
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

        return $this->queryPrepareExecute($query,$binds);
    }

    /**
     * Insertion d'un publisher
     *
     * @param string $pubName
     * @param string $pubCreationDate
     * @param string $pubCountry
     * @return int l'id du publisher créé
     */
    public function insertPublisher($pubName, $pubCreationDate=null, $pubCountry=null)
    {
        $query = "INSERT INTO t_publisher SET pubName=:pubName, pubCreationDate=:pubCreationDate, pubCountry=:pubCountry; SELECT idPublisher  FROM t_publisher WHERE pubName=:pubName";
            
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
        return $this->queryPrepareExecute($query, $binds);
    }

  
    /**
     * Va ajouter un livre dans la db
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
     * @return void
     */
    public function insertBook($booTitle, $idCategory, 
    $idAuthor, $idPublisher,$booPublishingYear,
    $booSummary, $booTeaser,$booNumberOfPages,
    $booCover,$idUser,$booLanguage="english")
    {
        $query = "INSERT INTO t_book SET booTitle=:booTitle, 
        idCategory=:idCategory, idAuthor=:idAuthor,idPublisher=:idPublisher,
        booPublishingYear=:booPublishingYear,booSummary=:booSummary,booTeaser=:booTeaser,
        booNumberOfPages=:booNumberOfPages, booCover=:booCover,idUser=:idUser, booLanguage=:booLanguage;
        SELECT idBook FROM t_book WHERE booTitle=:booTitle";
        
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
        
        return $this->queryPrepareExecute($query, $binds);
    }
}
?>