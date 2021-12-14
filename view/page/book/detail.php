<?php 
// Auteur :José Carlos Gasser, Elisa Kuoch
// Date : 23.11.2021 - 09.12.2021
// Descritption : Page de details d'un ouvrage

?>
    <!-- Afficher les informations de l'ouvrage-->
    <div class="container">
        <div class="row">
            <div class="col col-1">
                <a href="index.php?page=detail&bookId=<?=$previousBook?>">Livre avant</a>
            </div>
            <div class="col col-1">
                <a href="index.php?page=detail&bookId=<?=$nextBook?>">Livre après</a>
            </div>
        </div>
        <div class="row">
            <div class="col col-3">

                <!-- Insérer l'image du livre actuel -->
                <img class="resizeImage" src="resources/img/<?=$book[0]["booCover"]?>" alt="<?=$book[0]["booTitle"]?>">

            </div>  
            <div class="col col-9">
                <h1><?=$book[0]["booTitle"]?></h1>

                <!-- Informations livre-->
                <ul>
                    <li>Auteur: <?=$book[0]["autLastName"] . " " . $book[0]["autFirstName"]?></li>
                    <li>Categorie: <?=$book[0]["catName"]?></li>
                    <li>Nb pages: <?=$book[0]["booNumberOfPages"]?></li>
                    <li>Editeur: <?=$book[0]["pubName"]?></li>
                    <li>Année d'édition: <?=$book[0]["booPublishingYear"]?></li>
                    <li>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                            <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                            <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                        </svg>
                        <a href="<?=$book[0]["booTeaser"]?>" class="link">Télécharger un extrait pdf</a>
                    </li>
                </ul>
            </div>      
        </div>
    </div>

    <div class="container">

        <!-- Utiliser le logo et le lien pour l'icône de rating en étoile -->
        <!-- Exemple trouvé sur: https://www.w3schools.com/howto/howto_css_star_rating.asp -->
        <div class="row">
            <h2>Note moyenne des utilisateurs</h2>
            <div class="col col-3 ">

                <?php 
                    for ($i=0; $i < 25; $i+=5) { 
                        if ($i < $bookAverage/2) {
                            echo '<span class="fa fa-star checked noHover"></span>' . " ";
                        }
                        else
                        {
                            echo '<span class="fa fa-star noHover"></span>' . " ";
                        }
                    }
                ?>
                
            </div>
        </div>
                    

        <?php if (checkAdmin()!=0) {
            ?>
            <br><h2>Ma note</h2>
            <div class="col col-3">
                <div>
                    <!-- Option de notation des livres par les utilisateurs -->
                    <!-- Source https://codepen.io/jamesbarnett/pen/vlpkh -->
                    <form action="?action=rate&bookId=<?=$_GET["bookId"]?>" method="post">
                        <div class="alignBaseline alignItems">
                            <fieldset class="rating">
                                <input type="radio" id="star5" name="rating" value="50" /><label class = "full" for="star5" ></label>
                                <input type="radio" id="star4half" name="rating" value="45" /><label class="half" for="star4half"></label>
                                <input type="radio" id="star4" name="rating" value="40" /><label class = "full" for="star4" ></label>
                                <input type="radio" id="star3half" name="rating" value="35" /><label class="half" for="star3half" ></label>
                                <input type="radio" id="star3" name="rating" value="30" /><label class = "full" for="star3" ></label>
                                <input type="radio" id="star2half" name="rating" value="25" /><label class="half" for="star2half" ></label>
                                <input type="radio" id="star2" name="rating" value="20" /><label class = "full" for="star2" ></label>
                                <input type="radio" id="star1half" name="rating" value="15" /><label class="half" for="star1half" ></label>
                                <input type="radio" id="star1" name="rating" value="10" /><label class = "full" for="star1" ></label>
                                <input type="radio" id="starhalf" name="rating" value="5" /><label class="half" for="starhalf" ></label>
                            </fieldset> 
                        </div>
                        <button class="btn btn-primary"  type="submit" >Envoyer ma note</button>                   
                    </form>
                </div><br>
            </div>
            <?php
        }?>

        <br>
        <div class="col col-">
        </div>
        
        <!-- Synopsis -->
        <div class="row">
        <h2>Description</h2>
        <p>
            <?=$book[0]["booSummary"]?>
        </p>
    </div>       
</div>