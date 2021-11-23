<?php 
// Auteur : José Carlos Gasser
// Date : 16.11.2021
// Descritption : page de liste des livres
?>
<h1>Liste des ouvrages</h1>

<table class="table table-hover" style="width: 80%; margin:auto;">
    <tr>
        <th>Image</th>
        <th>Titre</th>
        <th>Auteur</th>
        <th>Pseudo</th>
    </tr>

    <?php 
<<<<<<< HEAD
        foreach ($list_books as $book) {
            ?> 
            <tr>
            <th><a href="index.php?page=detail&bookId=<?=$book["idBook"];?>"><img style="max-width:200px" src="resources/img/<?=$book["booCover"];?>" alt="<?=$book["booTitle"];?>"></a></th>
            <th><?=$book["booTitle"]?></th>
            <th><?=$book["autFirstName"]?> <?=$book["autLastName"]?></th>
            <th><?=$book["useName"]?></th>
            </tr>
            <?php
        }
    ?>
=======
        foreach ($list_books as $book) { ?>
            <tr>
            <th>
                <a href="index.php?page=detail&bookId=<?=$book["idBook"]?>">
                <img style="max-width:100px" src="resources/img/<?=$book["booCover"]?>" alt="<?=$book["booTitle"]?>"></a>
            </th>
            <th><?=$book["booTitle"]?></th>
            <th><?=$book["autFirstName"]?> <?=$book["autLastName"]?></th>
            <th><?=$book["useName"]?></th>
        </tr><?php
        }?>
>>>>>>> 7852962cfbe0db0ff6c35a4b7e65ec006f966842
</table>

