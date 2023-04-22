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
    if (isset($_SESSION['recette_id'])) {
        $recette_id = $_SESSION['recette_id'];

        $statement=$dbco->prepare("SELECT commentaire_id, mail_auteur, commentaire, note, date_creation FROM commentaire WHERE recette_id=:recette_id");
        $statement->bindParam(':recette_id', $recette_id);
        $statement->execute();
        $commentaires=$statement->fetchAll(PDO::FETCH_ASSOC);

        foreach($commentaires as $commentaire){
            // On récupère l'ID utilisateur correspondant à l'auteur du commentaire
            $auteur=$commentaire['mail_auteur'];
            $statement2=$dbco->prepare("SELECT id_user FROM utilisateur WHERE email=:email");
            $statement2->bindParam(':email', $auteur);
            $statement2->execute();
            $id_user=$statement2->fetchColumn();

            echo '<div style="border:2px solid black">' . "<a href='visuelProfil.php?id_user=$id_user'>",$commentaire['mail_auteur'],"</a>". ' a écrit: ' . $commentaire['commentaire'] . ' et a donné une note de ' . $commentaire['note'] . ' le ' . $commentaire['date_creation'] . '</div>';
            echo "<button class='comment-delete' data-comment-id='" . $commentaire['commentaire_id'] . "'>Supprimer</button>";
        }
    }
    // Récupérer la valeur du paramètre 'tri' dans l'URL, ou utiliser la valeur par défaut 'date'
$tri = isset($_GET['tri']) ? $_GET['tri'] : 'date';

// Construire la requête SQL pour récupérer les commentaires triés selon le paramètre 'tri'
switch ($tri) {
    case 'note':
        $query = "SELECT * FROM commentaire WHERE recette_id = $recette_id ORDER BY note DESC";
        break;
    case 'date':
        $query = "SELECT * FROM commentaire WHERE recette_id = $recette_id ORDER BY date_creation DESC";
        break;
    default:
        $query = "SELECT * FROM commentaire WHERE recette_id = $recette_id";
}

}

catch(PDOException $e){
}

$dbco=null;
?>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
// Fonction pour supprimer un commentaire
function deleteComment(commentId) {
    console.log(commentId);
    $.ajax({
        type: 'POST',
        url: 'supprimer_commentaire.php',
        data: {commentId: commentId},
        success: function(response) {
            // Actualiser la liste des commentaires affichée sur la page
            $('.comments').load('afficher_commentaire.php');
        }
    });
}

// Gérer le clic sur le bouton "supprimer" d'un commentaire
$(document).on('click', '.comment-delete', function() {
    var commentId = $(this).data('comment-id');
    deleteComment(commentId);
});
</script>
