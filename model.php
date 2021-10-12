<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "db_webproject";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully<br>";

$sql = "SELECT autLastName, autFirstName FROM t_author";
$result = $conn->query($sql);

$t_author =array();

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "Name: " . $row["autFirstName"]. " " . $row["autLastName"]. "<br>";

    $strToEnter =  $row["autFirstName"] ." ". $row["autLastName"];
    array_push($t_author, $strToEnter);
  }
} else {
  echo "0 results";
}
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