<?php 
// Auteur : José Carlos Gasser
// Date : 04.10.2021
// Descritption : Page de sommaire final

include ("data.php");
?>



<h1>Ajout d'un ouvrage</h1>

<form action="ouvrageAddCheck.php" method="post">

    <input type="file" id="bookImage" name="bookImage"
          accept=".jpg, .jpeg, .png">

    <p>
        <label for="title">Titre</label>
        <input type="text" name="title" />
    </p>

    <label for="auteur">Auteur</label>
    <select name="auteur" id="auteur">
        <?php 
        for ($i=0; $i < count($auteur); $i++) { 
            echo "<option value=".$auteur[$i].">".$auteur[$i]."</option>";
        }
        ?>
    </select>

    <br><br>

    <label for="categorie">Categorie</label>
    <select name="categorie" id="categorie">
        <?php 
        for ($i=0; $i < count($categorie); $i++) { 
            echo "<option value=".$categorie[$i].">".$categorie[$i]."</option>";
        }
        ?>
    </select>

    <br><br>

    <label for="editeur">Editeur</label>
    <select name="editeur" id="editeur">
        <?php 
        for ($i=0; $i < count($editeur); $i++) { 
            echo "<option value=".$editeur[$i].">".$editeur[$i]."</option>";
        }
        ?>
    </select>
  
    <p>
        <label for="yearEdition">Année d'édition</label>
        <input type="number" min="1900" max="2099" step="1" value="2016" name="yearEdition" />
    </p>

    <p>
        <label for="pageNumber">Nombre de pages</label>
        <input type="number" name="pageNumber" />
    </p>

    <p>
        <label for="pdfLink">Lien vers extrait pdf</label>
        <input type="url" name="pdfLink" />
    </p>
        
    <label for="description">Descritption:</label>
    <br>
    <textarea id="description" name="description" rows="4" cols="50">
    </textarea>
    <br>
    <input type="submit" value="Submit">


</form>

