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
            try{
                $dsn = "mysql:host=" . $login["ip"] . ";dbname=" . $login["db"]; 
                $this->pdo=new PDO($dsn,$login['user'],$login['pass']);
            
                // Activer le mode exeption du pdo
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                // echo "On est dans la matrice";
            }
             //Si on arrive pas à se connecter ça va nous trow un message d'erreur
             catch(PDOException $e){
                echo "Impossible de se connecter à la base de données, avec le code d'erreur : \n";
                echo $e->getMessage();
             }
        }   
 }
?>