<?php
    $servername ="localhost";
    $username ="root";
    $password = "";
    $bdd = new PDO("mysql:host=$servername;dbname=miam;", $username, $password);
    $allrecepi=$bdd->query('SELECT nomrecette FROM recette');
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Barre de recherche</title>
        <meta charset="utf-8">
    </head>
    <body>
        <form method="GET">
            <input type="search" name="rechercher" placeholder="Mots-clés">
            <input type="submit" name="Entrée">
        </form>
    </body>
</html>