<img src=<?php echo $_SESSION['image'] ?> alt="Introuvable" width="30" height="30" onclick="window.location='profil.php'">
<label onclick="window.location='profil.php'"><?php echo $_SESSION['email'] ?> </label>
<br>
<button onclick="window.location='nouvellerecette.php'">Créer une nouvelle recette</button>
<form action="deconnexion.php">
                <button type="submit">Déconnexion</button>
</form>