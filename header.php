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
        
    </head>

    <body>
        <?php
        if(isset($_GET['message']) && $_GET['message'] == 'creationsuccess'){
            echo "Votre recette a été crée avec succès !";
         }
       ?> 
        <nav class="title">
            <h1 onclick="window.location='home.php'">Miam</h1>
            <div class="onglets">
                <div class="menu">
                 <label class="titre">Catégories</label>
                 <ul class="categories">
                     <li><a href="entree.php">Entrées</a></li>
                     <li><a href="plats.php">Plats</a></li>
                     <li><a href="desserts.php">Desserts</a></li>
                 </ul>
                </div>
                <a href="classement.php" class="titre">Classement</a>
                <div id='profil' class='profil'>
                    <?php
                    if (isset($_SESSION['email'])){
                        include('headerProfil.php');
                    }
                    else{
                        echo 'non connecté';
                        echo" ";
                        echo"<a href=\"connexion.php\">Connexion</a>";
                        echo" ";
                        echo"<a href=\"inscription.php\">Inscription</a>";
                        echo" ";
                    }
                    if(isset($_SESSION['administrateur']) AND $_SESSION['administrateur']==1){
                        echo "<a href=\"listerecette.php\">Recette à gérer</a>";
                        echo" ";
                        echo "<a href=\"liste_ingredient_cout.php\">Mise à jour cout</a>";
                        echo" ";
                        echo "<a href=\"listerecetteVALIDE.php\">Recette du site</a>";
                        echo" ";
                        //echo "<a href=\"nouvellerecette.php\">Nouvelle Recette</a>";
                        echo" ";
                    }elseif(isset($_SESSION['administrateur']) AND $_SESSION['administrateur']==0){
                        echo "<a href=\"nouvellerecette.php\">Nouvelle Recette</a>";
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
