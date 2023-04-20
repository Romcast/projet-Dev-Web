<?php include('header.php') ?>
<?php 
if (isset($_SESSION['email'])){
}

else{
    header("Location:connexion.php");
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
            <img id="img1" src= <?php echo $_SESSION['image'] ?> alt="Introuvable" width="100" height="100"><br><br>
            <label>
                Email : <?php echo $_SESSION['email'] ; ?>
            </label><br><br>
            <label>
                Nom : <?php echo $_SESSION['nom'] ; ?>
            </label><br><br>
            <label>
                Prenom : <?php echo $_SESSION['prenom'] ; ?>
            </label><br><br>
            <label>
                Note moyenne : <?php echo $_SESSION['note_moy'] ; ?>
            </label><br><br>
            <label>
                Compte créé le : <?php echo $_SESSION['note_moy'] ; ?>
            </label><br><br>
            <div class="bouton">
            <button onclick="window.location='changeProfil.php'">Modifier</button><br><br>
            <form action="deconnexion.php">
                <button type="submit">Déconnexion</button>
            </form>
            <button onclick="window.location='verifEffacer.php'">Effacer</button>

          </div>
          <br>
        </div>
    </body>
    </html>
