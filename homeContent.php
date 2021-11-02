<?php 
// Auteur : José Carlos Gasser
// Date : 04.10.2021
// Descritption : Page de sommaire final

include("model.php");
?>

 <div class ="headerTitle">
        <h1>Projet Ouvrages</h1>
</div>

<div class ="homeContent">
    <div class="homeContentContainer">
        <div class="homeContentText">
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
                sed do eiusmod tempor incididunt ut labore et dolore magna 
                aliqua. Ut enim ad minim veniam, quis nostrud exercitation 
                ullamco laboris nisi ut aliquip ex ea commodo consequat. 
                Duis aute irure dolor in reprehenderit in voluptate velit esse 
                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat 
                cupidatat non proident, sunt in culpa qui officia deserunt mollit 
                anim id est laborum
            </p>
        </div>
        <div class="homeContentLastOuvrages">
            <div class="homeContentLastOuvragesTitle">
                <h2>Derniers ouvrages ajoutés</h2>
            </div>
            <div class="homeContentLastOuvragesContainer">

                <?php 
                    for ($i=0; $i < 5; $i++) { 
                
                        echo '<a class="linkBookHome" href="index.php?page=detail&bookId='.$t_book_cover_name[$i][2].'"><div class="lastOuvrageBox">';
                            echo '<div class="lastOuvrageBoxImg">';
                                echo '<img src="resources/img/' .$t_book_cover_name[$i][1].'" alt="'.$t_book_cover_name[$i][0].'"> ';
                            echo '</div>';
                            echo '<p>'. $t_book_cover_name[$i][0].'</p>';
                        echo '</div></a>';
                    }
                ?>

                

            </div>
        </div>
    </div>
</div>