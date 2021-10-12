<?php 
// Auteur : Larissa De Barros
// Date : 04.10.2021
// Descritption : Page de details d'un ouvrage

include("head.php");

include("header.php");
?>
     <!--afficher les informations générales de l'oubrage-->
     <div>
         <!--Titre-->
         <h1>Titre du livre</h1>
         <!--insérer l'image du livre actuel -->
        <img src="img/cactus.png" alt="cactus">

        <!--Informations livre-->
        <ul>
            <li>Auteur:</li>
            <li>Categorie:</li>
            <li>Nb pages:</li>
            <li>Editeur:</li>
            <li>Année d'édition:</li>
            <li><a>insérer logo ici, Télécharger un extrait pdf</a></li>
        </ul>

     </div>
     <div>
         <!--Utiliser le logo et le lien pour l'icône de rating en étoile
        exemple trouvé sur: https://www.w3schools.com/howto/howto_css_star_rating.asp-->
        <h2>Note moyenne des utilisateurs</h2>
        <span class="fa fa-star checked"></span>
        <span class="fa fa-star checked"></span>
        <span class="fa fa-star checked"></span>
        <span class="fa fa-star"></span>
        <span class="fa fa-star"></span>

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
include("footer.php");

?>

