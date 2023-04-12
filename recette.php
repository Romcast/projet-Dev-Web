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
        // Testons si le fichier n'est pas trop gros
                if ($_FILES['photo']['size'] <= 1000000)
                {
                    $nom_fichier = basename($_FILES['photo']['name']);//name recupere le nom du fichier sur le pc
                    $chemin_fichier = $_FILES['photo']['tmp_name'];//chemin temporaire
            
                    // Traitement de l'image (ex: enregistrement sur le serveur)
                    if(move_uploaded_file($chemin_fichier, 'image/' . $nom_fichier)) {
                    // Le fichier a été enregistré avec succès
                            $photo = 'image/' . $nom_fichier;
                            
                    } 
                    else {
                    // Une erreur s'est produite lors de l'enregistrement du fichier
            
                    $photo = 'erreur deplacement';
                    }      
                }
                else{
                    echo "erreur taille";
                }
        }
        else{
            echo "introuvable";
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
        //echo $html;
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
    
        //On crée une table form
        $form = "CREATE TABLE IF NOT EXISTS form_recette(
            id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
            nom VARCHAR(50) NOT NULL,
            auteur VARCHAR(50) NOT NULL,
            type_repas VARCHAR(20) NOT NULL,
            nombre_personnes INT NOT NULL,
            difficulte VARCHAR(20) NOT NULL,
            conseils VARCHAR(500))";
        $dbco->exec($form);
        echo "  la table a ete cree";
        $entree="INSERT INTO form_recette(id, nom, auteur, type_repas, nombre_personnes, difficulte, conseils)
        VALUES( 1,'$nom', 'fkf' ,'$type', $nombre, '$difficulte', '$conseil')";
        
        $dbco->exec($entree);
        echo "entrée effectuée";
    }
        
        
    catch(PDOException $e){
        echo 'Erreur : '.$e->getMessage();
    }
    $dbco= null;
        ?>