
<div class="container mt-3">

<center>
  <p>
    Bienvenue sur notre site web ! Ici vous allez retrouver de nombreux livres, qui ont été soigneusement ajoutés par nos utilisateurs. 
    
  
  </p>
</center>
  

  <div >
    <h2 class="text-center">Derniers livres ajoutés</h2>
    <div class="container " style="display: flex; flex-wrap: wrap; justify-content:center; ">
      <?php 
        foreach($list_books as $book) { 
      ?>
        <div class="card" style="width:250px; height:500px;">

          <div style="height: 65%; ">
            <a href="?page=detail&bookId=<?=$book["idBook"] ?>">
              <img class="card-img-top rounded cardImage" src="resources/img/<?=$book["booCover"]?>" alt="Card image">
            </a>
          </div>

          <div class="card-body " style="height:25%">
            <div class="align-self-end">
              <h4 class="card-title"><?=$book["booTitle"] ?></h4>
              <p class="card-text"></p>
            </div>
          </div>

          <!--
          <div class="card-footer;">
            <a href="?page=detail&bookId=<?=$book["idBook"] ?>" class="btn btn-primary d-flex  justify-content-center">Voir</a>
          </div>
        -->
        </div>
        
      <?php
      }
      ?>
    </div>
  </div>
</div>

