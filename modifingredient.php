<?php
   require('header.php');
    $servername ="localhost";
    $username ="root";
    $password = "";
    $bdd = new PDO("mysql:host=$servername;dbname=miam;", $username, $password);
	if(isset($_GET['modif']) AND !empty($_GET['modif'])) {
	   $modif_id = $_GET['modif'];
       $modifingredient = $bdd->prepare('SELECT * FROM form_ingredient WHERE recette_id = ?');
	   $modifingredient->execute(array($modif_id));} 
	?>
	<!DOCTYPE html>
	<html>
	<head>
	   <title>Edition</title>
	   <meta charset="utf-8">
       <script>

function ajouterNouvelIngredient() {
  var ingredientCount = 1;
  var addButton = document.getElementById("ajouter_ingredient");

  // Add event listener only if it hasn't been added before
  if (!addButton.hasAttribute("data-clicked")) {
    addButton.setAttribute("data-clicked", "true");
    addButton.addEventListener("click", ajouterIngredient);
  }

  function ajouterIngredient() {
    var div = document.createElement("div");
    div.innerHTML ='<input type="number" id="nouvelle_quantite' + ingredientCount + '" name="nouvelle_quantite[]"><select id="nouvelle_unite' + ingredientCount + '" name="nouvelle_unite[]"><option> </option><option>L</option><option>mL</option><option>cL</option><option>g</option><option>kg</option><option>pincée</option><option>c-à-c</option><option>c-à-s</option></select><input type="text" id="nouveau_nom' + ingredientCount + '" name="nouveau_nom[]"><button id="annuler_ingredient" type="button" onclick="supprimerNouvelIngredient(this.parentNode)">-</button><br><br><br><br>';
    document.getElementById("ingredients").appendChild(div);
    ingredientCount++;
  }
}

function supprimerNouvelIngredient(nouvingredient) {
nouvingredient.parentNode.removeChild(nouvingredient);
}



function supprimerIngredient(id) {
  // Supprimer l'étape de la page
  var quantite = document.getElementById("modif_quantite" + id);
  var unite=document.getElementById("modif_unite" + id);
  var nom = document.getElementById("modif_nom" + id);

  quantite.parentNode.removeChild(quantite);
  while (unite.firstChild) {
    unite.removeChild(unite.firstChild);
}
unite.parentNode.removeChild(unite);
  nom.parentNode.removeChild(nom);
  
  
  // Supprimer l'ingredient de la base de données
  var httpRequest = new XMLHttpRequest();
  httpRequest.onreadystatechange = function() {
    if (httpRequest.readyState === XMLHttpRequest.DONE) {
      if (httpRequest.status === 200) {
        console.log(httpRequest.responseText);
      } else {
        console.log('Il y a eu un problème avec la requête.');
      }
    }
  };
  httpRequest.open('DELETE', 'deleteingredient.php?delete=' + id);
  httpRequest.send();
}


       </script>
      
	</head>
    <body>
        <form  method="post" enctype="multipart/form-data" >
            
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
                $nouvelleUnite=$_POST['nouvelle_quantite'];
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
         <button type="submit">Enregistrer la recette</button><br><br>
        </form>
        

        <?php if(isset($message)) { echo $message; } ?>
	</body>
	</html>
    
