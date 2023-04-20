<?php
// Connexion à la base de données
try {
    $bdd = new PDO('mysql:host=localhost;dbname=miam;charset=utf8', 'root', '');
}
catch(Exception $e) {
    die('Erreur : '.$e->getMessage());
}

// Récupération des suggestions depuis la base de données
$req = $bdd->query('SELECT * FROM suggestions');
$suggestions = $req->fetchAll(PDO::FETCH_ASSOC);

// Encodage des suggestions en JSON
echo json_encode($suggestions);
?>
