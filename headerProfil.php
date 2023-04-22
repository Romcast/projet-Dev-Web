<img src=<?php echo $_SESSION['image'] ?> alt="Introuvable" width="30" height="30" onclick="window.location='visuelProfil.php?id_user=<?php echo $_SESSION['id_user']?>'">
<label onclick="window.location='visuelProfil.php?id_user=<?php echo $_SESSION['id_user']?>'"><?php echo $_SESSION['email'] ?> </label>
<br>

<form action="deconnexion.php">
                <button type="submit">Déconnexion</button>
</form>