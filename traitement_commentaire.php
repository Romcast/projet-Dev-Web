<?php
// Récupérer les données du formulaire
$page_id = $_POST['page_id'];
$username = $_POST['username'];
$comment = $_POST['comment'];
$note = $_POST['note'];

$serveur = "localhost";
$user = "root";
$pass = "";
$dbname="miam";

//On se connecte à la BDD
$dbco = new PDO("mysql:host=$serveur;dbname=$dbname",$user,$pass);
$dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Vérifier la connexion à la base de données
if($mysqli->connect_error) {
    die("Erreur de connexion à la base de données: " . $mysqli->connect_error);
}

try{
    //On crée une table commentaire
    $commentaire = "CREATE TABLE IF NOT EXISTS commentaire(
        page_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
        nom VARCHAR(50) NOT NULL,
        commentaire VARCHAR(5000),
        note INT
        )";

// Insérer le commentaire dans la base de données avec l'ID de la page
$query = "INSERT INTO commentaire (page_id, username, commentaire, note) VALUES ('$page_id', '$username', '$comment', '$note')";
$result = $mysqli->query($query);}

// Vérifier si l'insertion a réussi
if ($result) {
    header("Location: formulaire_commentaires.php"); // Rediriger vers la page du formulaire de commentaire
} else {
    echo "Erreur lors de l'ajout du commentaire : " . $mysqli->error;

}
// Fermer la connexion à la base de données
$mysqli->close();
?>
