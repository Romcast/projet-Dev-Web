<?php include('header.php') ?>
<?php 
if (isset($_SESSION['email'])){

}

else{
    header("Location:connexion.php");
}
?>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="connexion.css" rel="stylesheet" type="text/css">
    <title>Modifier Profil</title>
</head>
<body>
    <div id="d1">        
        <h1 class="titre">Modifier Profil</h1>
        <div class="utilisateur">
            <form action="modifImage.php" method="post" enctype="multipart/form-data">
                <label>Photo de Profil :</label><br>
                <img id="image" src= <?php echo $_SESSION['image'] ?> alt="Introuvable" width="100" height="100"><br><br>
                <input type="file" id='file' name="file"><br><br>
                <button type="submit" name="submit">Changer Image</button>
            </form>
            <label>Email :</label><br>
            <input type="email" id="email" name="email" placeholder="Email" value= <?php echo $_SESSION['email'] ?> ><br><br>
            <label>Ancien mot de passe :</label><br>
            <input type="password" id="old_password" name="old_password" placeholder="Ancien mot de passe"><br><br>
            <label>Nouveau mot de passe :</label><br>
            <input type="password" id="new_password" name="new_password" placeholder="Nouveau mot de passe"><br><br>
            <label>Nom :</label><br>
            <input type="text" id="nom" name="nom" placeholder="Nom" value= <?php echo $_SESSION['nom'] ?> ><br><br>
            <label>Prénom :</label><br>
            <input type="text" id="prenom" name="prenom" placeholder="Prénom" value= <?php echo $_SESSION['prenom'] ?> ><br><br>
            <div id="err"></div>
            <div class="bouton">
                <button type="button" onclick="f()">Changer</button>
            </div>
        </div>
    </br>
    </div>

    <script>
            function f() {
                var xhttp = new XMLHttpRequest();
              
            xhttp.onreadystatechange=function() {
                if (this.readyState == 4 && this.status == 200) {
                    if (this.response==2){
                        document.getElementById("err").innerHTML = "Mot de passe incorrect !";
                    }
                    if (this.response==1){
                        document.getElementById("err").innerHTML = "Email déjà utilisé !";
                    }
                    if (this.response==0){
                        window.location = "profil.php";
                    }
                    
                }
              };
              var email=document.getElementById('email').value;
              var old_password=document.getElementById('old_password').value;
              var new_password=document.getElementById('new_password').value;
              var nom=document.getElementById('nom').value;
              var prenom=document.getElementById('prenom').value;
              xhttp.open("POST", "modifProfil.php?email=" + email +"&old_password=" + old_password +"&new_password=" + new_password +"&nom=" + nom +"&prenom=" + prenom, true);
              xhttp.send();
            }
            </script>

</body>

</html>


