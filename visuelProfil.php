<?php
include('header.php');
require('sqlConn.php');
$id_user = $_GET['id_user'];
$user = $conn->query("SELECT * FROM utilisateur WHERE id_user = '$id_user'");
if ($user->num_rows > 0) {
    $row = $user->fetch_assoc();
    $email = $row['email'];
    $nom = $row['nom'];
    $prenom = $row['prenom'];
    $note_moy = $row['note_moy'];
    $image = $row['image'];
    $date = $row['date_creation'];
    $ban=$row['ban'];
}
setcookie('ban', $ban);
setcookie('id', $id_user);
setcookie('email',$email);



if (isset($_SESSION['administrateur']) && $_SESSION['administrateur'] == 1) {
    $is_admin = true;
  } else {
    $is_admin = false;
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

            <label>
                <?php 
                    if ($ban==1){
                        echo 'Mute';
                    }
                    else{
                        echo 'Non Mute';
                    } ?></label><br><br>
            
            <?php if ($is_admin): ?>
            <form action="Bannir.php" method="post">
                <button type="submit" name="ban" value="<?php echo $ban ?>"><?php echo ($ban == 1) ? 'Débannir' : 'Bannir' ?></button>
            </form>
            <?php endif; ?>
            <?php if (isset($_SESSION['administrateur']) && $_SESSION['administrateur'] == 1){
                $page="window.location='nouveauUtilSemaine.php?email=$email'";
                echo "<button onclick=$page >Élire comme utilisateur de la semaine</button>";
            }


            if(isset($_SESSION['email']) && $_SESSION['email'] == $email){
                $modif="window.location='changeProfil.php'";
                $eff = "window.location='verifEffacer.php'";
                echo '<div class="bouton">';
                echo '<button onclick='. $modif . '>Modifier</button><br><br>';
                echo '<form action="deconnexion.php">';
                echo '<button type="submit">Déconnexion</button>';
                echo '</form>';
                echo '<button onclick=' . $eff . '>Effacer</button>';
            }

            include('recetteUtil.php');
            ?>
            <br><br>
            <?php include('commentaireUtil.php') ?>
          </div>
          <br>
        </div>
    </body>
    </html>
<?php $conn->close(); ?>
