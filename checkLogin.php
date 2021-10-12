<?php
session_start();
include("head.php");
include("header.php");
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
            $_SESSION["errorMessage"] = "Veuillez remplir tous les champs. <br><a href=loginContent.php>revenir à la page de login</a>";
            header("location:loginContent.php");
        }
    }
    else{
        $_SESSION["errorMessage"] = "Veuillez remplir tous les champs. <br><a href=loginContent.php>revenir à la page de login</a>";
        header("location:loginContent.php");
    }

    include("footer.php");
?>