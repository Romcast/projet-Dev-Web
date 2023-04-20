<?php
    $servername ="localhost";
    $username ="root";
    $password = "";
    $bdd = new PDO("mysql:host=$servername;dbname=miam;", $username, $password);
    $recette=$bdd->query('SELECT * FROM form_recette WHERE traitement="Validé"');
    if(isset($_GET['rechercher'])AND !empty($_GET['rechercher'])){
        $recherche=$_GET['rechercher'];
        $recette=$bdd->query('SELECT * FROM form_recette WHERE traitement="Validé" AND nom LIKE "%'.$recherche.'%"' );
    };

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Barre de recherche</title>
        <meta charset="utf-8">
    </head>
    <body>
        <form method="GET">
            <input type="search" name="rechercher" placeholder="Mots-clés">
            <input type="submit" name="Entrée">
        </form>
        <section class="afficher">
            <?php
                if($recette->rowCount()>0){
                    while($r=$recette->fetch()){
                        ?>
                        <p><a href="visuelrecette.php?id=<?php echo $r['id']?>"><?php echo $r['nom'];?></a>
                        <?php switch($r['note']){
                            case NULL:
                                echo "pas de note";
                                break;
                            case 0:
                                echo "";
                                break;
                            case 1:
                                echo "*";
                                break;
                            case 2:
                                echo "**";
                                break;
                            case 3:
                                echo "***";
                                break;
                            case 4:
                                echo "****";
                                break;
                            case 5:
                                echo "*****";
                                break;
                        } ;?></p>
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