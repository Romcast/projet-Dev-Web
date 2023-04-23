<?php 
    if(!isset($_SESSION)){
        session_start();
    }
    $nom = $_POST['nom'];
    $type= $_POST['type'];
    $nombre = $_POST['nb_personnes'];
    $difficulte = $_POST['difficulte'];
    $nouvelleQuantite= $_POST['nouvelleQuantite'];
    $nouvelleUnite=$_POST['nouvelleUnite'];
    $nouvelIngredient=$_POST['nouvelIngredient'];
    $nouvelleEtape=$_POST['nouvelleEtape'];
    $auteur=$_SESSION['email'];
        $conseil = $_POST['conseils'];

    $serveur = "localhost";
    $dbname = "miam";
    $user = "root";
    $pass = "";
    
    try{
        //On se connecte à la BDD
        $dbco = new PDO("mysql:host=$serveur;dbname=$dbname",$user,$pass);
        $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        //On crée une table form_recette
        $form_recette = "CREATE TABLE IF NOT EXISTS form_recette(
            id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
            nom VARCHAR(50) NOT NULL,
            auteur VARCHAR(50) NOT NULL,
            type_repas VARCHAR(20) NOT NULL,
            nombre_personnes INT NOT NULL,
            difficulte VARCHAR(20) NOT NULL,
            conseils VARCHAR(500),
            photo VARCHAR(100) DEFAULT 'image/recette.png',
            traitement VARCHAR(500) NOT NULL,
            note FLOAT,
            cout_recette FLOAT NOT NULL )";
            
        $dbco->exec($form_recette);
        echo "  la table recette a ete cree; ";
        $entree_recette="INSERT INTO form_recette( nom, auteur, type_repas, nombre_personnes, difficulte, conseils,traitement,cout_recette)
        VALUES('$nom', '$auteur' ,'$type', $nombre, '$difficulte', '$conseil','Non traitée',0)";
        
        $dbco->exec($entree_recette);
        echo " recette ajoutée ";
        $id_recette=$dbco->lastInsertId();
        
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0)
        {
        
                if ($_FILES['photo']['size'] <= 1000000)
                {
                    //$nom_fichier = basename($_FILES['photo']['name']);//name recupere le nom du fichier sur le pc
                    $chemin_fichier = $_FILES['photo']['tmp_name'];//chemin temporaire
            
                    if(move_uploaded_file($chemin_fichier, 'image/' . $id_recette)) {
                            $photo = 'image/' . $id_recette;
                            echo 'voici le chemin de la photo: '.$photo;

                            $ajout_photo_bdd="UPDATE form_recette SET photo = '$photo' WHERE id = $id_recette;";
                            $dbco->exec($ajout_photo_bdd);
                            
                    } 
                    else {
                    $photo = 'erreur deplacement';
                    }      
                }
                else{
                    echo "erreur taille";
                }
        }
        else{
            echo " photo introuvable; ";
        }


        $form_ingredient=  "CREATE TABLE IF NOT EXISTS form_ingredient(
            id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
            nom VARCHAR(50) NOT NULL,
            quantite INT NOT NULL,
            unite VARCHAR(10) ,
            cout INT,
            recette_id iNT UNSIGNED,
            FOREIGN KEY(id) REFERENCES form_recette(id) ON DELETE CASCADE
            )";
        if(!$dbco->exec($form_ingredient)){
            echo " erreur création table ingrédient ou tbale déjà existante; ";
        }

        $size_ing=sizeof($nouvelIngredient);
        for ($i=0; $i<$size_ing; $i++){
            $quantite=  $nouvelleQuantite[$i] ;
            $ingredient= $nouvelIngredient[$i];
            $unite= $nouvelleUnite[$i];
            //On verifie si un ingredient similaire est deja dans la table
            $ingredient_existe=$dbco->prepare('SELECT * FROM form_ingredient WHERE nom=? AND unite=? AND cout IS NOT NULL LIMIT 1 ');
            $ingredient_existe->execute(array($ingredient,$unite));
            //
            $entree_ingredient="INSERT INTO form_ingredient( nom, quantite, unite, cout, recette_id)
            VALUES('$ingredient', $quantite ,'$unite', NULL,$id_recette)";
            if(!$dbco->exec($entree_ingredient)){
                echo " erreur entrée dans table ingredient; ";
            }
            $ingredient_id = $dbco->lastInsertId();
            if($ingredient_existe->rowCount()==1){
                //si l'ingredient existe dans la table on recupere son prix pour mettre a jour le prix du nouvel ingredient inseré dans la table
                $ingredient_existe=$ingredient_existe->fetch();
                $update_cout=$dbco->prepare('UPDATE form_ingredient SET cout=? WHERE id=?');
                $update_cout->execute(array($ingredient_existe['cout'],$ingredient_id));
               //on met egalement a jour le prix de la recette
                $recette=$dbco->prepare('SELECT * FROM form_recette WHERE id=?');
                $recette->execute(array($id_recette));

                if($recette->rowCount()==1){
                    $recette=$recette->fetch();
                    $cout_recette=$recette['cout_recette']+$quantite*$ingredient_existe['cout'];
                    $update_cout_recette=$dbco->prepare('UPDATE form_recette SET cout_recette=? WHERE id=?');
                    $update_cout_recette->execute(array($cout_recette,$id_recette));
                }
            }
        }

        $form_etape=  "CREATE TABLE IF NOT EXISTS form_etape(
            id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
            etape VARCHAR(200),
            recette_id iNT UNSIGNED,
            FOREIGN KEY(id) REFERENCES form_recette(id) ON DELETE CASCADE
            )";
        if(!$dbco->exec($form_etape)){
            echo " erreur creation table etape ou table existante; ";
        }

        foreach ($nouvelleEtape as $etape ){
            $entree_etape="INSERT INTO form_etape( etape, recette_id)
            VALUES('$etape', $id_recette )";
            if(!$dbco->exec($entree_etape)){
                echo " erreur durant entrée table etape; ";
            }
        
        }
        header("Location:home.php?message=creationsuccess");
    }

    catch(PDOException $e){
        echo 'Erreur : '.$e->getMessage();
    }
    $dbco= null;

    
    ?>
    
