<?php
require('createMiam.php');
if(!isset($_SESSION)){
    session_start();
}
?>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="header.css" rel="stylesheet" type="text/css">
        <link href="site.css" rel="stylesheet" type="text/css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        
    </head>

    <body>
        <?php
        if(isset($_GET['message']) && $_GET['message'] == 'creationsuccess'){
            echo "Votre recette a été crée avec succès !";
         }
       ?> 
        <nav class="title">
            <h1 onclick="window.location='home.php'">Miam</h1>
            <a href="notification.php" class="notification-icon">
        <img class="normal" src="notification-icon.png" alt="Icone de notification normale">
        </a>
            <div class="onglets">
                <div class="menu">
                 <label class="titre">Catégories</label>
                 <ul class="categories">
                    
                     <li><button onclick="window.location='entree.php'">Entrée</button></li>
                     <li><button onclick="window.location='plats.php'">Plat</button></li>
                     <li><button onclick="window.location='desserts.php'">Dessert</button></li>
                 </ul>
                </div>
                <button onclick="window.location='classement.php'">Classement</button>
                <div id='profil' class='profil'>
                   <?php
                    if (isset($_SESSION['email'])){
                        include('headerProfil.php');
                    }
                    else{
                        echo 'non connecté';
                        echo" ";
                        echo "<button onclick=\"window.location='connexion.php'\">Connexion</button>";
                        echo" ";
                        echo "<button onclick=\"window.location='inscription.php'\">Inscription</button>";
                        echo" ";
                    }
                    if(isset($_SESSION['administrateur']) AND $_SESSION['administrateur']==1){
                        echo "<button onclick=\"window.location='listerecette.php'\">Recette à gérer</button>";
                        echo" ";
                        echo "<button onclick=\"window.location='liste_ingredient_cout.php'\">Mise à jour cout</button>";
                        echo" ";
                        echo "<button onclick=\"window.location='listerecetteVALIDE.php'\">Recette du site</button>";
                        echo" ";
                        echo "<button onclick=\"window.location='nouvellerecette.php'\">Nouvelle Recette</button>";
                        echo" ";
                        echo "<button onclick=\"window.location='recettepref.php'\">Recette préférée</button>";
                    }elseif(isset($_SESSION['administrateur']) AND $_SESSION['administrateur']==0){
                        echo "<button onclick=\"window.location='nouvellerecette.php'\">Nouvelle Recette</button>";
                        echo "<button onclick=\"window.location='recettepref.php'\">Recette préférée</button>";
                    }
                    
                    ?>
                </div>
            </br>
        
            <form action="barrederecherche2.0.php" method="get">
                    <input id="rechercher" type="text" name="rechercher" placeholder="Cherchez une recette">
                    <button type="submit">rechercher</button>
            </form>
            </br>
            </div>
        </nav>

    </body>
