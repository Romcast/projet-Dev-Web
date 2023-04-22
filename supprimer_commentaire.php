<?php
if (!isset($_SESSION)) {
    session_start();
}

$commentId = $_POST['commentId'];

$serveur = "localhost";
$user = "root";
$pass = "";
$dbname = "miam";

// On se connecte à la BDD
$dbco = new PDO("mysql:host=$serveur;dbname=$dbname;charset=utf8", $user, $pass);
$dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
    // Supprimer le commentaire de la base de données
    $query = "DELETE FROM commentaire WHERE commentaire_id=:commentaire_id";
    $statement = $dbco->prepare($query);
    $statement->bindValue(':commentaire_id', $commentId);
    $result = $statement->execute();

    if ($result === false) {
        echo "Une erreur s'est produite lors de l'exécution de la requête.";
    }
} catch (PDOException $e) {
    echo "Une erreur s'est produite lors de la suppression du commentaire : " . $e->getMessage();
}
