<header>    
    <div class="headerLoginAndNav">
        
        <div class="headerLogo">
            <a href="index.php?page=home"><img src="img/book.png" alt="Livre que elisa a fait"></a>
        </div>
        <nav class = "headerNav">
            <ul>
                <li><a href="index.php?page=home">Home</a></li>
                <li><a href="index.php?page=list&getBoo=all">Liste des ouvrages</a></li>
                <li><a href="index.php?page=add&getAut=allName&getCat=allName">Ajouter un livre</a></li>
                
            </ul>
        </nav>
        <div class = "headerLogin">
            <ul>
                <li><img src="img/bee.png" alt="icone de profil"></li>
                <li><a href="index.php?page=login"><?php
                if (isset($_SESSION["connected"])) 
                 {
                    if ($_SESSION["connected"] == "true") {
                        echo "Disconnect";  
                    }
                    else
                    {
                        echo "Login";                    
                    }
                 }
                 else
                 {
                    echo "Login";
                 }
                 ?></a></li>
            </ul>
        </div>

    </div>

</header>

