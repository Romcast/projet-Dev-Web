<?php
require ('sqlConn.php');
$sens=$_GET['sens'];
$choix=$_GET['choix'];
$email=$_GET['email'];

switch($sens){
    case "Croissant":
        $s = "ASC";
        break;
    case "Décroissant";
        $s = "DESC";
        break;
        
}

switch($choix){
    case "Nom recette":
        $query = "SELECT * FROM commentaire,form_recette WHERE recette_id=form_recette.id AND mail_auteur='$email' ORDER BY nom $s";
        $commentaire = $conn->query($query);
        break;
    case "Commentaire":
        $query = "SELECT * FROM commentaire,form_recette WHERE recette_id=form_recette.id AND mail_auteur='$email' ORDER BY commentaire $s";
        $commentaire = $conn->query($query);
        break;
    default:

}

if (isset($commentaire) && $commentaire != false && $commentaire->num_rows > 0) {
    $i = 1;
    echo "<ul id='myUL_commentaire'>";
    while($row = $commentaire->fetch_assoc()) {
        $id_recette = $row['recette_id'];        
        echo "<li><a href='visuelrecette.php?id=$id_recette'>";
        echo " Recette : ";
        echo "<label id='nom_commentaire'>" . $row['nom'] . "</label>";
        echo "<span class='tab'></span>";
        echo " Commentaire : ";
        echo "<label>" . $row['commentaire'] . "</label>";
        echo "</a></li>";
    }
    echo "</ul>";
}


?> 
