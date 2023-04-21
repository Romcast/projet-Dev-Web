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
    case "Nom":
        $query = "SELECT * FROM form_recette WHERE auteur='$email' ORDER BY nom $s";
        break;
    case "Nombre personne":
        $query = "SELECT * FROM form_recette WHERE auteur='$email' ORDER BY nombre_personnes $s";
        break;
    case "Note moyenne":
        $query = "SELECT * FROM form_recette WHERE auteur='$email' ORDER BY note  $s";
        break;
    case "Cout":
        $query = "SELECT * FROM form_recette WHERE auteur='$email' ORDER BY cout_recette $s";
        break;
    default:
        $query = "";

}

$recette = $conn->query($query);

if ($recette != false && $recette->num_rows > 0) {
    $i = 1;
    echo "<ul id='myUL'>";
    while($row = $recette->fetch_assoc()) {
        $id = $row['id'];        
        echo "<li><a href='visuelrecette.php?id=$id'>";
        echo $i . '.';
        echo "<span class='tab'></span>";
        echo "<img src='" . $row['photo'] . "' alt='Introuvable' width='30' height='30'>";
        echo " ";
        echo "<label id='nom'>" . $row['nom'] . "</label>";
        echo "<span class='tab'></span>";
        echo "<label>" . $row['type_repas'] . "</label>";
        echo "<span class='tab'></span>";
        echo "Difficulté: " . $row['difficulte'];
        echo "<span class='tab'></span>";
        echo "Nombre personnes : " . "<label>" . $row['nombre_personnes'] . "</label>";
        echo "<span class='tab'></span>";
        echo "Note moyenne : " . $row['note'];
        echo "<span class='tab'></span>";
        echo "Cout : " . "<label>" . $row['cout_recette'] . "</label>";
        echo "</a></li>";
        $i = $i + 1;
        
    }
    echo "</ul>";
}

else{
   echo $email;
    
}
?> 
