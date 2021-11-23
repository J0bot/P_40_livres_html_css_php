<?php 
// Auteur : José Carlos Gasser
// Date : 23.11.2021
// Descritption : Page de ajout d'un ouvrage

?>

<h1>Ajout d'un ouvrage</h1>

<form action="#" method="post" enctype="multipart/form-data">

    <label for="bookImage">Importer le cover</label>
    <input type="file" id="bookImage" name="bookImage"
        accept=".jpg, .jpeg, .png" required>

    <p>
        <label for="title">Titre</label>
        <input type="text" name="title" required/>
    </p>

    <label for="auteur">Auteur</label>
    <input list="auteur" name="auteur" required>
    <datalist name="auteur" id="auteur">
        <?php 
        foreach($authors as $author)
        {?>
            <option value=<?=$author["idAuthor"];?>><?=$author["autLastName"]." ".$author["autFirstName"]?></option> <?php   
        }?>
        
    </datalist>

    <br><br>

    <label for="categorie">Categorie</label>
    <input list="categorie" name="categorie" required>
    <datalist  name="categorie" id="categorie">
        <?php 
        foreach($categories as $categorie)
        {?>
            <option value=<?=$categorie["idCategory"];?>><?=$categorie["catName"]?></option><?php   
        }?>
    </datalist>

    <br><br>

    <label for="editeur">Editeur</label>
    <input list="editeur" name="editeur" required>
    <datalist  name="editeur" id="editeur" >
        <?php    
        foreach($publishers as $publisher)
        {?>
            <option value=<?=$publisher["idPublisher"];?>><?=$publisher["pubName"]?></option><?php   
        }?>
    </datalist>
        <br><br>
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
        <input  type="url" name="pdfLink" required/>
    </p>
        
    <label for="description">Descritption:</label>
    <br>
    <textarea id="description" name="description" rows="4" cols="50" required></textarea>
    <br>
    <input type="submit" value="Submit">
</form>

