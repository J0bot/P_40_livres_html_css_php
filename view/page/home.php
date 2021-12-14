<!-- Page d'accueil -->
<div class="container mt-3">

  <p class="centerText">
    Bienvenue sur notre site web ! Ici vous allez retrouver de nombreux livres, qui ont été soigneusement ajoutés par nos chers administrateurs.
  </p>
  
  <!-- Affiche les derniers ouvrages ajoutés à la BD -->
  <div >
    <h2 class="text-center">Derniers livres ajoutés</h2>
    <div class="container cardContainer">
      <?php 
        foreach($list_books as $book) { 
      ?>
        <div class="card">
          <div class="cardImageContainer">
            <a href="?page=detail&bookId=<?=$book["idBook"] ?>">
              <img class="card-img-top rounded cardImage " src="resources/img/<?=$book["booCover"]?>" alt="Card image">
            </a>
          </div>

          <div class="card-body">
            <div class="align-self-end">
              <h4 class="card-title"><?=$book["booTitle"] ?></h4>
              <p class="card-text"></p>
            </div>
          </div>

        </div>
        
      <?php
      }
      ?>
    </div>
  </div>
</div>

