<?php
session_start();
?>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="header.css" rel="stylesheet" type="text/css">
        
    </head>

    <body>
        
        <nav class="title">
            <h1>Miam</h1>
            <div class="onglets">
                <a href="home.html">Home</a>
                <div class="menu">
                 <a href="categories.html" class="titre">Catégories</a>
                 <ul class="categories">
                     <li><a href="entree.html">Entrées</a></li>
                     <li><a href="plats.html">Plats</a></li>
                     <li><a href="desserts.html">Desserts</a></li>
                 </ul>
                </div>
                <a href="connexion.php">Connexion</a>
                <a href="inscription.php">Inscription</a>
                <div id='profil' class='profil'>
                    <?php
                    if (isset($_SESSION['email'])){
                        echo '<a href="profil.php" >';
                        echo '<img id="img1" src='. $_SESSION['image'] . ' alt="Introuvable" width="30" height="30" >';
                        echo "</a>";
                        echo $_SESSION['email'];
                    }
                    else{
                        echo 'non connecté';
                    }
                    ?>
                </div>
            </br>
        
                <form action="rechercher" method="get">
                    <input id="barre" type="text" name="text" placeholder="Cherchez une recette">
                    <button type="submit">rechercher</button>
                </form>
            </br>
            </div>
        </nav>

    </body>