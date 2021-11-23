<?php 
// Auteur : José Carlos Gasser
// Date : 23.11.2021
// Descritption : Page de ajout d'un user
?>    

<h1>Ajout d'un user</h1>
<br>
<form action="?action=addUser" method="post" enctype="multipart/form-data">         
    <p>Username : <input type="text" name="uname" required/></p>
    <p>Password : <input type="password" name="psw" required/></p>
    <p>Droits Admin : <input type="checkbox" name="admin" id="admin"></p>
    <button type="submit">Submit</button>
</form>

