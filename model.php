<?php

//Tout cette merveille permet de connecter une db mysql à notre projet, 
//celle que Mathieu a confectionnée en l'occurence

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
//echo "Connected successfully<br>";

//EXEMPLE : var_dump( getMysqlData("SELECT autLastName as '0', autFirstName as '1' FROM t_author", 2));

/**
 * Il ne faut pas oublier de mettre automatiquement les nom des colones demandées avec un chiffre qui part de 0
 * 
 */
function getMysqlData($sqlCode, $rowNumber)
{
  global $conn;
  $result = $conn->query($sqlCode);
  $arrayToPush  = array();
  if ($result->num_rows > 0) 
    {
      // output data of each row
      while($row = $result->fetch_assoc()) 
      {
        $arrayIntermediate = array();

        for ($i=0; $i < count($row); $i++) 
        { 
          array_push($arrayIntermediate, $row["".$i.""]);
        }
        array_push($arrayToPush, $arrayIntermediate);   
      }
    } 
    else 
    {
      echo "0 results";
    }
    return $arrayToPush;
}

//var_dump( getMysqlData("SELECT autLastName as '0', autFirstName as '1' FROM t_author", 2));

$t_book_author = getMysqlData("SELECT booTitle as '0',autFirstName as '1', autLastName as '2' FROM t_book
INNER JOIN t_author on t_book.idAuthor = t_author.idAuthor",3);

var_dump ($t_book_author);

$t_author_names = array();

if (isset($_GET["getAut"]))
{
  if ($_GET["getAut"]=="allName")
  {
    $t_author_names = getMysqlData("SELECT autLastName as '0', autFirstName as '1' FROM t_author", 2);

  }
}


$t_category =array();

if (isset($_GET["getCat"])) {
  if ($_GET["getCat"]=="allName") {
    
    //Et là on recommence ce qu'on avait avant
    $sql = "SELECT catName FROM t_category";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) 
    {
      // output data of each row
      while($row = $result->fetch_assoc()) 
      {
        $strToEnter =  $row["catName"] ;
        array_push($t_category, $strToEnter);
      }
    } 
    else 
    {
      echo "0 results";
    }

  }
}



//Ici on ferme la connection, c'est très important
$conn->close();
?> 

<?php 
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

    
?>