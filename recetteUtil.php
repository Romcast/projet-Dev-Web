

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="classement.css" rel="stylesheet" type="text/css">
</head>
<body>

    <h2>Recettes de l'utilisateur</h2>
    
    <select id="choix" size="1" onchange="f_r()">
        <option>--------</option>
        <option> Nom </option>
        <option> Note moyenne </option>
        <option> Cout </option>
        <option> Nombre personne </option>
    </select>

    <select id="sens" size="1" onchange="f_r()">
        <option> Croissant </option>
        <option> Décroissant </option>
        
    </select>

    <br>
    <br>

    <input type="text" id="myInput" onkeyup="filtre_r()" placeholder="Recherchez une recette..." title="Entrez une recette">

    <div id="liste">
</div>

    <script>
    function filtre_r() {
        var input, filter, ul, li, a, i, txtValue;
        input = document.getElementById("myInput");
        
        filter = input.value.toUpperCase();
        ul = document.getElementById("myUL");
        li = ul.getElementsByTagName("li");
        for (i = 0; i < li.length; i++) {
            a = li[i].getElementsByTagName("label")[0];
            txtValue = a.textContent || a.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "";
            } else {
                li[i].style.display = "none";
        }
    }
    }

    function f_r() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange=function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("liste").innerHTML = this.responseText;
            filtre_r();
            }
        };
        var email = "<?php echo $email?>";
        var choix = document.getElementById('choix').value;
        var sens = document.getElementById('sens').value;
        xhttp.open("POST", "recetteUtilListe.php?choix="+choix+"&sens="+sens+"&email="+email, true);
        xhttp.send();
        }
    </script>

</body>
</html>