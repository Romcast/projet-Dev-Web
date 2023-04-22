<?php
if (!isset($_SESSION)) {
    session_start();
}
$recette_id = $_SESSION['recette_id'];
$mail_auteur = $_SESSION['email'];
$comment = $_POST['comment'];
$note = $_POST['note'];
$date_creation = date('Y-m-d H:i:s');

$serveur = "localhost";
$user = "root";
$pass = "";
$dbname = "miam";

// On se connecte à la BDD
$dbco = new PDO("mysql:host=$serveur;dbname=$dbname;charset=utf8", $user, $pass);
$dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
    // On crée une table commentaire si elle n'existe pas déjà
    $commentaire = "CREATE TABLE IF NOT EXISTS commentaire(
        commentaire_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
        mail_auteur VARCHAR(50) NOT NULL,
        commentaire VARCHAR(5000),
        note INT NOT NULL,
        date_creation DATETIME NOT NULL,
        recette_id INT UNSIGNED,
        FOREIGN KEY(recette_id) REFERENCES form_recette(id) ON DELETE CASCADE
    )";
    if ($dbco->exec($commentaire) === false) {
        echo "La table commentaire existe déjà ou il y a une erreur; ";
    }

    // Insérer le commentaire dans la base de données avec l'ID de la page
    $query = "INSERT INTO commentaire (mail_auteur, commentaire, note, date_creation, recette_id) VALUES (:mail_auteur, :commentaire, :note, :date_creation, :recette_id)";
    $statement = $dbco->prepare($query);
    $result = $statement->execute([
        ':mail_auteur' => $mail_auteur,
        ':commentaire' => $comment,
        ':note' => $note,
        ':date_creation' => $date_creation,
        ':recette_id' => $recette_id,
    ]);

    if ($result === false) {
        echo "Une erreur s'est produite lors de l'exécution de la requête.";
    }

    if (isset($_GET['id'])) {
        include_once("visuelrecette.php");
    }
} catch (PDOException $e) {
    echo 'Erreur : '.$e->getMessage();
}

$dbco = null;
?>
