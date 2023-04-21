<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="nouvellerecette.css" rel="stylesheet" type="text/css">

        <title>Nouvelle recette</title>
    </head>
    <body>
        <h1 class="titre"> Nouvelle recette</h1>
        <form action="recette.php" method="post" enctype="multipart/form-data" >
            <!-- <label>Auteur de la recette</label><br>
            <input type="text" id="auteur" name="auteur"><br><br> -->
            <label>Nom de la recette</label><br>
            <input type="text" id="nom" name="nom" required><br><br>
            <label>Type de recette</label><br>
            <select id="type" name="type" required>
                <option>--------------</option>
                <option>Entrée</option>
                <option>Plat</option>
                <option>Dessert</option>
            </select><br><br>
            <label>Nombre de personne</label><br>
            <input type="number" id="nb_personnes" min="1" name="nb_personnes" required><br><br>
            <label>Difficulté</label><br>
            <select id="difficulte" name="difficulte" required>
                <option>--------------</option>
                <option>Facile</option>
                <option>Moyenne</option>
                <option>Difficile</option>
            </select><br><br>
            <label>Ingrédients:</label><br>
            <div id="ingredients" name="ingredients[]" >
                
                
            </div><br>
            <input type="number" id="quantite" min="1" name="quantite" placeholder="quantité" >
            <select id="unite" name="unite">
                <option> </option>
                <option>L</option>
                <option>mL</option>
                <option>cL</option>
                <option>g</option>
                <option>kg</option>
                <option>pincée</option>
                <option>c-à-c</option>
                <option>c-à-s</option>
            </select>

            <input type="text" id="nouvel_ingredient" name="nouvel_ingredient" placeholder="ingrédient">

            <button id="ajouter_ingredient" type="button">Ajouter ingrédient</button><br><br>
            <!-- <button id="supprimer_dernier_ingredient">Supprimer dernier ingrédient</button><br><br> -->


            <label>Phases techniques</label><br>
		    
            <div id="etapes" name="etapes[]">
                
            </div><br>
            <input type="text" id="nouvelle_etape" name="nouvelle_etape">
            <button id="ajouter_etape" type="button">Ajouter étape</button><br><br>
            <!-- <button id="supprimer_derniere_etape">Supprimer dernière étape</button><br><br> -->


            <label>Dernier conseils du chef</label><br>
		    <textarea id="conseils" name="conseils" class="text"></textarea><br><br>
            <label> photo (jpeg/png/jpg)</label><br>
            <input type="file" id="photo" name="photo" accept="image/jpeg, image/png, image/jpg"><br><br>
            <button type="submit" onclick="return nonVide()">Enregistrer la recette</button><br><br>
            

            

        </form>

        <script src="nouvellerecette.js"></script>
    </body>
</html>

