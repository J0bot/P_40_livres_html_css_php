<?php 
// Auteur : José Carlos Gasser
// Date : 14.12.2021
// Descritption : page recherche d'un ouvrage
?>
<div class="container">
    <h1>Recherche d'un ouvrage</h1>

    <table class="table table-hover">
        <tr>
            <th></th>
            <th>Titre</th>
            <th>Auteur</th>
            <th>Pseudo</th>
        </tr>

        <?php 
            foreach ($list_books as $book) { ?>
                <tr class="listTextStyle ">
                    <th class="widthColSimple">
                        <a href="index.php?page=detail&bookId=<?=$book["idBook"]?>">
                        <img style="max-width:150px" src="resources/img/<?=$book["booCover"]?>" alt="<?=$book["booTitle"]?>"></a>
                    </th>
                    <th><a href="index.php?page=detail&bookId=<?=$book["idBook"]?>"><?=$book["booTitle"]?></a></th>
                    <th><?=$book["autFirstName"]?> <?=$book["autLastName"]?></th>
                    <th><a href="?page=detail&userId=<?=$book["useName"]?>"><?=$book["useName"]?></a></th>
                </tr><?php
            }?>
    </table>
</div>


