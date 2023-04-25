<?php
require ('sqlConn.php');

session_start();

$email = $_SESSION['email'];
$mdp=$_GET['password'];

$erreur = false;

if ($mdp == $_SESSION['password']){
    $conn->query("DELETE FROM utilisateur WHERE email ='$email'");
    $conn->query("DELETE FROM commentaire WHERE mail_auteur ='$email'");
    if (basename($_SESSION['image']) !== "utilisateur.png"){
        unlink($_SESSION['image']);
    }
    session_destroy();
}
else{
    $erreur = true;
}

$conn->close();
echo $erreur;
?>