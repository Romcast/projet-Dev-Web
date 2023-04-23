<?php
   require('header.php');
    $servername ="localhost";
    $username ="root";
    $password = "";
    $bdd = new PDO("mysql:host=$servername;dbname=miam;", $username, $password);
	if(isset($_GET['modif']) AND !empty($_GET['modif'])) {
	   $modif_id = $_GET['modif'];
       $modifetape = $bdd->prepare('SELECT * FROM form_etape WHERE recette_id = ?');
	   $modifetape->execute(array($modif_id));} 
	?>
	<!DOCTYPE html>
	<html>
	<head>
	   <title>Edition</title>
	   <meta charset="utf-8">
      <script>
         function ajouterNouvelleEtape() {
  var etapeCount = 1;
  document.getElementById("ajouter_etape").addEventListener("click", function() {
    var div = document.createElement("div");
    div.innerHTML = '<input type="text" id="nouvelle_etape_' + etapeCount + '" name="nouvelle_etape[]"><button id="annuler_etape" type="button" onclick="supprimerNouvelleEtape(this.parentNode)">-</button><br><br><br><br>';
    document.getElementById("etapes").appendChild(div);
    etapeCount++;
  });
}


function supprimerNouvelleEtape(nouvetape) {
nouvetape.parentNode.removeChild(nouvetape);
}



function supprimerEtape(id) {
  // Supprimer l'étape de la page
  var etape = document.getElementById("modif_etape" + id);
  etape.parentNode.removeChild(etape);
  
  // Supprimer l'étape de la base de données
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
  httpRequest.open('DELETE', 'deleteetape.php?delete=' + id);
  httpRequest.send();
}


      </script>
      
	</head>
    <body>
        <form  method="post" enctype="multipart/form-data" >
            
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
         <button id="ajouter_etape" type="button">Ajouter étape</button>
         <button type="submit">Enregistrer la recette</button><br><br>
        </form>
        

        <?php if(isset($message)) { echo $message; } ?>
	</body>
	</html>
