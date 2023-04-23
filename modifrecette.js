//cette fonction sert a ajouter la ligne d'input pour ajouter de nouveau ingredient a une recette deja existante
function ajouterNouvelIngredient() {
  var ingredientCount = 1;
  var addButton = document.getElementById("ajouter_ingredient");

  if (!addButton.hasAttribute("data-clicked")) {
    addButton.setAttribute("data-clicked", "true");
    addButton.addEventListener("click", ajouterIngredient);
  }

  function ajouterIngredient() {
    var div = document.createElement("div");
    div.innerHTML ='<input type="number" id="nouvelle_quantite' + ingredientCount + '" name="nouvelle_quantite[]"><select id="nouvelle_unite' + ingredientCount + '" name="nouvelle_unite[]"><option> </option><option>L</option><option>mL</option><option>cL</option><option>g</option><option>kg</option><option>pincée</option><option>c-à-c</option><option>c-à-s</option></select><input type="text" id="nouveau_nom' + ingredientCount + '" name="nouveau_nom[]"><button id="annuler_ingredient" type="button" onclick="supprimerNouvelIngredient(this.parentNode)">-</button><br><br><br><br>';
    document.getElementById("ingredients").appendChild(div);
    ingredientCount++;
  }
}
//Cette fonction sert a supprimer de nouveau ingredient affiché sur la page
function supprimerNouvelIngredient(nouvingredient) {
nouvingredient.parentNode.removeChild(nouvingredient);
}


//cette fonction permet de supprimer des ingredients de la base de donnee en restant sur la meme page
function supprimerIngredient(id) {
  // Supprimer l'étape de la page
  var quantite = document.getElementById("modif_quantite" + id);
  var unite=document.getElementById("modif_unite" + id);
  var nom = document.getElementById("modif_nom" + id);

  quantite.parentNode.removeChild(quantite);
  while (unite.firstChild) {
    unite.removeChild(unite.firstChild);
}
unite.parentNode.removeChild(unite);
  nom.parentNode.removeChild(nom);
  
  
  // Supprimer l'ingredient de la base de données
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
  httpRequest.open('DELETE', 'deleteingredient.php?delete=' + id);
  httpRequest.send();
}



//Cette fonction sert a ajouter des input pour de nouvelle etapes sur la page
function ajouterNouvelleEtape() {
  var etapeCount = 1;
  var addButton2 = document.getElementById("ajouter_etape");
  if (!addButton2.hasAttribute("data-clicked")) {
    addButton2.setAttribute("data-clicked", "true");
    addButton2.addEventListener("click", ajouterEtape);
  }
  

  function ajouterEtape(){
    var div = document.createElement("div");
    div.innerHTML = '<input type="text" id="nouvelle_etape_' + etapeCount + '" name="nouvelle_etape[]"><button id="annuler_etape" type="button" onclick="supprimerNouvelleEtape(this.parentNode)">-</button><br><br><br><br>';
    document.getElementById("etapes").appendChild(div);
    etapeCount++;
  };
}

//cette fonction sert a supprimer les nouveau input present sur la page
function supprimerNouvelleEtape(nouvetape) {
nouvetape.parentNode.removeChild(nouvetape);
}


//cette fonction permet de suppriler les anciennes etapes present dans la bdd en restant sur la meme page
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

