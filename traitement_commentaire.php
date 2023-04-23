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
    //la table commentaire est créée, si elle n'existe pas, dans visuelrecette.php à l'ouverture de la page recette

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

    if (!$result) {
        echo "Une erreur s'est produite lors de l'exécution de la requête.";
    }
    //on calcule les moyennes à chaque nouveau commentaire
    $moyenne_note_query_recette = $dbco->query("SELECT AVG(note) FROM commentaire WHERE recette_id = $recette_id");
    $moyenne_note_recette = $moyenne_note_query_recette->fetchColumn();
    $update_note_recette = "UPDATE form_recette SET note = $moyenne_note_recette WHERE id = $recette_id";

    if($dbco->exec($update_note_recette)){
        echo "note ";
    }
    else{
        echo "erreur note";
    }

    $auteur_query =$dbco->query("SELECT auteur FROM form_recette WHERE id = $recette_id");
    $auteur = $auteur_query->fetchColumn();
    $moyenne_note_query_user = $dbco->query("SELECT AVG(note) FROM form_recette WHERE auteur = '$auteur'");
    $moyenne_note_user = $moyenne_note_query_user->fetchColumn();
    $update_note_user = "UPDATE utilisateur SET note_moy = $moyenne_note_user WHERE email = '$auteur'";
    
    if($dbco->exec($update_note_user)){
        echo " note user ";
    }
    else{
        echo " erreur note user";
    }



    if (isset($_GET['id'])) {
        include_once("visuelrecette.php");
    }
}

catch (PDOException $e) {
    echo 'Erreur : '.$e->getMessage();
}

$dbco = null;
?>
