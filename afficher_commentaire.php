<?php
$page_id = $_POST['page_id'];

// Connexion à la base de données
$mysqli = mysqli_connect("localhost","root","", "miam"); 

// Vérifier la connexion à la base de données
if($mysqli->connect_error) {
    die("Erreur de connexion à la base de données:")};
    $query = "SELECT nom,commentaire,note FROM commentaire WHERE page_id=$page_id"; // Requête SQL pour récupérer les commentaires
    $resultat = mysqli_query($connexion, $query); // Exécuter la requête
    
    // Vérifier si la requête a réussi
    if ($resultat) {
        // Parcourir les résultats et afficher les commentaires
        while ($row = mysqli_fetch_assoc($resultat)) {
            echo "Commentaire : " . $row['commentaire'] . "<br>"; // Afficher le commentaire
        }
    } else {
        echo "Erreur lors de la récupération des commentaires : " . mysqli_error($connexion);
    }
    
    // Fermer la connexion
    mysqli_close($connexion);
    ?>
    