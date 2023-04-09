<?php
    $servername ="localhost";
    $username ="root";
    $password = "";
    $bdd = new PDO("mysql:host=$servername;dbname=miam;", $username, $password);
    $recette=$bdd->query('SELECT * FROM recette');
    $lienrecette=$bdd->query('SELECT * FROM recette');
    $noterecette=$bdd->query('SELECT * FROM recette');
    if(isset($_GET['rechercher'])AND !empty($_GET['rechercher'])){
        $recherche=$_GET['rechercher'];
        $recette=$bdd->query('SELECT nomrecette FROM recette WHERE nomrecette LIKE "%'.$recherche.'%"' );
        $lienrecette=$bdd->query('SELECT lien FROM recette WHERE nomrecette LIKE "%'.$recherche.'%"' );
        $noterecette=$bdd->query('SELECT note FROM recette WHERE nomrecette LIKE "%'.$recherche.'%"' );
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
                    while($r=$recette->fetch() AND $l=$lienrecette->fetch()AND $n=$noterecette->fetch()){
                        ?>
                        <p><a href=<?php echo $l['lien'];?>><?php echo $r['nomrecette'];?></a>
                        <?php switch($n['note']){
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