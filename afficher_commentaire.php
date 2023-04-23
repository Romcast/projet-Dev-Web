<html>
    <head>
        <link href="afficher_commentaire.css" rel="stylesheet" type="text/css">
    </head>
    <body>

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
                $tri = isset($_POST['tri']) ? $_POST['tri'] : 'date';

                // Construire la requête SQL pour récupérer les commentaires triés selon le paramètre 'tri'
                if($tri=="note"){
                    $query = "SELECT * FROM commentaire WHERE recette_id = :recette_id ORDER BY note DESC";
                }
                else{
                    $query = "SELECT * FROM commentaire WHERE recette_id = :recette_id ORDER BY date_creation DESC";
                }

                $statement=$dbco->prepare($query);
                $statement->bindParam(':recette_id', $recette_id);
                $statement->execute();
                $commentaires=$statement->fetchAll(PDO::FETCH_ASSOC);
                echo '<div>' . '<div class="ligne">' . '<div >' . 'auteur'. '</div>'.'<div>'. 'commentaire'.'</div>' . '<div >' . 'note' .'</div>'. '</div>'. '</div>';
                foreach($commentaires as $commentaire){
                    // On récupère l'ID utilisateur correspondant à l'auteur du commentaire
                    $auteur=$commentaire['mail_auteur'];
                    $statement2=$dbco->prepare("SELECT id_user FROM utilisateur WHERE email=:email");
                    $statement2->bindParam(':email', $auteur);
                    $statement2->execute();
                    $id_user=$statement2->fetchColumn();

                    echo '<div id="commentaires">' . '<div class="ligne">' . '<div class="auteur">' . "<a href='visuelProfil.php?id_user=$id_user'>",$commentaire['mail_auteur'],"</a>". '</div>'. '<div class="commentaire">' . $commentaire['commentaire'] . '</div>'. '<div class="note">' . $commentaire['note'] . '</div> ' . '<div class="date">' . $commentaire['date_creation'] .'</div>'. "<button class='comment-delete' data-comment-id='" . $commentaire['commentaire_id'] . "'>Supprimer</button>" . '</div>'. '</div>';
                    //echo "<button class='comment-delete' data-comment-id='" . $commentaire['commentaire_id'] . "'>Supprimer</button>";
                }
            }

        }

        catch(PDOException $e){
        }

        $dbco=null;
        ?>

    </body>

</html>


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
        },
        error: function() {
            alert('Une erreur est survenue lors de la suppression du commentaire.');
        }
    });
}

// Gérer le clic sur le bouton "supprimer" d'un commentaire
$(document).on('click', '.comment-delete', function() {
    var commentId = $(this).data('comment-id');
    var authorEmail = $(this).data('author-email');
    var currentUserEmail = "<?php echo $_SESSION['email'] ?>";
    var isAdmin = "<?php echo $_SESSION['administrateur'] ?>";

    if (currentUserEmail === authorEmail || isAdmin == 1) {
        deleteComment(commentId);
    } else {
        alert('Vous ne pouvez pas supprimer ce commentaire car vous n\'êtes pas son auteur.');
    }
});
</script>


    