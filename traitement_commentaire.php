<?php
// Récupérer les données du formulaire
//$page_id = $_POST['page_id'];
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

try{
    //On crée une table commentaire
    $commentaire = "CREATE TABLE IF NOT EXISTS commentaire(
        page_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
        nom VARCHAR(50) NOT NULL,
        commentaire VARCHAR(5000),
        note INT
        )";
    if($dbco->exec($commentaire)==true){
        echo "la table commentaire a bien été créée; ";
    }
    else{
        echo "la table commentaire existe deja ou il y a une erreur; ";
    }
    
    // Insérer le commentaire dans la base de données avec l'ID de la page
    $query = "INSERT INTO commentaire (nom, commentaire, note) VALUES ( '$username', '$comment', $note)";
    if($dbco->exec($query)==true){
        echo "la requete a bien été exécutée; ";
    }
    else{
        echo "une erreur s'est produite lors de la requete; ";
    }
}

catch(PDOException $e){
    echo 'Erreur : '.$e->getMessage();
}
$dbco= null;

// Vérifier si l'insertion a réussi
// if ($result) {
//     header("Location: formulaire_commentaires.php"); // Rediriger vers la page du formulaire de commentaire
// } else {
//     echo "Erreur lors de l'ajout du commentaire : " . $mysqli->error;

// }

?>
