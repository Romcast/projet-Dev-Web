<?php
require('sqlConn.php');
$user = $conn->query("SELECT * FROM utilisateur WHERE util_semaine = 1");
if ($user->num_rows > 0) {
    $row = $user->fetch_assoc();
    $id_user = $row['id_user'];
    $email = $row['email'];
    $recette = $conn->query("SELECT * FROM form_recette WHERE auteur = '$email' AND note = (SELECT MAX(note) FROM form_recette WHERE auteur = '$email') LIMIT 1");
    if ($recette != false && $recette->num_rows > 0){
        $nom = $row['nom'];
        $prenom = $row['prenom'];
        $note_moy = $row['note_moy'];
        $image = $row['image'];
        $date = $row['date_creation'];

        $row2 = $recette->fetch_assoc();
        $id_recette = $row2['id'];
        $photo_recette = $row2['photo'];
        $nom_recette = $row2['nom'];
        $type = $row2['type_repas'];
        $difficulte = $row2['difficulte'];
        $nombre_personnes = $row2['nombre_personnes'];
        $note_recette = $row2['note'];
        $cout = $row2['cout_recette'];
        include('utilSemaine.php');
    }
}
$conn->close();
?>


