<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="commentaires.css"> <!-- Lien vers le fichier CSS -->
</head>
<body>
    <div class="comment-form">
    <h1>Commentaires</h1>
    <div class="comments">
        <?php 
        if (isset($_GET['id'])) {
            include_once("afficher_commentaire.php");
        }
        else{
            echo "erreur trasmission id depuis visuelrecette.php a formulaire_commentaires.php";
        }
        ?>
    </div>
        <h2>Ajouter un commentaire</h2>
        <form action="traitement_commentaire.php?id=<?php echo $id; ?>" method="post">
            <!-- <input type="hidden" name="page_id" value="1"> Champ caché pour stocker l'ID de la page -->
            <!-- <label for="username">Nom d'utilisateur :</label>
            <input type="text" id="username" name="username" required> -->
            <label for="comment">Commentaire :</label>
            <textarea id="comment" name="comment" required></textarea>
            <label for="note">Note(entre 1 et 5):</label>
            <input type="number" id="note" name="note" min="1" max="5" required>
            <button type="submit" name="submit">envoyer</button>
        </form>
    </div>
    
</body>
</html>
