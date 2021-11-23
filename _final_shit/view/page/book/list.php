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
</table>

