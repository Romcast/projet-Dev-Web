function ajouterNouvelIngredient() {
  var ingredientCount = 1;
  var addButton = document.getElementById("ajouter_ingredient");

  // Add event listener only if it hasn't been added before
  if (!addButton.hasAttribute("data-clicked")) {
    addButton.setAttribute("data-clicked", "true");
    addButton.addEventListener("click", ajouterIngredient());
  }

  function ajouterIngredient() {
    var div = document.createElement("div");
    div.innerHTML ='<input type="number" id="nouvelle_quantite' + ingredientCount + '" name="nouvelle_quantite[]"><select id="nouvelle_unite' + ingredientCount + '" name="nouvelle_unite[]"><option> </option><option>L</option><option>mL</option><option>cL</option><option>g</option><option>kg</option><option>pincée</option><option>c-à-c</option><option>c-à-s</option></select><input type="text" id="nouveau_nom' + ingredientCount + '" name="nouveau_nom[]"><button id="annuler_ingredient" type="button" onclick="supprimerNouvelIngredient(this.parentNode)">-</button><br><br><br><br>';
    document.getElementById("ingredients").appendChild(div);
    ingredientCount++;
  }
}

function supprimerNouvelIngredient(nouvingredient) {
nouvingredient.parentNode.removeChild(nouvingredient);
}



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




function ajouterNouvelleEtape() {
  var etapeCount = 1;
  document.getElementById("ajouter_etape").addEventListener("click", function() {
    var div = document.createElement("div");
    div.innerHTML = '<input type="text" id="nouvelle_etape_' + etapeCount + '" name="nouvelle_etape[]"><button id="annuler_etape" type="button" onclick="supprimerNouvelleEtape(this.parentNode)">-</button><br><br><br><br>';
    document.getElementById("etapes").appendChild(div);
    etapeCount++;
  });
}


function supprimerNouvelleEtape(nouvetape) {
nouvetape.parentNode.removeChild(nouvetape);
}



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

