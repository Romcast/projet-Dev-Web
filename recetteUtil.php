

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="classement.css" rel="stylesheet" type="text/css">
</head>
<body>

    <h2>Recette de l'utilisateur</h2>
    
    <select id="choix" size="1" onchange="f()">
        <option>--------</option>
        <option> Nom </option>
        <option> Note moyenne </option>
        <option> Cout </option>
        <option> Nombre personne </option>
    </select>

    <select id="sens" size="1" onchange="f()">
        <option> Croissant </option>
        <option> Décroissant </option>
        
    </select>

    <br>
    <br>

    <input type="text" id="myInput" onkeyup="filtre()" placeholder="Search for names.." title="Type in a name">

    <div id="liste">
</div>

    <script>
    function filtre() {
        var input, filter, ul, li, a, i, txtValue;
        input = document.getElementById("myInput");
        input_choix = document.getElementById("choix");
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

    function f() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange=function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("liste").innerHTML = this.responseText;
            filtre();
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