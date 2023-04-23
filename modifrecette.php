<?php
require('header.php');
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
	if(isset($_POST['nom'], $_POST['type'],$_POST['nb_personnes'],$_POST['difficulte'],$_POST['conseils'])) {
	   if(!empty($_POST['nom']) AND !empty($_POST['type']) AND !empty($_POST['nb_personnes']) AND !empty($_POST['difficulte'] AND !empty($_POST['conseils']))) {
	      
        $nom = $_POST['nom'];
        $type= $_POST['type'];
        $nombre = $_POST['nb_personnes'];
        $difficulte = $_POST['difficulte'];
        //$nouvelleQuantite= $_POST['nouvelleQuantite'];
        //$nouvelleUnite=$_POST['nouvelleUnite'];
        //$nouvelIngredient=$_POST['nouvelIngredient'];
        $conseil = $_POST['conseils'];
	    $update = $bdd->prepare('UPDATE form_recette SET nom = ?, type_repas = ?, nombre_personnes = ?, difficulte=?, conseils=? WHERE id = ?');
	    $update->execute(array($nom, $type,$nombre,$difficulte,$conseil, $modif_id));
	    $message = 'Votre article a bien été mis à jour !';
        //header('Location :visuelrecette.php?id='.$modif_id);
	      
	   } else {
	      $message = 'Veuillez remplir tous les champs';
	   }
	}
    
    if (isset($_POST['suppr'])){
        if (basename($modifrecette['photo']) !== "recette.png"){
            unlink($modifrecette['photo']);
          }
        $photo = 'image/recette.png';
        $ajout_photo_bdd="UPDATE form_recette SET photo = '$photo' WHERE id = $modif_id;";
        $bdd->exec($ajout_photo_bdd);
    }
    elseif(isset($_FILES['photo']) AND $_FILES['photo']['size']!=0){
        if ($_FILES['photo']['size'] <= 1000000)
        {
            if (basename($modifrecette['photo']) !== "recette.png"){
                unlink($modifrecette['photo']);
              }
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
    }

	?>
	<!DOCTYPE html>
	<html>
	<head>
	   <title>Edition</title>
	   <meta charset="utf-8">
       <script src="modifrecette.js"></script>
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
		    
            <?php if($modifingredient->rowCount()>0){
                while($i=$modifingredient->fetch()){
                ?>
            <div >
            <input type="number" id=<?='"modif_quantite'.$i['id'].'"'?> name=<?='"modif_quantite'.$i['id'].'"'?> value="<?=  $i['quantite'] ?>" placeholder="quantité" >
            <select id=<?='"modif_unite'.$i['id'].'"'?> name=<?='"modif_unite'.$i['id'].'"'?>>
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
            <input type="text" id=<?='"modif_nom'.$i['id'].'"'?> name=<?='"modif_nom'.$i['id'].'"'?> value="<?=  $i['nom'] ?>" placeholder="ingrédient">
           <button type="button" onclick="supprimerIngredient(<?php echo $i['id'] ?>)">-</button>
            </div><br>
           <?php 
            if(isset($_POST['modif_quantite'.$i['id']])) {
            if(!empty($_POST['modif_quantite'.$i['id']])) {
               $mQuantite=$_POST['modif_quantite'.$i['id']];
               $entree_quantite=$bdd->prepare('UPDATE form_ingredient SET quantite=? WHERE id=?');
               $entree_quantite->execute(array($mQuantite, $i['id']));
               $message = 'Votre article a bien été mis à jour !';
            }else {
	         $message = 'Veuillez remplir tous les champs';
	         }
            }
            if(isset($_POST['modif_unite'.$i['id']])) {
                if(!empty($_POST['modif_unite'.$i['id']])) {
                   $mUnite=$_POST['modif_unite'.$i['id']];
                   $entree_unite=$bdd->prepare('UPDATE form_ingredient SET unite=? WHERE id=?');
                   $entree_unite->execute(array($mUnite, $i['id']));
                   $message = 'Votre article a bien été mis à jour !';
                }else {
                 $message = 'Veuillez remplir tous les champs';
                 }
            }
            if(isset($_POST['modif_nom'.$i['id']])) {
                if(!empty($_POST['modif_nom'.$i['id']])) {
                    $mNom=$_POST['modif_nom'.$i['id']];
                    $entree_nom=$bdd->prepare('UPDATE form_ingredient SET nom=? WHERE id=?');
                    $entree_nom->execute(array($mNom, $i['id']));
                    $message = 'Votre article a bien été mis à jour !';
                }else {
                    $message = 'Veuillez remplir tous les champs';
                }
            }
            if(isset($_POST['supprimer_ingredient'.$i['id']])) {
               $supprimer_ingredient=$bdd->prepare('DELETE FROM form_ingredient WHERE id=?');
               $supprimer_ingredient->execute(array($i['id']));
               $message = 'L\'ingredient a bien été supprimée !';
           }
         }}
         if(isset($_POST['nouveau_nom'],$_POST['nouvelle_quantite'],$_POST['nouvelle_unite'])){
            if(!empty($_POST['nouveau_nom']) AND !empty($_POST['nouvelle_quantite']) AND !empty($_POST['nouvelle_unite'])){
                $nouveauNom=$_POST['nouveau_nom'];
                $nouvelleQuantite=$_POST['nouvelle_quantite'];
                $nouvelleUnite=$_POST['nouvelle_unite'];
                if (is_array($nouveauNom) && is_array($nouvelleQuantite) && is_array($nouvelleUnite)) {
                    foreach ($nouveauNom as $key => $ingredient) {
                        $quantite = $nouvelleQuantite[$key];
                        $unite = $nouvelleUnite[$key];
                        $entree_ingredient="INSERT INTO form_ingredient(nom, quantite, unite, recette_id) VALUES('$ingredient','$quantite','$unite', $modif_id)";
                        $bdd->exec($entree_ingredient);
                    }  
                } else {
                    if (is_array($nouvelleUnite)) {
                        $nouvelleUnite = $nouvelleUnite[0];
                    }
                    $entree_ingredient="INSERT INTO form_ingredient(nom, quantite, unite, recette_id) VALUES('$nouveauNom','$nouvelleQuantite','$nouvelleUnite', $modif_id)";
                    $bdd->exec($entree_ingredient);
                }
            }
            
         }
         
         ?>
         <div id="ingredients">
                
         </div><br>
         <button id="ajouter_ingredient" onclick="ajouterNouvelIngredient()" type="button">Ajouter ingredient</button><br><br>
            
            <label>Phases techniques</label><br>
		    
            <?php if($modifetape->rowCount()>0){
                while($e=$modifetape->fetch()){
                ?>
            <div >
               <input type="text" value="<?=  $e['etape'] ?>" id=<?='"modif_etape'.$e['id'].'"'?> name=<?='"modif_etape'.$e['id'].'"'?>>
               <button type="button" onclick="supprimerEtape(<?php echo $e['id'] ?>)">-</button>
            </div><br>
           <?php 
            if(isset($_POST['modif_etape'.$e['id']])) {
            if(!empty($_POST['modif_etape'.$e['id']])) {
               $mEtape=$_POST['modif_etape'.$e['id']];
               $entree_etape=$bdd->prepare('UPDATE form_etape SET etape=? WHERE id=?');
               $entree_etape->execute(array($mEtape, $e['id']));
               $message = 'Votre article a bien été mis à jour !';
            }else {
	         $message = 'Veuillez remplir tous les champs';
	         }
            }
            if(isset($_POST['supprimer_etape'.$e['id']])) {
               $supprimer_etape=$bdd->prepare('DELETE FROM form_etape WHERE id=?');
               $supprimer_etape->execute(array($e['id']));
               $message = 'L\'étape a bien été supprimée !';
           }
         }}
         if(isset($_POST['nouvelle_etape']) AND !empty($_POST['nouvelle_etape']) ){
            $nouvelleEtape=$_POST['nouvelle_etape'];
            if (is_array($nouvelleEtape)) {
            foreach ($nouvelleEtape as $etape ){
            $entree_etape="INSERT INTO form_etape( etape, recette_id)
            VALUES('$etape', $modif_id )";
            $bdd->exec($entree_etape);
            }
         }else{
            $entree_etape="INSERT INTO form_etape( etape, recette_id)
            VALUES('$nouvelleEtape', $modif_id )";
            $bdd->exec($entree_etape);
          }}
         
         ?>
         <div id="etapes">
                
         </div><br>
         <button id="ajouter_etape" onclick="ajouterNouvelleEtape()" type="button">Ajouter étape</button><br><br>
            
            <label>Dernier conseils du chef</label><br>
		    <textarea id="conseils" name="conseils" class="text"><?=$modifrecette['conseils'] ?></textarea><br><br>
            <input type="file" id="photo" name="photo" accept="image/jpeg, image/png, image/jpg">
            <input type ="checkbox" id="suppr" name="suppr">
            <label for="suppr">Supprimer</label><br><br>
            <button type="submit">Enregistrer la recette</button><br><br>
            
            
        </form>
        <?php if(isset($message)) { echo $message; } ?>
	</body>
	</html>
