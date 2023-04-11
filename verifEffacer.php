<?php 
session_start(); 
if (isset($_SESSION['email'])){
}

else{
    header("Location:connexion.html");
}
?>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="connexion.css" rel="stylesheet" type="text/css">
        <title>Effacer le compte</title>
    </head>
    <body>
        <div id="d1">
        <form>
            <h1 class="titre">Effacer le compte</h1>
            <div class="utilisateur">
                <label> Entrez votre mot de passe :</label><br><br>
                <input type="password" id="password" name="password" placeholder="Mot de passe"><br><br>
                <div id="err"></div><br>
            </form>
            </div>
        <div class="bouton">
            <button type="button" onclick="f()">Effacer</button>
          </div>
        </br>
        </div>

        <script>
            function f() {
                var xhttp = new XMLHttpRequest();
              
            xhttp.onreadystatechange=function() {
                if (this.readyState == 4 && this.status == 200) {
                    if (this.response){
                        document.getElementById("err").innerHTML = "Mot de passe incorrecte";
                    }
                    else{
                        window.location = "profilEfface.html";
                    }
                    
                }
              };
              var password=document.getElementById('password').value;
              xhttp.open("POST", "effacerCompte.php?password=" + password, true);
              xhttp.send();
            }
            </script>
    </body>

</html>