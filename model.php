<?php

//Tout cette merveille permet de connecter une db mysql à notre projet, 
//celle que Mathieu a confectionnée en l'occurence




//echo "Connected successfully<br>";

//EXEMPLE : var_dump( getMysqlData("SELECT autLastName as '0', autFirstName as '1' FROM t_author", 2));

/**
 * Il ne faut pas oublier de mettre automatiquement les nom des colones demandées avec un chiffre qui part de 0
 * 
 */
function getMysqlData($sqlCode, $rowNumber)
{

    //ici on a le nom du serveur mysql, en temps normal c'est une adresse ip, mais là voilà quoi
  $servername = "localhost";
  //Ici on a le username et le password, ça permet de se co à la db
  $username = "root";
  $password = "root";
//et ici on va use notre database toute géniale
  $dbname = "db_webproject";
  // Ici on va créer notre connection à la db
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Ce truc tout peté permet de montrer que notre db fonctionne correctement, mais bon là nsm
  if ($conn->connect_error) 
  {
    die("Connection failed: " . $conn->connect_error);
  }
  $result = $conn->query($sqlCode);
  $arrayToPush  = array();
  if ($result->num_rows > 0) 
    {
      // output data of each row
      while($row = $result->fetch_assoc()) 
      {
        $arrayIntermediate = array();

        if ($rowNumber >1) {
          for ($i=0; $i < count($row); $i++) 
          { 
            array_push($arrayIntermediate, $row["".$i.""]);
          }
          array_push($arrayToPush, $arrayIntermediate);   
        }
        else
        {
          array_push($arrayToPush, $row[0]);   
        }
      }
    } 
    else 
    {
      echo "0 results";
    }

    $conn->close();
    return $arrayToPush;

    
}



//var_dump( getMysqlData("SELECT autLastName as '0', autFirstName as '1' FROM t_author", 2));

$t_book_author_img = getMysqlData("SELECT booTitle as '0',autFirstName as '1', autLastName as '2', booCover as '3', useName as '4' FROM t_book
INNER JOIN t_author on t_book.idAuthor = t_author.idAuthor
NATURAL JOIN t_user",5);


$t_author_names = array();

if (isset($_GET["getAut"]))
{
  if ($_GET["getAut"]=="allName")
  {
    $t_author_names = getMysqlData("SELECT autLastName as '0', autFirstName as '1' FROM t_author", 2);

  }
}

$t_category_name =array();

if (isset($_GET["getCat"])) {
  if ($_GET["getCat"]=="allName") {
    
    $t_category_name = getMysqlData("SELECT catName as '0' FROM t_category", 1);

  }
}

$t_publisher_names = array();

$t_publisher_names = getMysqlData("SELECT pubName as '0' FROM t_publisher",1);

$t_book_cover_name = array();

$t_book_cover_name = getMysqlData("SELECT booTitle as '0', booCover as '1', idBook as '2' FROM t_book", 3);

$t_book_all = getMysqlData("SELECT idBook as '0', booTitle as '1', booCover as '2', 
                            autLastName as '3', autFirstName as '4',
                            catName as '5', booNumberOfPages as '6', 
                            pubName as '7', booPublishingYear as '8',
                            booSummary as '9', booReviewAverage as '10'
                            FROM t_book
                            NATURAL JOIN t_author
                            NATURAL JOIN t_category
                            NATURAL JOIN t_publisher",2);

//Ici on ferme la connection, c'est très important

?> 

<?php 
/*
    //Cette page sert à simuler des données venues d'une db mysql
    //Anyway c'est degeu mais ça marchera pour l'instant


    $auteur = array("max", "emilien", "Alisa");
    $categorie  = array("sci-fi", "peur");
    $editeur = array("Voiturier.com", "edtirooor");
    $books = array(
        array(
            "image" => "bee.png",
            "title" => "Pipi",
            "author" => "michel debalin",
            "pseudo" => "jobot"
        ),
        array(
            "image" => "pietro.png",
            "title" => "sdfsdf",
            "author" => "sdfsdf desdfbalin",
            "pseudo" => "dffdff"
        )
    );

   */ 
?> 