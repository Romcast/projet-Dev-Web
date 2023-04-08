let boutonAjouterIngredient = document.getElementById("ajouter_ingredient");
let champNouvelIngredient = document.getElementById("nouvel_ingredient");
let champQuantite = document.getElementById("quantite");
let champUnite = document.getElementById("unite");
let listeIngredients = document.getElementById("ingredients");

boutonAjouterIngredient.addEventListener("click", function() {
	var nouvelIngredient = champNouvelIngredient.value;
  var quantite=champQuantite.value;
  var unite=champUnite.value;
	if (nouvelIngredient) {
		var nouvelElementListe = document.createElement("li");
    if (unite==""){
      nouvelElementListe.innerText = quantite+unite+" "+ nouvelIngredient+"  ";
    }
    else{
      nouvelElementListe.innerText = quantite+unite+" de "+ nouvelIngredient+"  ";
    }
		//nouvelElementListe.innerText = quantite+unite+" de "+ nouvelIngredient;
		listeIngredients.appendChild(nouvelElementListe);
		champNouvelIngredient.value = "";
    champUnite.value="";
    champQuantite.value="";

	}
  //creation du bouton pour supprimer l'élément de la liste
  var boutonSuppression=document.createElement("button");
  var bouton_text= document.createTextNode("-");
  boutonSuppression.appendChild(bouton_text);
  listeIngredients.lastChild.appendChild(boutonSuppression);
  //fonction pour faire fonctionner boutonSuppression
  boutonSuppression.addEventListener("click", function(event) {
    //event.preventDefault();  // sert a eviter que la page s'acctualise a chaque suppression
    listeIngredients.removeChild(nouvelElementListe);
  });
});



// let boutonSupprimerIngredient = document.getElementById("supprimer_dernier_ingredient");
// boutonSupprimerIngredient.addEventListener("click", function(event) {
//     event.preventDefault();
//     // sert a eviter que la page s'acctualise a chaque suppression
//     var DernierIngredient = listeIngredients.lastElementChild;
//     if (DernierIngredient) {
//       listeIngredients.removeChild(DernierIngredient);
//     }
//   });

  

let boutonAjouterEtape = document.getElementById("ajouter_etape");
let champNouvelleEtape = document.getElementById("nouvelle_etape");
let listeEtapes = document.getElementById("etapes");

boutonAjouterEtape.addEventListener("click", function() {
	var nouvelleEtape = champNouvelleEtape.value;
	if (nouvelleEtape) {
		var nouvelElementListe = document.createElement("li");
		nouvelElementListe.innerText = nouvelleEtape;
		listeEtapes.appendChild(nouvelElementListe);
		champNouvelleEtape.value = "";
	}

  var boutonSuppression=document.createElement("button");
  var bouton_text= document.createTextNode("-");
  boutonSuppression.appendChild(bouton_text);
  listeEtapes.lastChild.appendChild(boutonSuppression);
  //fonction pour faire fonctionner boutonSuppression
  boutonSuppression.addEventListener("click", function(event) {
    //event.preventDefault();  // sert a eviter que la page s'acctualise a chaque suppression
    listeEtapes.removeChild(nouvelElementListe);
  });
});

let boutonSupprimerEtape = document.getElementById("supprimer_derniere_etape");
boutonSupprimerEtape.addEventListener("click", function(event) {
    event.preventDefault();
    // sert a eviter que la page s'acctualise a chaque suppression
    var DerniereEtape = listeEtapes.lastElementChild;
    if (DerniereEtape) {
      listeEtapes.removeChild(DerniereEtape);
    }
  });