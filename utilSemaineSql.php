<?php
require('sqlConn.php');
$user = $conn->query("SELECT * FROM utilisateur WHERE util_semaine = 1");
if ($user->num_rows > 0) {
    $row = $user->fetch_assoc();
    $email = $row['email'];
    $nom = $row['nom'];
    $prenom = $row['prenom'];
    $note_moy = $row['note_moy'];
    $image = $row['image'];
    $date = $row['date_creation'];
    include('utilSemaine.php');
}
$conn->close();
?>


