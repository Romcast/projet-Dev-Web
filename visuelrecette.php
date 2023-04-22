<?php
    require('header.php');
    $servername ="localhost";
    $username ="root";
    $password = "";
    $bdd = new PDO("mysql:host=$servername;dbname=miam;", $username, $password);
    if(isset($_GET['id']) AND !empty($_GET['id'])){
        $id=$_GET['id'];
        $vrecette= $bdd->prepare('SELECT * FROM form_recette WHERE id=?');
        $vingredients=$bdd->prepare('SELECT * FROM form_ingredient WHERE recette_id=?');
        $vetapes=$bdd->prepare('SELECT * FROM form_etape WHERE recette_id=?');
        $vrecette->execute(array($id));
        $vingredients->execute(array($id));
        $vetapes->execute(array($id));
        if($vrecette->rowCount()==1){
            $vrecette=$vrecette->fetch();
            $titre=$vrecette['nom'];
            $auteur=$vrecette['auteur'];
            $note=number_format($vrecette['note'],2);//2 CS
            $type=$vrecette['type_repas'];
            $nbpersonne=$vrecette['nombre_personnes'];
            $difficulte=$vrecette['difficulte'];
            $conseil=$vrecette['conseils'];
            $image=$vrecette['photo'];
            $cout=$vrecette['cout_recette'];
            //
            $traitement=$vrecette['traitement'];
            
        }else{
            die('Cet recette n\'existe pas');
        }
    }else{
        die('Erreur');
    }
    
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title> RECETTE : <?php echo $titre;?> </title>
    </head>
    <body>
        <h1> RECETTE :<?php echo $titre;?> </h1>
        <h3>envoyée par <?php echo $auteur;?></h3>
        
        <p>Type: <?php echo $type;?></p>
        <p>Pour: <?php echo $nbpersonne;?> personne(s)</p>
        <p>Difficulté: <?php echo $difficulte;?></p>
        <p><img src=<?php echo $image;?>></p>
        <div id="ingredients" name="ingredients[]" >
            <h4>Ingredients</h4>
            <?php
                if($vingredients->rowCount()>0){
                    while($i=$vingredients->fetch()){

                        ?><p><?php $encours_d_estimation=0;
                        echo $i['quantite'];
                        echo " ";echo $i['unite'];
                        echo " ";
                        echo $i['nom'];
                        if($i['cout']==""){
                            $encours_d_estimation=1;
                            echo " prix à estimer";
                        }else{
                            echo " prix estimé :".$i['cout']."par".$i['unite'];
                        }
                        ?></p><?php
                    }
                }else{
                    ?>
                    <p>Erreur ingredient</p>
                    <?php
                }
            ?>
                
        </div>
        <div id="etapes" name="etapes[]">
            <h4>Etapes</h4>
        <?php
                if($vetapes->rowCount()>0){
                    while($e=$vetapes->fetch()){
                        ?><p><?php echo $e['etape'];?></p><?php
                    }
                }else{
                    ?>
                    <p>Erreur etapes</p>
                    <?php
                }
            ?>   
        </div>
        <h4>Conseils :</h4>
        <p>  <?php echo $conseil;?> </p>
        <h4>Cout estimé de la recette :</h4>
        <p><?php 
        if($encours_d_estimation==0){
            echo $cout. " euros";
        }else{
            echo "Le prix de cette recette est en cours d'estimation";}
        ?></p>
        <h4> Note de la recette:</h4>
        <p> <?php echo $note."/5" ?>


    <?php 
        
        if(!isset($_SESSION)){
            session_start();
        }
        include_once("creation_table_commentaire.php");
        $_SESSION['recette_id']=$id;
        if (isset($_SESSION['id_user'],$_SESSION['email'],$_SESSION['recette_id'])){
            $verif_comm=$bdd->prepare("SELECT COUNT(*) FROM commentaire WHERE mail_auteur=? AND recette_id=?");
            $verif_comm->execute(array($_SESSION['email'],$_SESSION['recette_id']));
            $nb_comm = $verif_comm->fetchColumn();
            if($nb_comm>0){
                require_once("afficher_commentaire.php");
                echo ' vous avez déja commenté.'. '<br>';
                // echo "Nom de la session : " . session_name() . "<br>";
                // foreach($_SESSION as $key => $value) {
                //     echo "Variable de session : " . $key . " = " . $value . "<br>";
                // }
            }
            else{
                require_once("formulaire_commentaires.php");
                
            }
            
        }
            

        else{
            require_once("afficher_commentaire.php");
        }  
                if(isset($_SESSION['administrateur']) AND $_SESSION['administrateur']==1){
                    if($traitement=="Validé"){?>
                        <a href="deleterecette.php?delete=<?php echo $id?>">Supprimer</a><?php;?>
                        <a href="modifrecette.php?modif=<?php echo $id?>">Modifier</a><?php
                    }else{?>
                        <a href="validerrecette.php?valid=<?php echo $id?>">Valider</a><?php;?>
                        <a href="deleterecette.php?delete=<?php echo $id?>">Supprimer</a><?php;?>
                        <a href="modifrecette.php?modif=<?php echo $id?>">Modifier</a><?php
                    }
                }
        ?>
        

    </body>
</html>
