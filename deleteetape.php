<?php
    require('header.php'); 
    // on se connecte a la base de donnée
    $servername ="localhost";
    $username ="root";
    $password = "";
    $bdd = new PDO("mysql:host=$servername;dbname=miam;", $username, $password);
    //si le bouton supprimer est pressé par l'admin on supprime l'etape de la base de donnee
    if(isset($_GET['delete']) AND !empty($_GET['delete'])){
        $delete_id=$_GET['delete'];
        $delete=$bdd->prepare('DELETE FROM form_etape WHERE id=?');
        $delete->execute(array($delete_id));
        echo 'L\'étape a bien été supprimée !';
    }
?>
