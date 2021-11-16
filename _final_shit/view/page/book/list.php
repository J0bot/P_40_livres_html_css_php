
<h1>Liste des ouvrages</h1>

<table>
    <tr>
        <th>Image</th>
        <th>Titre</th>
        <th>Auteur</th>
        <th>Pseudo</th>
    </tr>

    <?php 
        foreach ($list_books as $book) { 
            echo "<tr>";
            //Ici j'ai mis en 3 lignes pour éviter le code spageth
            echo '<th><a href="index.php?page=detail&bookId='.$book["idBook"];
            echo '"><img style="max-width:200px" src="resources/img/'.$book["booCover"];
            echo '" alt="'.$book["booTitle"].'"></a></th>';
            echo "<th>" . $book["booTitle"]. "</th>";
            echo "<th>" . $book["autFirstName"]." ".$book["autLastName"]. "</th>";
            echo "<th>" . $book["useName"]. "</th>";
            echo "</tr>";
        }
    ?>

</table>

