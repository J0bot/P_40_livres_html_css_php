<header class="p-3   nav nav-pills nav-justified">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">

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
        </ul>

        <?php 
        //Tout ce code permet de faire une bar de search, mais du coup mes camarades n'en veulent psa et c'est très dommage pck ça pourrait faire des truc mega classes et tout du coup ouais minecrafz c'est un jeu mega cool, et ouais. 
        /*
        <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
          <input type="search" class="form-control form-control-dark" placeholder="Search..." aria-label="Search">
        </form>
        */
        ?>
        <div class="text-end">
          <?php include("view/login_button.php");?>
        </div>
      </div>
    </div>
  </header>