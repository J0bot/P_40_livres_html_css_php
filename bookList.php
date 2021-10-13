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
        for ($i=0; $i < count($t_book_author); $i++) { 
            echo "<tr>";
            echo "<th>" . "jobot". "</th>"; //'<th><img src="img/'.$books[$i]["image"].'" alt="ouais"></th>';
            echo "<th>" . $t_book_author[$i]["0"]. "</th>";
            echo "<th>" . $t_book_author[$i]["1"]." ".$t_book_author[$i]["2"]. "</th>";
            echo "<th>" . "jobot". "</th>";
            echo "</tr>";
        }
    ?>

</table>

