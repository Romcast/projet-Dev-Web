<?php 
        // $auteur = $_POST['auteur']; 

        $nom = $_POST['nom'];
        $type= $_POST['type'];
        $nombre = $_POST['nb_personnes'];
        $difficulte = $_POST['difficulte'];
        $nouvelleQuantite= $_POST['nouvelleQuantite'];
        $nouvelleUnite=$_POST['nouvelleUnite'];
        $nouvelIngredient=$_POST['nouvelIngredient'];
        $nouvelleEtape=$_POST['nouvelleEtape'];

        
        
        $conseil = $_POST['conseils'];


        if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0)
        {
        
                if ($_FILES['photo']['size'] <= 1000000)
                {
                    $nom_fichier = basename($_FILES['photo']['name']);//name recupere le nom du fichier sur le pc
                    $chemin_fichier = $_FILES['photo']['tmp_name'];//chemin temporaire
            
                    if(move_uploaded_file($chemin_fichier, 'image/' . $nom_fichier)) {
                            $photo = 'image/' . $nom_fichier;
                            
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
        


        $html = '<h1>' . $nom . '</h1>';
        $html .= '<p><strong> Type de recette:</strong> ' .$type . '</p>';
        $html .= '<p><strong>Nombre de personnes:</strong> ' . $nombre . '</p>';
        $html .= '<p><strong>Difficulté:</strong> ' . $difficulte . '</p>';

        //$html .= $photo;
        $html .= '<h2>Ingrédients:</h2>';
        $html .= '<ul>';

        $size_ing=sizeof($nouvelIngredient);
        for ($i=0; $i<$size_ing; $i++){
            $html .= '<li>' . $nouvelleQuantite[$i] ." ". $nouvelleUnite[$i]." de " .$nouvelIngredient[$i].   '</li>';
        }
        $html .= '</ul>';
        

        $html .= '<h2>phase technique:</h2>';
        $html .= '<ul>';
        $size_etapes = sizeof($nouvelleEtape);
        for ($i=0; $i<$size_etapes; $i++){
                $html .= '<li>' . $nouvelleEtape[$i].   '</li>';
        }
        $html .= '</ul>';
        


        $html .= '<h2>Derniers conseils:</h2>';
        $html .= '<p>' . $conseil . '</p>';

        //print_r($nouvelleEtape);
        //echo strip_tags($html);
        //header("Location:merciRecette.html");

        //afficher la photo
        // $type=exif_imagetype($photo);

        // if($type ==IMAGETYPE_JPEG){
            
        //     $image=imagecreatefromjpeg($photo);
        //     header('Content-Type: image/jpeg');
        //     imagejpeg($image);
            
        // }
        // elseif($type ==IMAGETYPE_JPG){
        //     $image=imagecreatefromjpg($photo);
        //     header('Content-Type: image/jpg');
        //     imagejpg($image);
        // }
        
        // elseif($type ==IMAGETYPE_JPG){
        //     $image=imagecreatefrompng($photo);
        //     header('Content-Type: image/png');
        //     imagepng($image);
        // }

        // else{
        //     echo "erreur type";
        // }
        
        // //readfile($photo);




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
            conseils VARCHAR(500)  )";
        $dbco->exec($form_recette);
        echo "  la table recette a ete cree; ";
        $entree_recette="INSERT INTO form_recette( nom, auteur, type_repas, nombre_personnes, difficulte, conseils)
        VALUES('$nom', 'fkf' ,'$type', $nombre, '$difficulte', '$conseil')";
        
        $dbco->exec($entree_recette);
        echo " recette ajoutée";

        $form_ingredient=  "CREATE TABLE IF NOT EXISTS form_ingredient(
            id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
            nom VARCHAR(50) NOT NULL,
            quantite INT NOT NULL,
            unite VARCHAR(10) ,
            cout INT,
            recette_id iNT UNSIGNED,
            FOREIGN KEY(id) REFERENCES form_recette(id) ON DELETE CASCADE
            )";
        $dbco->exec($form_ingredient);
        echo " la table ingredient a ete cree; ";

        for ($i=0; $i<$size_ing; $i++){
            $quantite=  $nouvelleQuantite[$i] ;
            $ingredient= $nouvelIngredient[$i];
            $unite= $nouvelleUnite[$i];
            $entree_ingredient="INSERT INTO form_ingredient( nom, quantite, unite, cout, recette_id)
            VALUES('$ingredient', $quantite ,'$unite', NULL,10 )";
            $dbco->exec($entree_ingredient);
            echo 'ingredient '. $i+1 .' enregistré ';
        }

        $form_etape=  "CREATE TABLE IF NOT EXISTS form_etape(
            id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
            etape VARCHAR(200),
            recette_id iNT UNSIGNED,
            FOREIGN KEY(id) REFERENCES form_recette(id) ON DELETE CASCADE
            )";
        $dbco->exec($form_etape);
        echo " la table etape a ete cree; ";


        foreach ($nouvelleEtape as $etape ){
            $entree_etape="INSERT INTO form_etape( etape, recette_id)
            VALUES('$etape', 11 )";
            $dbco->exec($entree_etape);
            echo 'etape '. $i .' enregistré ';
        
        
        }
    }

        
        
    catch(PDOException $e){
        echo 'Erreur : '.$e->getMessage();
    }
    $dbco= null;
        ?>