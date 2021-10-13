<?php 
// Auteur : José Carlos Gasser
// Date : 04.10.2021
// Descritption : Page de sommaire final

include ("model.php");
?>



<h1>Ajout d'un ouvrage</h1>

<form action="ouvrageAddCheck.php" method="post">

    <input type="file" id="bookImage" name="bookImage"
          accept=".jpg, .jpeg, .png" required>

    <p>
        <label for="title">Titre</label>
        <input type="text" name="title" />
    </p>

    <label for="auteur">Auteur</label>
    <input list="auteur" name="auteur">
    <datalist required name="auteur" id="auteur">
        <?php 
        for ($i=0; $i < count($t_author_names); $i++) { 
            $fullName = $t_author_names[$i][1]." ".$t_author_names[$i][0];
            echo "<option value=".$fullName.">".$fullName."</option>";
        }
        ?>
    </datalist>

    <br><br>

    <label for="categorie">Categorie</label>
    <input list="categorie" name="categorie">
    <datalist required name="categorie" id="categorie">
        <?php 
        for ($i=0; $i < count($t_category_name); $i++) { 
            echo "<option value=".$t_category_name[$i].">".$t_category_name[$i]."</option>";
        }
        ?>
    </datalist>

    <br><br>

    <label for="editeur">Editeur</label>
    <input list="editeur" name="editeur">
    <datalist required name="editeur" id="editeur">
        <?php 
        for ($i=0; $i < count($t_publisher_names); $i++) { 
            echo "<option value=".$t_publisher_names[$i].">".$t_publisher_names[$i]."</option>";
        }
        ?>
    </datalist>
  
    <p>
        <label for="yearEdition">Année d'édition</label>
        <input required type="number" min="1900" max="2099" step="1" value="2016" name="yearEdition" />
    </p>

    <p>
        <label for="pageNumber">Nombre de pages</label>
        <input required type="number" name="pageNumber" />
    </p>

    <p>
        <label for="pdfLink">Lien vers extrait pdf</label>
        <input required type="url" name="pdfLink" />
    </p>
        
    <label for="description">Descritption:</label>
    <br>
    <textarea id="description" name="description" rows="4" cols="50">
    </textarea>
    <br>
    <input type="submit" value="Submit">


</form>

