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
    <form method="post">
        <label for="tri">Trier par :</label>
        <select id="tri" name="tri">
            <option value="date">Les + récents</option>
            <option selected value="dateasc">Les - récents</option>
            <option selected value="note">Les mieux notés</option>
            <option selected value="noteasc">Les pire notés</option>
        </select>
        <button type="submit" name="submit">Trier</button>
    </form>
    <?php
     $serveur = "localhost";
     $user = "root";
     $pass = "";
     $dbname = "miam";
     // On se connecte à la BDD
     $dbco = new PDO("mysql:host=$serveur;dbname=$dbname;charset=utf8", $user, $pass);
     $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 if (isset($_SESSION['recette_id'])) {
    $recette_id = $_SESSION['recette_id'];    
    if(isset($_POST['submit'])){
    $selectedValue = $_POST['tri'];
    
    if($selectedValue=="note"){
        echo " Voici les meilleures notes";
        $query = "SELECT * FROM commentaire WHERE recette_id = :recette_id ORDER BY note DESC";
    }elseif($selectedValue=="date"){
        echo " Voici les commentaires les plus récents";
        $query = "SELECT * FROM commentaire WHERE recette_id = :recette_id ORDER BY date_creation, commentaire_id  DESC";
    }elseif($selectedValue=="dateasc"){
        echo " Voici les commentaires les plus anciens";
        $query = "SELECT * FROM commentaire WHERE recette_id = :recette_id ORDER BY date_creation, commentaire_id ASC";
    }else{
        echo " Voici les pires notes";
        $query = "SELECT * FROM commentaire WHERE recette_id = :recette_id ORDER BY note ASC";
    }
    $statement=$dbco->prepare($query);
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
                }
}
}
?>

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
        function getValue() {
         // Récupération de l'élément select
        const selectElement = document.getElementById("tri");

        // Récupération de la valeur sélectionnée
        const selectedValue = selectElement.value;

         // Affichage de la valeur sélectionnée
        console.log(selectedValue);

        // Retour de la valeur sélectionnée
         return selectedValue;
        }
    </script>

</body>
</html>
