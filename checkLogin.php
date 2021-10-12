<?php
/**
 * auteur : Elisa Kuoch
 * date : 12.10.2021
 * description : check du login
 *              il faut hash le mot de passe
 */
    if(isset($_POST["username"])&&($_POST["username"]!="")){
        if($_POST["username"]=="Elisa"&&$_POST["password"]==1234){
            echo "connexion réussie";
        }
        else{
            echo "L'identifiant ou le mot de passe est incorrect. <br>";
            echo "<a href=loginContent.php>revenir à la page de login</a>";
        }
    }
    else{
        echo "Veuillez remplir tous les champs. <br>";
        echo "<a href=loginContent.php>revenir à la page de login</a>";
    }

?>