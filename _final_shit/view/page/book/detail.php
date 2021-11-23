<?php 
<<<<<<< HEAD
// Auteur : José Carlos Gasser
// Date : 16.11.2021
// Descritption : Page de details d'un ouvrage

?>
=======
// Auteur :José Carlos Gasser
// Date : 23.11.2021
// Descritption : Page de details d'un ouvrage


?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
>>>>>>> 7852962cfbe0db0ff6c35a4b7e65ec006f966842

     <!--afficher les informations générales de l'oubrage-->
     <div>

<<<<<<< HEAD
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
=======
        <a href="index.php?page=detail&bookId=<?=$previousBook?>">Livre avant</a>
        <a href="index.php?page=detail&bookId=<?=$nextBook?>">Livre après</a>

         <!--Titre-->
         <h1><?=$book[0]["booTitle"]?></h1>

         <!--insérer l'image du livre actuel -->
        <img src="resources/img/<?=$book[0]["booCover"]?>" alt="<?=$book[0]["booTitle"]?>">

        <!--Informations livre-->
        <ul>
            <li>Auteur: <?=$book[0]["autLastName"] . " " . $book[0]["autFirstName"]?></li>
            <li>Categorie:<?=$book[0]["catName"]?></li>
            <li>Nb pages:<?=$book[0]["booNumberOfPages"]?></li>
            <li>Editeur: <?=$book[0]["pubName"]?></li>
            <li>Année d'édition: <?=$book[0]["booPublishingYear"]?></li>
>>>>>>> 7852962cfbe0db0ff6c35a4b7e65ec006f966842
            <li><a>insérer logo ici, Télécharger un extrait pdf</a></li>
        </ul>

     </div>
     <div>
         <!--Utiliser le logo et le lien pour l'icône de rating en étoile
        exemple trouvé sur: https://www.w3schools.com/howto/howto_css_star_rating.asp-->
        <h2>Note moyenne des utilisateurs</h2>
        <?php 
            for ($i=0; $i < 5; $i++) { 
<<<<<<< HEAD
                if ($i < $currentBookData[10]) {
=======
                if ($i < $book[0]["booReviewAverage"]) {
>>>>>>> 7852962cfbe0db0ff6c35a4b7e65ec006f966842
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

