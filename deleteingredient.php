<?php
    require('header.php');   
    $servername ="localhost";
    $username ="root";
    $password = "";
    $bdd = new PDO("mysql:host=$servername;dbname=miam;", $username, $password);
    if(isset($_GET['delete']) AND !empty($_GET['delete'])){
        $delete_id=$_GET['delete'];
        $delete=$bdd->prepare('DELETE FROM form_ingredient WHERE id=?');
        $delete->execute(array($delete_id));
        echo 'L\'ingredient a bien été supprimé !';
    }
?>