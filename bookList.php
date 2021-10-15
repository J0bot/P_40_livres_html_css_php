<?php include("model.php"); ?>


<h1>Liste des ouvrages</h1>

<table>
    <tr>
        <th>Image</th>
        <th>Titre</th>
        <th>Auteur</th>
        <th>Pseudo</th>
    </tr>

    <?php 
        for ($i=0; $i < count($t_book_author_img); $i++) { 
            echo "<tr>";
            //Ici j'ai mis en 3 lignes pour éviter le code spageth
            echo '<th><a href="index.php?page=detail&bookId='.$t_book_author_img[$i]["5"];
                echo '"><img src="img/'.$t_book_author_img[$i]["3"];
                echo '" alt="'.$t_book_author_img[$i]["0"].'"></a></th>';
            echo "<th>" . $t_book_author_img[$i]["0"]. "</th>";
            echo "<th>" . $t_book_author_img[$i]["1"]." ".$t_book_author_img[$i]["2"]. "</th>";
            echo "<th>" . $t_book_author_img[$i]["4"]. "</th>";
            echo "</tr>";
        }
    ?>

</table>

