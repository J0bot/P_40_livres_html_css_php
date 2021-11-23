<header class="p-3 bg-dark text-white">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
          <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="#" class="nav-link px-2 text-secondary">
              
          </a></li>
          <li><a href="?page=home" class="nav-link px-2 text-white">Accueil</a></li>
          <li><a href="?page=list" class="nav-link px-2 text-white">Liste des ouvrages</a></li>
          <li><a href="?page=add" class="nav-link px-2 text-white">Ajouter un livre</a></li>
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