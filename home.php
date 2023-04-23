
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="home.css" rel="stylesheet" type="text/css">
        <title>Miam</title>
    </head>
    <body>
        <?php include('header.php');
        $serveur = "localhost";
        $user = "root";
        $pass = "";
        $dbname="miam";
        
        //On se connecte à la BDD
        $dbco = new PDO("mysql:host=$serveur;dbname=$dbname",$user,$pass);
        $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //on  crée toutes les bdd
        try{
            //On crée une table commentaire
            $commentaire = "CREATE TABLE IF NOT EXISTS commentaire(
                commentaire_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
                mail_auteur VARCHAR(50) NOT NULL,
                commentaire VARCHAR(5000),
                note INT,
                date_creation DATETIME NOT NULL,
                recette_id iNT UNSIGNED,
                UNIQUE(recette_id,mail_auteur),
                FOREIGN KEY(recette_id) REFERENCES form_recette(id) ON DELETE CASCADE
                )";
            $dbco->exec($commentaire);

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
              echo " erreur création table ingrédient ou table déjà existante; ";
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
            $utilisateur = "CREATE TABLE IF NOT EXISTS utilisateur(
              id_user INT UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
              email VARCHAR(100),
              password VARCHAR(30),
              nom VARCHAR(50) DEFAULT '',
              prenom VARCHAR(50) DEFAULT '',
              image VARCHAR(50) DEFAULT 'imageProfil/utilisateur.png',
              date_creation DATE DEFAULT '0000-00-00',
              administrateur INTEGER DEFAULT 0,
              ban INTEGER DEFAULT 0,
              note_moy FLOAT DEFAULT 0.0,
              util_semaine INTEGER DEFAULT 0
              )";
            
              $dbco->exec($utilisateur);


        }
        catch(PDOException $e){
          echo 'Erreur : '.$e->getMessage();
        }
        $dbco= null;
        ?>
        
        
        <br>
        <br>
        <div class="slideshow-container">
            <a href="entree.php">
              <div class="slide">
                <img src="image/salade.jpg" alt="Image 1">
                <div class="caption">Entrées</div>
              </div>
            </a>
            <a href="plats.php">
              <div class="slide">
                <img src="image/entrecote.jpg" alt="Image 2">
                <div class="caption">Plats</div>
              </div>
            </a>
            <a href="desserts.php">
              <div class="slide">
                <img src="image/profiteroles.jpg" alt="Image 3">
                <div class="caption">Desserts</div>
              </div>
            </a>
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>
          </div>
          <script src="diapo.js"></script>
        </br>
    </br>
</br>
</br>
</br>
</br>
</br>
</br>
</br>
</br>
</br>
</br>
</br>
</br>
</br>
</br>
</br>
</br>
</br>
<?php require('utilSemaineSql.php'); ?>
</br>
</br>


    </body>
</html>
