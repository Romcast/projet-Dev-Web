<?php
    $servername ="localhost";
    $username ="root";
    $password = "";
    $bdd = new PDO("mysql:host=$servername;dbname=miam;", $username, $password);
    if(isset($_GET['valid']) AND !empty($_GET['valid'])){
        $valid_id=$_GET['valid'];
        $valid=$bdd->prepare('UPDATE form_recette SET traitement= "Validé" WHERE id=?');//Cette requete va permettre a l'admin de validé la recette
        $valid->execute(array($valid_id));
       header('Location:listerecette.php');}
?>
