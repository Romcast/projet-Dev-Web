<?php

$serveur = "localhost";
$user = "root";
$pass = "";
$dbname="miam";

//On se connecte à la BDD
$dbco = new PDO("mysql:host=$serveur;dbname=$dbname",$user,$pass);
$dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try{
    //On crée une table commentaire
    $commentaire = "CREATE TABLE IF NOT EXISTS commentaire(
        commentaire_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
        mail_auteur VARCHAR(50) NOT NULL,
        commentaire VARCHAR(5000),
        note INT,
        recette_id iNT UNSIGNED,
        FOREIGN KEY(recette_id) REFERENCES form_recette(id) ON DELETE CASCADE
        )";
    $dbco->exec($commentaire);
}

catch(PDOException $e){
    echo 'Erreur : '.$e->getMessage();
}
$dbco= null;