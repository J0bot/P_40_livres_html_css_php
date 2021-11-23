<?php 
// Auteur :José Carlos Gasser
// Date : 23.11.2021
// Descritption : Page de details d'un ouvrage


?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

     <!--afficher les informations générales de l'oubrage-->
     <div>

        <a href="index.php?page=detail&bookId=<?=$previousBook?>">Livre avant</a>
        <a href="index.php?page=detail&bookId=<?=$nextBook?>">Livre après</a>

         <!--Titre-->
         <h1><?=$book[0]["booTitle"]?></h1>

         <!--insérer l'image du livre actuel -->
        <img src="resources/img/<?php echo "$currentBookData[2]";?>" alt="<?php echo "$currentBookData[1]"; ?>">

        <!--Informations livre-->
        <ul>
            <li>Auteur: <?=$book[0]["autLastName"] . " " . $book[0]["autFirstName"]?></li>
            <li>Categorie:<?=$book[0]["booTitle"]?></li>
            <li>Nb pages:<?=$book[0]["booTitle"]?></li>
            <li>Editeur: <?=$book[0]["booTitle"]?></li>
            <li>Année d'édition: <?=$book[0]["booTitle"]?></li>
            <li><a>insérer logo ici, Télécharger un extrait pdf</a></li>
        </ul>

     </div>
     <div>
         <!--Utiliser le logo et le lien pour l'icône de rating en étoile
        exemple trouvé sur: https://www.w3schools.com/howto/howto_css_star_rating.asp-->
        <h2>Note moyenne des utilisateurs</h2>
        <?php 
            for ($i=0; $i < 5; $i++) { 
                if ($i < $book[0]["booReviewAverage"]) {
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

