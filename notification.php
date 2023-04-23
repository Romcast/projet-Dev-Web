<?php
require('header.php');
$servername ="localhost";
$username ="root";
$password = "";
$bdd = new PDO("mysql:host=$servername;dbname=miam;", $username, $password);

if(isset($_SESSION['email'])){
    $id_user = $_SESSION['email'];
    $current_date = date('Y-m-d');

    // Vérification si une suggestion a été affichée pour l'utilisateur cette semaine
    $last_display = $bdd->prepare('SELECT MAX(date_creation) AS last_display 
                                    FROM commentaire 
                                    WHERE mail_auteur=? 
                                    AND commentaire.note IS NOT NULL 
                                    AND commentaire.note >3');
    $last_display->execute(array($id_user));
    $result_last_display = $last_display->fetch();
    $last_display_date = $result_last_display['last_display'];
    $interval = date_diff(date_create($last_display_date), date_create($current_date));
    $days_since_last_display = $interval->format('%a');

    if ($days_since_last_display >= 7) { // Afficher les suggestions si la dernière suggestion date de plus d'une semaine
        // Récupération des recettes préférées de l'utilisateur
        $recettepref = $bdd->prepare('SELECT commentaire.*, form_recette.* 
                                      FROM commentaire 
                                      INNER JOIN form_recette 
                                      ON commentaire.recette_id=form_recette.id 
                                      WHERE mail_auteur=? 
                                      AND commentaire.note IS NOT NULL 
                                      AND commentaire.note >3 
                                      ORDER BY commentaire.date_creation DESC 
                                      LIMIT 3');
        $recettepref->execute(array($id_user));

        // Récupération des recettes correspondant aux critères de la table form_recette
        $recettes = array();
        while ($r = $recettepref->fetch()) {
            $nom = $r['nom'];
            $type_repas = $r['type_repas'];
            $auteur = $r['auteur'];

            $recette = $bdd->prepare('SELECT * FROM form_recette 
                                       WHERE nom=? 
                                       AND type_repas=? 
                                       AND auteur=? 
                                       ORDER BY nom, type_repas, auteur 
                                       LIMIT 3');
            $recette->execute(array($nom, $type_repas, $auteur));
            $result = $recette->fetch();

            if ($result) {
                $recettes[] = $result;
            }
        }

        // Enregistrement de la date de la dernière suggestion affichée pour l'utilisateur
        $add_display_date = $bdd->prepare('INSERT INTO commentaire (mail_auteur, recette_id, note, date_creation) 
                                           VALUES (?, NULL, NULL, ?)');
        $add_display_date->execute(array($id_user, $current_date));
    }

    // Affichage des suggestions
    if (!empty($recettes)) {
        echo "<h2>Suggestions de la semaine :</h2>";
        echo "<ul>";
        foreach ($recettes as $recette) {
            echo "<li>" . $recette['nom'] . " (" . $recette['type_repas'] . ") de " . $recette['auteur'] . "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>Aucune suggestion pour cette semaine.</p>";
    }
}
else{
    echo "Connectez-vous pour recevoir des notifications !";
}
?>

