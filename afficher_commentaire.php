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
            if(!isset($_SESSION['email'])){
                echo '<br> Connectez vous pour accéder aux commentaires';
            }
            else{
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
                echo '<div>' . '<div class="ligne">' . '<div id="titre_auteur" >' . 'auteur'. '</div>'.'<div id="titre_commentaire">'. 'commentaire'.'</div>' . '<div id="titre_note">' . 'note' .'</div>'. '<div id="titre_date">' . 'date'. '</div>' . '</div>'. '</div>';
                foreach($commentaires as $commentaire){
                    // On récupère l'ID utilisateur correspondant à l'auteur du commentaire
                    $auteur=$commentaire['mail_auteur'];
                    $statement2=$dbco->prepare("SELECT id_user FROM utilisateur WHERE email=:email");
                    $statement2->bindParam(':email', $auteur);
                    $statement2->execute();
                    $id_user=$statement2->fetchColumn();
                    if($_SESSION['administrateur']==1||$_SESSION['email']==$auteur){
                        echo '<div id="commentaires">' . '<div class="ligne">' . '<div class="auteur">' . "<a href='visuelProfil.php?id_user=$id_user'>".$commentaire['mail_auteur']."</a>" . '</div>'. '<div class="commentaire">' . $commentaire['commentaire'] . '</div>'. '<div class="note">' . $commentaire['note'] . '</div> ' . '<div class="date">' . $commentaire['date_creation'] .'</div>'. '</div>'. "<button class='comment-delete' onclick=\"deleteComment(".$commentaire['commentaire_id'].")\" data-comment-id='" . $commentaire['commentaire_id'] . "'>Supprimer</button>" .'</div>';
                    }else{
                        echo '<div id="commentaires">' . '<div class="ligne">' . '<div class="auteur">' . "<a href='visuelProfil.php?id_user=$id_user'>".$commentaire['mail_auteur']."</a>" . '</div>'. '<div class="commentaire">' . $commentaire['commentaire'] . '</div>'. '<div class="note">' . $commentaire['note'] . '</div> ' . '<div class="date">' . $commentaire['date_creation'] .'</div>'.'</div>'. '</div>';
                    }
                    //echo "<button class='comment-delete' data-comment-id='" . $commentaire['commentaire_id'] . "'>Supprimer</button>";
                }
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
    location.reload();
}


</script>


    
