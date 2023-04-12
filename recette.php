<?php 
        // $auteur = $_POST['auteur']; 
        $nom = $_POST['nom'];
        $nombre = $_POST['nb_personnes'];
        $difficulte = $_POST['difficulte'];
        //$etapes = $_POST['etapes'];
        //$liste_ingredients = $_POST['ingredients'];
        $nouvelleQuantite= $_POST['nouvelleQuantite'];
        $nouvelleUnite=$_POST['nouvelleUnite'];
        $nouvelIngredient=$_POST['nouvelIngredient'];
        $nouvelleEtape=$_POST['nouvelleEtape'];
        // if(isset($_POST['ingredients'])) {
        //         $ingredients = $_POST['ingredients'];
                
        //       } else {
        //         echo "erreur";
        //       }
        
        
        
        $conseil = $_POST['conseils'];
        
        $nom_fichier = $_FILES['photo']['name'];//name recupere le nom du fichier sur le pc
        $chemin_fichier = $_FILES['photo']['tmp_name'];

        // Traitement de l'image (ex: enregistrement sur le serveur)
        if(move_uploaded_file($chemin_fichier, 'image/' . $nom_fichier)) {
        // Le fichier a été enregistré avec succès
                $photo = 'image/' . $nom_fichier;
                
        } else {
        // Une erreur s'est produite lors de l'enregistrement du fichier

        $photo = 'erreur';
}       



        $html = '<h1>' . $nom . '</h1>';
        $html .= '<p><strong>Nombre de personnes:</strong> ' . $nombre . '</p>';
        $html .= '<p><strong>Difficulté:</strong> ' . $difficulte . '</p>';

        $html .= $photo;
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
        //$html .= '<p>' .$etapes . '</p>' ;


        $html .= '<h2>Derniers conseils:</h2>';
        $html .= '<p>' . $conseil . '</p>';

        echo $html;
        
        ?>