<?php 
// Auteur : José Carlos Gasser
// Date : 16.11.2021
// Descritption : Page de details d'un ouvrage

?>

     <!--afficher les informations générales de l'oubrage-->
     <div>

         <!--Titre-->
         <h1><?=$book["booTitle"]; ?></h1>

         <!--insérer l'image du livre actuel -->
        <img src="resources/img/<?php echo "$currentBookData[2]";?>" alt="<?php echo "$currentBookData[1]"; ?>">

        <!--Informations livre-->
        <ul>
            <li>Auteur: <?php echo "$currentBookData[3]"; ?> <?php echo "$currentBookData[4]"; ?></li>
            <li>Categorie: <?php echo "$currentBookData[5]"; ?></li>
            <li>Nb pages: <?php echo "$currentBookData[6]"; ?></li>
            <li>Editeur: <?php echo "$currentBookData[7]"; ?></li>
            <li>Année d'édition: <?php echo "$currentBookData[8]"; ?></li>
            <li><a>insérer logo ici, Télécharger un extrait pdf</a></li>
        </ul>

     </div>
     <div>
         <!--Utiliser le logo et le lien pour l'icône de rating en étoile
        exemple trouvé sur: https://www.w3schools.com/howto/howto_css_star_rating.asp-->
        <h2>Note moyenne des utilisateurs</h2>
        <?php 
            for ($i=0; $i < 5; $i++) { 
                if ($i < $currentBookData[10]) {
                    echo '<span class="fa fa-star checked"></span>';
                }
                else
                {
                    echo '<span class="fa fa-star"></span>';
                }
            }
        ?>

        <br><br>

        <h2>Ma note</h2>
        <span class="fa fa-star checked"></span>
        <span class="fa fa-star checked"></span>
        <span class="fa fa-star checked"></span>
        <span class="fa fa-star"></span>
        <span class="fa fa-star"></span>
        <!--Je pense que le rajout du bouton n'est pas nécessaire pour traiter
        a discuter dans l'implémentation-->
        <button>Noter cet ouvrage</button>
     </div>

    <article>
        <!--Insérer la description de l'ouvrage ici-->
    </article>
<?php 

?>

