<!-- Fenêtre de connexion -->
<?php
if (!isset($_SESSION["logged"])) {$_SESSION["logged"]= 0;}
if ($_SESSION["logged"] ==0) {
  ?>
  
<!-- Bouton de connexion -->
<button onclick="document.getElementById('id01').style.display='block'" class="btn btn-outline-light me-2 buttonStyle" style="width:auto;">Login</button>

<!-- Pop-up pour la connexion -->
<div id="id01" class="modal">
  
  <form class="modal-content animate" action="?action=login" method="post" style="min-width: 300px;">

    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal" >&times;</span>
    </div>

    <div class="container" >
      <div style="text-align: start;">
        <label for="uname" style="color: black;"><b>Username</b></label>
        <input id="uname" class="input_conn" type="text" placeholder="Enter Username" name="uname" required>

        <label for="psw" style="color: black;"><b>Password</b></label>
        <input id="psw" class="input_conn" type="password" placeholder="Enter Password" name="psw" required>

        <button  type="submit" class="btn btn-primary d-flex  justify-content-center">Login</button>
        <span class="psw" style="color: black;">Forgot <a href="?page=addUser">password?</a></span>
      </div>
    </div>

  </form>
</div>

<script>
//Obtenir le model
var modal = document.getElementById('id01');

//Ferme la fenêtre de connexion si on clique ailleurs sur la page
window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
}
</script>

<!-- Si connecté, affiche le bouton "Disconnect" -->
<?php
}
elseif($_SESSION["logged"] ==1)
{
  ?>
  <div class="row alignBaseline">
    <p style="width:auto;"><?=$_SESSION["username"]?> (<?=$_SESSION["adminRights"] == 1 ? "admin": "user"?>)</p>
    <button onclick="location.replace('?action=disconnect')" class="btn btn-outline-light me-2 buttonStyle" style="width:auto;">Disconnect</button>
    
  </div>
  
  <?php
}
?>