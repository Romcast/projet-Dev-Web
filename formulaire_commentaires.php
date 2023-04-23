<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="commentaires.css"> <!-- Lien vers le fichier CSS -->
</head>
<body>


    <br>
    <br>
    <button id="toggle-comments">Cacher les commentaires</button>
    <div class="comment-form">

        <?php 
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }

            if(isset($_SESSION['ban']) && $_SESSION['ban'] == 0){
        ?>
            <h2>Ajouter un commentaire</h2>
            <form action="traitement_commentaire.php?id=<?php echo $id; ?>" method="post">
                <label for="comment">Commentaire :</label>
                <textarea id="comment" name="comment" required></textarea>
                <label for="note">Note(entre 1 et 5):</label>
                <input type="number" id="note" name="note" min="1" max="5" required>
                <button type="submit" name="submit">envoyer</button>
            </form>
        <?php } else { ?>
            <div class="ban-message">Vous avez été banni. Comportez vous mieux la prochaine fois :D </div>
        <?php } ?>
    </div>
    <div class="comments">
    <h1>Commentaires</h1>
    <form method="post" action="afficher_commentaire.php">
        <label for="tri">Trier par :</label>
        <select id="tri" name="tri">
            <option value="date">Les + récents</option>
            <option value="note">Les mieux notés</option>
        </select>
        <button type="submit">Trier</button>
    </form>

        <?php 
            if(isset($_SESSION['ban']) && $_SESSION['ban'] == 0){
                if (isset($_GET['id'])) {
                    include_once("afficher_commentaire.php");
                }
                else{
                    echo "erreur transmission id depuis visuelrecette.php a formulaire_commentaires.php";
                }
            } 
        ?>
    </div>
    </div>
    <script>
        var button = document.getElementById("toggle-comments");
        var commentsDiv = document.querySelector(".comments");
        var commentFormDiv = document.querySelector(".comment-form");

        button.addEventListener("click", function() {
            if (commentsDiv.style.display === "none") {
                commentsDiv.style.display = "block";
                commentFormDiv.style.display = "block";
                button.innerHTML = "Cacher les commentaires";
            } else {
                commentsDiv.style.display = "none";
                commentFormDiv.style.display = "none";
                button.innerHTML = "Afficher les commentaires";
            }
        });
    </script>

</body>
</html>

