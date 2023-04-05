<?php 
        // $auteur = $_POST['auteur']; 
        $nom = $_POST['nom'];
        $nombre = $_POST['nb_personnes'];
        $difficulte = $_POST['difficulte'];
        $etapes = $_POST['etapes'];
        $ingredients = $_POST['ingredients'];
        $conseil = $_POST['conseils'];
        
        $nom_fichier = $_FILES['photo']['name'];//name recupere le nom du fichier sur le pc
        $chemin_fichier = $_FILES['photo']['tmp_name'];

        // Traitement de l'image (ex: enregistrement sur le serveur)
        if(move_uploaded_file($chemin_fichier, 'projet/image' . $nom_fichier)) {
        // Le fichier a été enregistré avec succès
                $photo = 'projet/image/' . $nom_fichier;
        } else {
        // Une erreur s'est produite lors de l'enregistrement du fichier
        $photo = 'erreur';
}

        $nom = 'titre';
        $nombre = 5;
        $difficulte = 'difficile';
        $etapes = ['kkfkkr'];
        $ingredients = ['rjkfkfk','jfeejf'];
        $conseil = 'dkfdkf';
        $photo = 'image/lasagne.jpg';

        $html = '<h1>' . $nom . '</h1>';
        $html .= '<p><strong>Nombre de personnes:</strong> ' . $nombre . '</p>';
        $html .= '<p><strong>Difficulté:</strong> ' . $difficulte . '</p>';

        $html .= $photo;
        $html .= '<h2>Ingrédients:</h2>';
        $html .= '<ul>';
        foreach ($ingredients as $ingredient) {
            $html .= '<li>' . $ingredient . '</li>';
        }
        $html .= '</ul>';
        //$html .='<p>' . $ingredients . '</p>';


        $html .= '<h2>phase technique:</h2>';
        $html .= '<ul>';
        foreach ($etapes as $etape) {
            $html .= '<li>' . $etape . '</li>';
        }
        $html .= '</ul>';
        //$html .= '<p>' .$etapes . '</p>' ;


        $html .= '<h2>Derniers conseils:</h2>';
        $html .= '<p>' . $conseil . '</p>';

        echo $html;
        ?>