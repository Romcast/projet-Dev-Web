<?php
require('header.php');    
$servername ="localhost";
    $username ="root";
    $password = "";
    $bdd = new PDO("mysql:host=$servername;dbname=miam;", $username, $password);
    $ingredient_non_estime=$bdd->query('SELECT DISTINCT * FROM form_ingredient WHERE cout IS NULL GROUP BY nom, unite
    HAVING COUNT(DISTINCT nom) = 1 AND COUNT(DISTINCT unite) = 1');
    $ingredient=$bdd->query('SELECT DISTINCT * FROM form_ingredient WHERE cout IS NOT NULL GROUP BY nom, unite
    HAVING COUNT(DISTINCT nom) = 1 AND COUNT(DISTINCT unite) = 1');
?>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Ingredients</title>
    </head>
    <body>
        <h1>Liste des Ingredients à estimer</h1>
        <section class="afficher">
            <?php
                if($ingredient_non_estime->rowCount()>0){
                    while($ine=$ingredient_non_estime->fetch()){
                        ?>
                        <p><?php echo $ine['nom']." d'unité : ".$ine['unite'];?>
                        <a href="modifierprix2.0.php?modif=<?php echo $ine['id']?>">Definie le prix </a>
                    </p>

                        <?php
                    }
                }
                else{
                    ?>
                    <p>Aucun ingrédient à estimer trouvée</p>
                    <?php
                }
            ?>
                    <h1>Liste des Ingredients</h1>
        <section class="afficher">
            <?php
                if($ingredient->rowCount()>0){
                    while($i=$ingredient->fetch()){
                        ?>
                        <p><?php echo $i['nom'];?><?php echo " "; echo $i['cout']." euros par ".$i['unite'];?>
                        <a href="modifierprix2.0.php?modif=<?php echo $i['id']?>">Modifier le prix</a>
                    </p>

                        <?php
                    }
                }
                else{
                    ?>
                    <p>Aucun ingrédient trouvée</p>
                    <?php
                }
            ?>

        </section>
    </body>
</html>
