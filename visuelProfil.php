<?php
include('header.php');
require('sqlConn.php');
$email = $_GET['email'];
if (isset($_SESSION['email']) && $email == $_SESSION['email']){
    header("Location:profil.php");
}
$user = $conn->query("SELECT * FROM utilisateur WHERE email = '$email'");
if ($user->num_rows > 0) {
    $row = $user->fetch_assoc();
    $nom = $row['nom'];
    $prenom = $row['prenom'];
    $note_moy = $row['note_moy'];
    $image = $row['image'];
    $date = $row['date_creation'];
}


?>


<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="connexion.css" rel="stylesheet" type="text/css">
        <title>Profil</title>
    </head>
    <body>

    <div id="d1">
        <h1 class="titre">Profil</h1>
        <div class="utilisateur">
            <img id="img1" src= <?php echo $image ?> alt="Introuvable" width="100" height="100"><br><br>
            <label>
                Email : <?php echo $email ; ?>
            </label><br><br>
            <label>
                Nom : <?php echo $nom ; ?>
            </label><br><br>
            <label>
                Prenom : <?php echo $prenom ; ?>
            </label><br><br>
            <label>
                Note moyenne : <?php echo $note_moy ; ?>
            </label><br><br>
            <label>
                Compte créé le : <?php echo $date ; ?>
            </label><br><br>
            <?php if (isset($_SESSION['administrateur']) && $_SESSION['administrateur'] == 1){
                $page="window.location='nouveauUtilSemaine.php?email=$email'";
                echo "<button onclick=$page >Choisir comme uilisateur de la semaine</button>";
            }
            ?>
          </div>
          <br>
        </div>
    </body>
    </html>
<?php $conn->close(); ?>
