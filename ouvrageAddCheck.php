<?php 

if (isset($_FILES["bookImage"]) and
    isset($_POST["title"]) and 
    isset($_POST["auteur"]) and
    isset($_POST["categorie"]) and
    isset($_POST["editeur"]) and
    isset($_POST["yearEdition"]) and
    isset($_POST["pageNumber"]) and
    isset($_POST["pdfLink"]) and
    isset($_POST["description"])) 
{
    move_uploaded_file($_FILES["bookImage"]["tmp_name"], "img/"  .$_FILES["bookImage"]["name"] );
}
else
{
    header("Location:index.php?page=add&error=yes");
}


?>

<h1>Review du Submit</h1>

<p>Titre: <?php echo $_POST["title"];?></p>
<p>Image de couverture :</p>
<img src="img/<?php echo $_FILES["bookImage"]["name"];?>" alt="<?php echo $_POST["title"];?>">
<p>Auteur: <?php echo $_POST["auteur"];?></p>
<p>Categorie: <?php echo $_POST["categorie"];?></p>
<p>Editeur: <?php echo $_POST["editeur"];?></p>
<p>Année d'édition: <?php echo $_POST["yearEdition"];?></p>
<p>Nombre de pages: <?php echo $_POST["pageNumber"];?></p>
<p>Lien vers extrait pdf: <?php echo $_POST["pdfLink"];?></p>
<p>Descritption: <?php echo $_POST["description"];?></p>

