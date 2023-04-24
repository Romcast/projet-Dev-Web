<?php
    require('header.php');
    $servername ="localhost";
    $username ="root";
    $password = "";
    $bdd = new PDO("mysql:host=$servername;dbname=miam;", $username, $password);
    if(isset($_GET['modif']) AND !empty($_GET['modif'])){
        $modif_id=$_GET['modif'];
        $modif=$bdd->prepare('SELECT * FROM form_ingredient WHERE id= ?');
        $modif->execute(array($modif_id));
        
        if($modif->rowCount() == 1) {
            $modif = $modif->fetch();
         } else {
            die('Erreur : l\'ingredient n\'existe pas...');
         }
       $mise_a_jour_cout_recette=$bdd->prepare('SELECT * FROM form_recette WHERE id= ?');
       $mise_a_jour_cout_recette->execute(array($modif['recette_id']));
       if($mise_a_jour_cout_recette->rowCount() == 1) {
            $mise_a_jour_cout_recette = $mise_a_jour_cout_recette->fetch();
       } else {
        die('Erreur : la recette n\'existe pas...');
     }
    }
    if(isset($_POST['prix']) AND !empty($_POST['prix'])){
            $prix=$_POST['prix'];
            $update = $bdd->prepare('UPDATE form_ingredient SET cout=? WHERE nom=? AND unite=?');
            $update->execute(array($prix,$modif['nom'],$modif['unite']));
            $message = 'Le prix de l\'ingrédient a bien été mis à jour !';
            $update_recette = $bdd->prepare('UPDATE form_recette SET cout_recette=? WHERE id=?');
            $cout_recette=$mise_a_jour_cout_recette['cout_recette']+$prix*$modif['quantite'];
            $update_recette->execute(array($cout_recette,$modif['recette_id'])); 
       //header('Location:liste_ingredient_cout.php');
        }else{
            $message = 'Veuillez remplir tous les champs';
        }
?>
<!DOCTYPE html>
	<html>
	<head>
	   <title>Edition du prix</title>
	   <meta charset="utf-8">
	</head>
    <body>
        <form  method="post" >

            <label>Nouveau prix de l'ingrédient :</label><br>
            <p><?php echo $modif['nom'];?></p>
            <p> <input type="number" id="prix" name="prix" value="<?=  $modif['cout'] ?>"  ><br><br></p><br><br>
            
    <button type="submit">Enregistrer le nouveau prix</button><br><br>
            
            
        </form>

        <?php if(isset($message)) { echo $message; } ?>
	</body>
	</html>
