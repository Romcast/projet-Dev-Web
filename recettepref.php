<?php
require('header.php');
    $servername ="localhost";
    $username ="root";
    $password = "";
    $bdd = new PDO("mysql:host=$servername;dbname=miam;", $username, $password);
    if(isset($_SESSION['email'])){
        $id_user=$_SESSION['email'];
        //$recettepref=$bdd->prepare('SELECT * FROM commentaire WHERE mail_auteur=? AND note IS NOT NULL ');
        $recettepref=$bdd->prepare('SELECT commentaire.*, form_recette.* FROM commentaire INNER JOIN form_recette ON commentaire.recette_id=form_recette.id WHERE mail_auteur=? AND commentaire.note IS NOT NULL ');
        $recettepref->execute(array($id_user));
        }else{
            echo "Erreur";
        }
    ?>
   <html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Recette préférée</title>
    </head>
    <body>
        <h1>Liste des recettes préferée</h1>
        <section class="afficher">
            <?php
                if($recettepref->rowCount()>0){
                    while($r=$recettepref->fetch()){
                        ?>
                        <p><a href="visuelrecette.php?id=<?php echo $r['id']?>">Recette préférée : <?=$r['nom']?></a></p>

                        <?php
                    }
                }
                else{
                    ?>
                    <p>Aucune recette preférée pour l'instant</p>
                    <?php
                }
            ?>

        </section>
    </body>
</html>
