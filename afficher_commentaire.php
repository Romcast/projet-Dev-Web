<link href="afficher_commentaire.css" rel="stylesheet" type="text/css">
<?php

$serveur = "localhost";
$user = "root";
$pass = "";
$dbname="miam";
$recette_id=$_SESSION['recette_id'];
//On se connecte à la BDD
$dbco = new PDO("mysql:host=$serveur;dbname=$dbname",$user,$pass);
$dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
try{
    if (isset($_GET['id'])) {
        $statement=$dbco->prepare("SELECT mail_auteur,commentaire,note FROM commentaire WHERE recette_id=$recette_id");//id est defini dans visuelrecette.php
        $statement->execute();
        $commentaires=$statement->fetchAll(PDO::FETCH_ASSOC);
        foreach($commentaires as $commentaire){
            echo '<div style="border:2px solid black">' . $commentaire['mail_auteur']. ' a écrit: ' . $commentaire['commentaire'] . ' et a donné une note de ' . $commentaire['note'] . '</div>';
        }
    }
    
    
}


catch(PDOException $e){

}

$dbco=null;
    ?>
    