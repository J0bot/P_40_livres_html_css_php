<?php 
// Auteur : José Carlos Gasser
// Date : 23.11.2021
// Descritption : Page de ajout d'un ouvrage

?>
<div class="container">
    <h1>Ajout d'un ouvrage</h1>
    <form action="?action=addBook" method="post" enctype="multipart/form-data">

    
        <div class="">
            <div class="row">
                <!-- ajout image-->
                <div class="col col-5">
                    <label for="bookImage">Importer le cover</label>
                    <input type="file" id="bookImage" name="bookImage" onchange="PreviewImage();" accept=".jpg, .jpeg, .png" required>
                    <br>
                    <img id="uploadPreview" style="width: auto; height: 300px;" />
                </div>

                <script type="text/javascript">
                    //Cette fonction permet de preview l'image qu'on vient d'importer
                    function PreviewImage() {
                        var oFReader = new FileReader();
                        oFReader.readAsDataURL(document.getElementById("bookImage").files[0]);

                        oFReader.onload = function (oFREvent) {
                            document.getElementById("uploadPreview").src = oFREvent.target.result;
                        };
                    };

                </script>
                
                <!--form-->
                <div class="col col-7">
                    <div class="row">
                        <!--labels-->
                        <div class="row">
                            <label class="col col-2" for="title">Titre</label>
                            <input id="title" class="col col-10" type="text" name="title" value="<?=isset($booTitle) ? $booTitle : ""?>" required/><br>
                        </div>
                        <div class="row">
                            <label class="col col-2" for="auteurNom">Nom Auteur</label>
                            <input class="col col-10" list="auteurNom" name="auteurNom"  value="<?=isset($autLastName) ? $autLastName : ""?>" required> <br>
                            <datalist id="auteurNom" >
                                <?php 
                                foreach($authors as $author)
                                {?>
                                    <option value="<?=$author["autLastName"];?>"><?=$author["autLastName"]?></option> <?php   
                                }?>
                            </datalist>

                        </div>
                        <div class="row">
                            <label class="col col-2" for="auteurPrenom">Prénom Auteur</label>
                            <input class="col col-10" list="auteurPrenom" name="auteurPrenom" value="<?=isset($autFirstName) ? $autFirstName : ""?>" required><br>
                            <datalist  id="auteurPrenom" >
                                <?php 
                                foreach($authors as $author)
                                {?>
                                    <option value="<?=$author["autFirstName"];?>"><?=$author["autFirstName"]?></option> <?php   
                                }?>
                            </datalist>
                            
                        </div>
                        <div class="row">
                            <label class="col col-2" for="categorie">Categorie</label>
                            <input  class="col col-10" list="categorie" name="categorie" required value="<?=isset($catName) ? $catName : ""?>"><br>
                            <datalist id="categorie"  >
                                <?php 
                                foreach($categories as $categorie)
                                {?>
                                    <option value="<?=$categorie["catName"];?>"><?=$categorie["catName"]?></option><?php   
                                }?>
                            </datalist>
                            
                        </div>
                        <div class="row">
                            <label class="col col-2" for="editeur">Editeur</label>
                            <input class="col col-10"  list="editeur" name="editeur" value="<?=isset($pubName) ? $pubName : ""?>" required><br>
                            <datalist id="editeur"  >
                                <?php    
                                foreach($publishers as $publisher)
                                {?>
                                    <option value="<?=$publisher["pubName"];?>"><?=$publisher["pubName"]?></option><?php   
                                }?>
                            </datalist>
                            
                        </div>
                        <div class="row">
                            <label class="col col-2" for="yearEdition">Année d'édition</label>
                            <input id="yearEdition" class="col col-10" required type="number" min="1900" max="2099" step="1" value="<?=isset($booPublishingYear) ? $booPublishingYear : "2016"?>" name="yearEdition"  /><br>
                            
                        </div>
                        <div class="row">
                            <label class="col col-2" for="pageNumber">Nombre de pages</label>
                            <input id="pageNumber" class="col col-10" required type="number" name="pageNumber" value="<?=isset($booNumberOfPages) ? $booNumberOfPages : ""?>" /> <br>
                            
                        </div>
                        <div class="row">
                            <label class="col col-2" for="pdfLink">Lien vers extrait pdf</label>
                            <input id="pdfLink" class="col col-10" type="url" name="pdfLink" value="<?=isset($booTeaser) ? $booTeaser : ""?>" required/>
                            
                        </div>
                        
                
                    </div>
                    
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