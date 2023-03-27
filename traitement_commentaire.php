<?php
$nom = $_POST['nom'];
$email = $_POST['email'];
$commentaire = $_POST['commentaire'];

// Enregistrez les données dans une base de données ou un fichier

// Rediriger vers la page de commentaires
header('Location: commentaires.php');
exit;
?>
