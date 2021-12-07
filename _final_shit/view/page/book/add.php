<?php 
// Auteur : José Carlos Gasser
// Date : 23.11.2021
// Descritption : Page de ajout d'un ouvrage

?>
<div class="container">
    <h1>Ajout d'un ouvrage</h1>
    <form action="?action=addBook" method="post" enctype="multipart/form-data">

        <div class="formMainContainer">
            <div class="formContainer">
                <!-- ajout image-->
                <div class="formImageBox">
                    <label for="bookImage">Importer le cover</label>
                    <input type="file" id="bookImage" name="bookImage"
                        accept=".jpg, .jpeg, .png" required>
                </div>
                

                <!-- form-->
                <div class="formBox">
                    <div class="formBoxFlex">
                        <label for="title">Titre</label>
                        <input type="text" name="title" value="<?=isset($booTitle) ? $booTitle : ""?>" required/><br>
                    </div>
                    <div class="formBoxFlex">
                        <label class="formLabelBox" for="auteurNom">Nom Auteur</label>
                        <input class="formInputBox" list="auteurNom" name="auteurNom" value="<?=isset($autLastName) ? $autLastName : ""?>" required> <br>
                        <datalist name="auteurNom" id="auteurNom">
                            <?php 
                            foreach($authors as $author)
                            {?>
                                <option value=<?=$author["autLastName"];?>><?=$author["autLastName"]?></option> <?php   
                            }?>
                        </datalist>
                    </div>

                    <div class="formBoxFlex">
                        <label for="auteurPrenom">Prénom Auteur</label> 
                        <input list="auteurPrenom" name="auteurPrenom" value="<?=isset($autFirstName) ? $autFirstName : ""?>" required><br>
                        <datalist name="auteurPrenom" id="auteurPrenom">
                            <?php 
                            foreach($authors as $author)
                            {?>
                                <option value=<?=$author["autFirstName"];?>><?=$author["autFirstName"]?></option> <?php   
                            }?>
                        </datalist>
                    </div>

                    <div class="formBoxFlex">
                        <label for="categorie">Categorie</label>
                        <input list="categorie" name="categorie" required value="<?=isset($catName) ? $catName : ""?>"><br>
                        <datalist  name="categorie" id="categorie">
                            <?php 
                            foreach($categories as $categorie)
                            {?>
                                <option value=<?=$categorie["catName"];?>><?=$categorie["catName"]?></option><?php   
                            }?>
                        </datalist>
                    </div>

                    <div class="formBoxFlex">
                        <label for="editeur">Editeur</label>
                        <input list="editeur" name="editeur" value="<?=isset($pubName) ? $pubName : ""?>" required><br>
                        <datalist  name="editeur" id="editeur" >
                            <?php    
                            foreach($publishers as $publisher)
                            {?>
                                <option value=<?=$publisher["pubName"];?>><?=$publisher["pubName"]?></option><?php   
                            }?>
                        </datalist>
                    </div>

                    <div class="formBoxFlex">
                        <label for="yearEdition">Année d'édition</label><br>
                        <input required type="number" min="1900" max="2099" step="1" value="<?=isset($booPublishingYear) ? $booPublishingYear : "2016"?>"name="yearEdition"  />
                    </div>
                    
                    <div class="formBoxFlex">
                        <label for="pageNumber">Nombre de pages</label>
                        <input required type="number" name="pageNumber" value="<?=isset($booNumberOfPages) ? $booNumberOfPages : ""?>" />
                    </div>

                    <div class="formBoxFlex">
                        <label for="pdfLink">Lien vers extrait pdf</label>
                        <input  type="url" name="pdfLink" value="<?=isset($booTeaser) ? $booTeaser : ""?>" required/>
                    </p>
                </div>
                
            </div><br>
            
        </div>
        <div>
            <label for="description">Descritption:</label><br>
            <textarea id="description" name="description" rows="4" required><?=isset($booSummary) ? $booSummary : ""?></textarea>
            <br>

            <div class="formButtonBox">
                <input class="btn btn-primary formButtonSubmit" type="submit" value="Submit">
            </div>
            
        </div>
    </form>
</div>