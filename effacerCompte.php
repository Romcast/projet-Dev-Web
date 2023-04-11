<?php
require ('sqlConn.php');

session_start();

$email = $_SESSION['email'];
$mdp=$_GET['password'];

$erreur = false;

if ($mdp == $_SESSION['password']){
    $conn->query("DELETE FROM utilisateur WHERE email ='$email'");
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