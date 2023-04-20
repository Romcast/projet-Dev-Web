<?php
	$servername ="localhost";
    $username ="root";
    $password = "";
    $bdd = new PDO("mysql:host=$servername;dbname=miam;", $username, $password);
	if(isset($_GET['modif']) AND !empty($_GET['modif'])) {
	   $modif_id = $_GET['modif'];
	   $modifrecette = $bdd->prepare('SELECT * FROM form_recette WHERE id = ?');
	   $modifrecette->execute(array($modif_id));

       $modifingredient = $bdd->prepare('SELECT * FROM form_ingredient WHERE recette_id = ?');
	   $modifingredient->execute(array($modif_id));

       $modifetape = $bdd->prepare('SELECT * FROM form_etape WHERE recette_id = ?');
	   $modifetape->execute(array($modif_id));
	   
       if($modifrecette->rowCount() == 1) {
	      $modifrecette = $modifrecette->fetch();
	   } else {
	      die('Erreur : la recette n\'existe pas...');
	   }
	}
	if(isset($_POST['nom'], $_POST['type'],$_POST['nb_personnes'],$_POST['difficulte'],$_POST['conseils'], $_POST['nouvelleEtape'])) {
	   if(!empty($_POST['nom']) AND !empty($_POST['type']) AND !empty($_POST['nb_personnes']) AND !empty($_POST['difficulte'] AND !empty($_POST['conseils']) AND !empty($_POST['nouvelleEtape']))) {
	      
        $nom = $_POST['nom'];
        $type= $_POST['type'];
        $nombre = $_POST['nb_personnes'];
        $difficulte = $_POST['difficulte'];
        //$nouvelleQuantite= $_POST['nouvelleQuantite'];
        //$nouvelleUnite=$_POST['nouvelleUnite'];
        //$nouvelIngredient=$_POST['nouvelIngredient'];
        $nouvelleEtape=$_POST['nouvelleEtape'];
        $conseil = $_POST['conseils'];
	    $update = $bdd->prepare('UPDATE form_recette SET nom = ?, type_repas = ?, nombre_personnes = ?, difficulte=?, conseils=? WHERE id = ?');
	    $update->execute(array($nom, $type,$nombre,$difficulte,$conseil, $modif_id));
        foreach ($nouvelleEtape as $etape ){
            $entree_etape="INSERT INTO form_etape( etape, recette_id)
            VALUES('$etape', $modif_id )";
            $bdd->exec($entree_etape);
            
        }
	    $message = 'Votre article a bien été mis à jour !';
        //header('Location :visuelrecette.php?id='.$modif_id);
	      
	   } else {
	      $message = 'Veuillez remplir tous les champs';
	   }
	}
    if($modifrecette['photo']!=""){
        if(isset($_FILES['photo'])AND $_FILES['photo']['size']!=0){
            if ($_FILES['photo']['size'] <= 1000000)
            {
                unlink('image/' . $modif_id);
                //$nom_fichier = basename($_FILES['photo']['name']);//name recupere le nom du fichier sur le pc
                $chemin_fichier = $_FILES['photo']['tmp_name'];//chemin temporaire
        
                if(move_uploaded_file($chemin_fichier, 'image/' . $modif_id)) {
                        $photo = 'image/' . $modif_id;
                        echo 'voici le chemin de la photo: '.$photo;
                        
                } 
                else {
                $photo = 'erreur deplacement';
                }
            $ajout_photo_bdd="UPDATE form_recette SET photo = '$photo' WHERE id = $modif_id;";
            $bdd->exec($ajout_photo_bdd);         
            }
            else{
                echo "erreur taille";
            }  

        }else{
            echo "PAS changement photo";
        }
        echo "PHOTO";
        
    }else{
        echo "PAS PHOTO";
        if(isset($_FILES['photo']) AND $_FILES['photo']['size']!=0){
             if ($_FILES['photo']['size'] <= 1000000)
                {
                    //$nom_fichier = basename($_FILES['photo']['name']);//name recupere le nom du fichier sur le pc
                    $chemin_fichier = $_FILES['photo']['tmp_name'];//chemin temporaire
            
                    if(move_uploaded_file($chemin_fichier, 'image/' . $modif_id)) {
                            $photo = 'image/' . $modif_id;
                            echo 'voici le chemin de la photo: '.$photo;
                            
                    } 
                    else {
                    $photo = 'erreur deplacement';
                    }
                $ajout_photo_bdd="UPDATE form_recette SET photo = '$photo' WHERE id = $modif_id;";
                $bdd->exec($ajout_photo_bdd);         
                }
                else{
                    echo "erreur taille";
                }
            echo "changement photo";
        }
    }

	?>
	<!DOCTYPE html>
	<html>
	<head>
	   <title>Edition</title>
	   <meta charset="utf-8">
	</head>
    <body>
        <form  method="post" enctype="multipart/form-data" >
            <!-- <label>Auteur de la recette</label><br>
            <input type="text" id="auteur" name="auteur"><br><br> -->
            <label>Nom de la recette</label><br>
            <input type="text" id="nom" name="nom" value="<?=  $modifrecette['nom'] ?>"required><br><br>

            <label>Type de recette</label><br>
            <select id="type" name="type"  required>
                <option>--------------</option>
                <option value="Entrée" <?php if($modifrecette['type_repas']=="Entrée"){echo "selected"; }?>>Entrée</option>
                <option value="Plat" <?php if($modifrecette['type_repas']=="Plat"){echo "selected"; }?>>Plat</option>
                <option value="Dessert"<?php if($modifrecette['type_repas']=="Dessert"){ echo"selected";}?>>Dessert</option>
            </select><br><br>

            <label>Nombre de personne</label><br>
            <input type="number" id="nb_personnes" name="nb_personnes" value="<?=  $modifrecette['nombre_personnes'] ?>"  required><br><br>
            
            <label>Difficulté</label><br>
            <select id="difficulte" name="difficulte" required>
                <option>--------------</option>
                <option value="Facile"<?php if($modifrecette['difficulte']=="Facile"){echo "selected"; }?>>Facile</option>
                <option value="Moyenne"<?php if($modifrecette['difficulte']=="Moyenne"){echo "selected"; }?>>Moyenne</option>
                <option value="Difficile"<?php if($modifrecette['difficulte']=="Difficile"){echo "selected"; }?>>Difficile</option>
            </select><br><br>
            <label>Ingrédients:</label><br>
                    <div id="ingredients" name="ingredients[]" >
                        
                        
                    </div><br>
            <?php if($modifingredient->rowCount()>0){
                while($i=$modifingredient->fetch()){

                ?>
                    
                   
                    <input type="number" id="quantite" name="quantite" value="<?=  $i['quantite'] ?>" placeholder="quantité" >
                    <select id="unite" name="unite">
                        <option> </option>
                        <option <?php if($i['unite']=="L"){echo "selected"; }?>>L</option>
                        <option <?php if($i['unite']=="mL"){echo "selected"; }?>>mL</option>
                        <option <?php if($i['unite']=="cL"){echo "selected"; }?>>cL</option>
                        <option <?php if($i['unite']=="g"){echo "selected"; }?>>g</option>
                        <option <?php if($i['unite']=="kg"){echo "selected"; }?>>kg</option>
                        <option <?php if($i['unite']=="pincée"){echo "selected"; }?>>pincée</option>
                        <option <?php if($i['unite']=="c-à-c"){echo "selected"; }?>>c-à-c</option>
                        <option <?php if($i['unite']=="c-à-s"){echo "selected"; }?>>c-à-s</option>
                    </select>
                    <input type="text" id="nouvel_ingredient" name="nouvel_ingredient" value="<?=  $i['nom'] ?>" placeholder="ingrédient"><br><br>

                    
                    <!-- <button id="supprimer_dernier_ingredient">Supprimer dernier ingrédient</button><br><br> -->
            
           <?php }}?>
                 <button id="ajouter_ingredient" type="button">Ajouter ingrédient</button><br><br>
                
            <label>Phases techniques</label><br>
		    
            <?php if($modifetape->rowCount()>0){
                while($e=$modifetape->fetch()){

                ?>
            <input type="text" value="<?=  $e['etape'] ?>" name="nouvelle_etape">
            
            <button id="supprimer_derniere_etape">Supprimer</button><br><br>
            <?php }}?>
            <input type="text" id="nouvelle_etape" name="nouvelle_etape">
            <button id="ajouter_etape" type="button">Ajouter étape</button><br><br>

            <div id="etapes" name="etapes[]">
                
            </div><br>
            <label>Dernier conseils du chef</label><br>
		    <textarea id="conseils" name="conseils" class="text"><?=$modifrecette['conseils'] ?></textarea><br><br>
            <input type="file" id="photo" name="photo" accept="image/jpeg, image/png, image/jpg"><br><br>
            <button type="submit">Enregistrer la recette</button><br><br>
            
            
        </form>
        <script src="modifrecette.js"></script>
        <?php if(isset($message)) { echo $message; } ?>
	</body>
	</html>