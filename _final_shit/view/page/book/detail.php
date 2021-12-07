<?php 
// Auteur :José Carlos Gasser
// Date : 23.11.2021
// Descritption : Page de details d'un ouvrage


?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

     <!--afficher les informations générales de l'oubrage-->
     <div class="container">
         <div class="row">
            <a href="index.php?page=detail&bookId=<?=$previousBook?>">Livre avant</a>
            <a href="index.php?page=detail&bookId=<?=$nextBook?>">Livre après</a>

         </div>
        <div class="row">
            <div class="col col-3">
                <!--insérer l'image du livre actuel -->
            <img src="resources/img/<?=$book[0]["booCover"]?>" alt="<?=$book[0]["booTitle"]?>">

            </div>
            <div class="col col-9">
            <h1><?=$book[0]["booTitle"]?></h1>

            
<!--Informations livre-->
<ul>
    <li>Auteur: <?=$book[0]["autLastName"] . " " . $book[0]["autFirstName"]?></li>
    <li>Categorie:<?=$book[0]["catName"]?></li>
    <li>Nb pages:<?=$book[0]["booNumberOfPages"]?></li>
    <li>Editeur: <?=$book[0]["pubName"]?></li>
    <li>Année d'édition: <?=$book[0]["booPublishingYear"]?></li>
    <li><a>insérer logo ici, Télécharger un extrait pdf</a></li>
</ul>

</div>
<div class="container">
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
<br><button class="btn btn-primary">Noter cet ouvrage</button>
            </div>
            
            <!--Titre-->
            
        </div>
        <div class="row">
            <article>
            <!--Insérer la description de l'ouvrage ici-->
            </article>
        </div>
        
     </div>

    
<?php 

?>

