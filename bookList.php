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
        for ($i=0; $i < count($books); $i++) { 
            echo "<tr>";
            echo '<th><img src="img/'.$books[$i]["image"].'" alt="ouais"></th>';
            echo "<th>" . $books[$i]["title"]. "</th>";
            echo "<th>" . $books[$i]["author"]. "</th>";
            echo "<th>" . $books[$i]["pseudo"]. "</th>";
            echo "</tr>";
        }
    ?>

</table>

