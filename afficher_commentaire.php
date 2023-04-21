<html>
    <head>
        <link href="afficher_commentaire.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <?php
            $serveur = "localhost";
            $user = "root";
            $pass = "";
            $dbname="miam";
            $recette_id=$_SESSION['recette_id'];
            //On se connecte à la BDD
            $dbco = new PDO("mysql:host=$serveur;dbname=$dbname",$user,$pass);
            $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            try{
                if (isset($_GET['id'])) {
                    $statement=$dbco->prepare("SELECT mail_auteur,commentaire,note FROM commentaire WHERE recette_id=$recette_id");
                    $statement->execute();
                    $commentaires=$statement->fetchAll(PDO::FETCH_ASSOC);
                    echo '<div>' . '<div class="ligne">' . '<div >' . 'auteur'. '</div>'.'<div>'. 'commentaire'.'</div>' . '<div >' . 'note' .'</div>'. '</div>'. '</div>';
                    foreach($commentaires as $commentaire){
                        echo '<div id="commentaires">' . '<div class="ligne">' . '<div class="auteur">' . $commentaire['mail_auteur']. '</div>'. '<div class="commentaire">' . $commentaire['commentaire'] .'</div>'. '<div class="note">' . $commentaire['note'] .'</div>'. '</div>'. '</div>';
                    }
                }
    
    
            }


            catch(PDOException $e){

            }

            $dbco=null;
        ?>

    </body>
    
</html>

