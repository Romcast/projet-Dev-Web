<?php
    require('header.php');
    $servername ="localhost";
    $username ="root";
    $password = "";
    $bdd = new PDO("mysql:host=$servername;dbname=miam;", $username, $password);
    $nouveaubanni=$bdd->query('SELECT * FROM utilisateur');
?>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="liste.css" rel="stylesheet" type="text/css">
        <title>Utilisateurs</title>
    </head>
    <body>
        <h1>Liste des utilisateurs </h1>
        <section class="recettes">
            <?php
                if($nouveaubanni->rowCount()>0){
                    while($r=$nouveaubanni->fetch()){
                        ?>
                        <div class="recette">
                        <a href="visuelProfil.php?id_user=<?php echo $r['id_user']?>"><?php echo $r['nom'];?></a> <a href="mailto:<?php echo $r['email'];?>"><?php echo $r['email'];?></a>

                        </div>
                        <?php
                    }
                }
                else{
                    ?>
                    <p>Aucun utilisateur trouvé</p>
                    <?php
                }
            ?>

        </section>
    </body>
</html>