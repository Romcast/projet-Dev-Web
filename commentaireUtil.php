
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="classement.css" rel="stylesheet" type="text/css">
</head>
<body>

    <h2>Commentaires de l'utilisateur</h2>
    
    <select id="choix_commentaire" size="1" onchange="f()">
        <option>--------</option>
        <option> Nom recette </option>
        <option> Commentaire </option>
    </select>

    <select id="sens_commentaire" size="1" onchange="f()">
        <option> Croissant </option>
        <option> Décroissant </option>
        
    </select>

    <br>
    <br>

    <input type="text" id="myInput_commentaire" onkeyup="filtre()" placeholder="Recherchez un commentaire..." title="Entrez votre commentaire">

    <div id="liste_commentaire">
</div>

    <script>
    function filtre() {
        var input, filter, ul, li, a, i, txtValue,inputChoix,k;
        input = document.getElementById("myInput_commentaire");
        inputChoix = document.getElementById("choix_commentaire");
        if (inputChoix.value == 'Commentaire'){
            k=1;
        }
        else{
            k=0;
        }

        filter = input.value.toUpperCase();
        ul = document.getElementById("myUL_commentaire");
        li = ul.getElementsByTagName("li");
        for (i = 0; i < li.length; i++) {
            a = li[i].getElementsByTagName("label")[k];
            txtValue = a.textContent || a.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                c = li[i].getElementsByTagName("label")[1];
                commentaire = c.textContent || c.innerText;
                if (commentaire.length > 20){
                    c.innerHTML = commentaire.substring(0,20) + "...";
                }
                 
                li[i].style.display = "";
            } else {
                li[i].style.display = "none";
        }
    }
    }

    function f() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange=function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("liste_commentaire").innerHTML = this.responseText;
            filtre();
            }
        };
        var email = "<?php echo $email?>";
        var choix = document.getElementById('choix_commentaire').value;
        var sens = document.getElementById('sens_commentaire').value;
        xhttp.open("POST", "commentaireUtilListe.php?choix="+choix+"&sens="+sens+"&email="+email, true);
        xhttp.send();
        }
    </script>

</body>
</html>