<?php 
// Auteur : José Carlos Gasser
// Date : 16.11.2021
// Descritption : page de liste des livres
?>
<div class="container">
    <h1>Liste des ouvrages</h1>

    <!-- Option de tri par catégorie -->
    <form class="row" action="?page=list" method="POST">
        <label class="col col-9 text-end align-middle catFontSize" for="category">Afficher par catégorie :</label>

        <select class="col col-3 form-select col col-3 noflex" onchange="this.form.submit()" name="category" id="category">
        <option value="<?=$cat?>"><?=$cat?></option>
        <?php
        if ($cat!="Tout afficher") {
            ?>
            <option value="Tout afficher">Tout afficher</option>
            <?php
        }
        ?>
        
        <?php 
        foreach ($list_category as $category) 
        {
            if ($category["catName"]!=$cat) {
                echo '<option value="'.$category["catName"].'">'.$category["catName"].'</option>';
            }
        }
        ?>
        </select>
        <noscript><input type="submit" value="Submit"></noscript>   
    </form>



    <table class="table table-hover">
        <tr>
            <th></th>
            <th>Titre</th>
            <th>Auteur</th>
            <th>Pseudo</th>
        </tr>

        <!-- Affiche la liste des ouvrages présents dans la BD -->
        <?php 
            foreach ($list_books as $book) { ?>
                <tr class="listTextStyle">
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


