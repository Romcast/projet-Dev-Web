<?php
    require('header.php');
    $servername ="localhost";
    $username ="root";
    $password = "";
    $bdd = new PDO("mysql:host=$servername;dbname=miam;", $username, $password);
    $nouvellerecette=$bdd->query('SELECT * FROM form_recette WHERE traitement="Non traitée"');
?>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>En attente de validation</title>
    </head>
    <body>
        <h1>Liste des recettes</h1>
        <section class="afficher">
            <?php
                if($nouvellerecette->rowCount()>0){
                    while($r=$nouvellerecette->fetch()){
                        ?>
                        <p><a href="visuelrecette.php?id=<?php echo $r['id']?>"><?php echo $r['nom'];?></a><?php echo " "; echo $r['auteur']?>
                    </p>

                        <?php
                    }
                }
                else{
                    ?>
                    <p>Aucune recette trouvée</p>
                    <?php
                }
            ?>

        </section>
    </body>
</html>
