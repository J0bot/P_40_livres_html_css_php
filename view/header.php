<!-- Header du site -->
<header class="p-3   ">
  <div class="container">
    <div class="d-flex flex-wrap align-items-center justify-content-center">

      <!-- Menu de navigation -->
      <ul class="nav col-12 col-lg-auto me-lg-auto mb-2  mb-md-0 nav nav-pills nav-justified navContainer">
        <li><a href="?page=home" class="nav-link px-2  <?=isset($_GET["page"]) ? ($_GET["page"] == "home" ? "active" : "") : "" ?> ">Accueil</a></li>
        <li><a href="?page=list" class="nav-link px-2  <?=isset($_GET["page"]) ? ($_GET["page"] == "list" ? "active" : "") : "" ?>">Liste des ouvrages</a></li>
        <?php if (!isset($_SESSION["logged"])) {$_SESSION["logged"]= 0;}
        if ($_SESSION["logged"]==1) {if ($_SESSION["adminRights"]==1) {
          ?>
          <li><a href="?page=add" class="nav-link px-2  <?=isset($_GET["page"]) ? ($_GET["page"] == "add" ? "active" : "") : "" ?>">Ajouter un livre</a></li>
          <li><a href="?page=addUser" class="nav-link px-2  <?=isset($_GET["page"]) ? ($_GET["page"] == "addUser" ? "active" : "") : "" ?>">Ajouter un user</a></li>
          
          <?php
        } }
        ?>
        <li>

          <!-- Barre de recherche d'un ouvrage -->
          <form action="?page=search" method="GET" >
            <input type="text" placeholder="Rechercher" value="<?=isset($_GET["search"]) ? $_GET["search"]: ""?>" name="search">
            <button type="submit"><i class="fa fa-search"></i></button>
          </form>
        </li>
        
      </ul>

      <!-- Bouton de connexion -->
      <div class="text-end">
        <?php include("view/login_button.php");?>
      </div>
    </div>
  </div>
</header>