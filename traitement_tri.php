<?php
if (!isset($_SESSION)) {
    session_start();
}

$serveur = "localhost";
$user = "root";
$pass = "";
$dbname = "miam";
// On se connecte à la BDD
$dbco = new PDO("mysql:host=$serveur;dbname=$dbname;charset=utf8", $user, $pass);
$dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
try{
    $recette_id = $_SESSION['recette_id'];

if (isset($_SESSION['recette_id'])) {
    $tri = isset($_GET['tri']) ? $_GET['tri'] : 'date';

    // Construire la requête SQL pour récupérer les commentaires triés selon le paramètre 'tri'
    switch ($tri) {
        case 'note':
            $query = "SELECT * FROM commentaire WHERE recette_id = :recette_id ORDER BY note DESC";
            break;
        case 'date':
            $query = "SELECT * FROM commentaire WHERE recette_id = :recette_id ORDER BY date_creation DESC";
            break;
        default:
            $query = "SELECT * FROM commentaire WHERE recette_id = :recette_id";
    }

    $query_comm_tries = $dbco->prepare($query);
    $query_comm_tries->bindParam(':recette_id', $recette_id);
    $query_comm_tries->execute();

    $resultats = $query_comm_tries->fetchAll(PDO::FETCH_ASSOC);

    foreach ($resultats as $resultat) {
        echo $resultat['commentaire'] . "<br>";
    }
}

}

catch(PDOException $e){
}

$dbco=null;
?>