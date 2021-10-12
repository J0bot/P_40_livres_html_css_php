<!--
    auteur : elisa kuoch
    date : 12.10.2021
    description : page de login
-->

<!--Page de Login, titre, labels et input-->

<h1>Login</h1>
<form method="post" action="checkLogin.php">
    <p>
        <label for="username">Username</label><br>
        <input type="text" name="username" id="pseudo"/>
    </p>
    <p>
        <label for="password">Password</label><br>
        <input type="password" name="password" id="password"/>
    </p>
    <p>
        <input type="submit" name="btnSubmit" value="Se connecter" />
    </p>  
    
</form> 
<?php
    if(isset($_SESSION["errorMessage"])){
        $message = $_SESSION['errorMessage'];
        echo "<br><p>$message</p>";
    }
?>




