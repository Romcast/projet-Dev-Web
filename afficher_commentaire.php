<?php

$serveur = "localhost";
$user = "root";
$pass = "";
$dbname="miam";

//On se connecte à la BDD
$dbco = new PDO("mysql:host=$serveur;dbname=$dbname",$user,$pass);
$dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
try{
    $statement=$dbco->prepare("SELECT mail_auteur,commentaire,note FROM commentaire WHERE recette_id=10");
    $statement->execute();
    $commentaires=$statement->fetchAll(PDO::FETCH_ASSOC);
    foreach($commentaires as $commentaire){
        echo '<div>' . $commentaire['mail_auteur']. ' a écrit: ' . $commentaire['commentaire'] . ' et a donné une note de ' . $commentaire['note'] . '</div>';
    }
    
}


catch(PDOException $e){

}
// if($mysqli->connect_error) {
//     die("Erreur de connexion à la base de données:")};
    
//     $query = "SELECT nom,commentaire,note FROM commentaire WHERE recette_id=10"; // Requête SQL pour récupérer les commentaires
//     $resultat = mysqli_query($connexion, $query); // Exécuter la requête
    
//     // Vérifier si la requête a réussi
//     if ($resultat) {
//         // Parcourir les résultats et afficher les commentaires
//         while ($row = mysqli_fetch_assoc($resultat)) {
//             echo "Commentaire : " . $row['commentaire'] . "<br>"; // Afficher le commentaire
//         }
//     } else {
//         echo "Erreur lors de la récupération des commentaires : " . mysqli_error($connexion);
//     }
    
//     // Fermer la connexion
//     mysqli_close($connexion);
$dbco=null;
    ?>
    