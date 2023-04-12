let boutonAjouterIngredient = document.getElementById("ajouter_ingredient");
let champNouvelIngredient = document.getElementById("nouvel_ingredient");
let champQuantite = document.getElementById("quantite");
let champUnite = document.getElementById("unite");
let listeIngredients = document.getElementById("ingredients");


//ingredient sous forme de liste


// boutonAjouterIngredient.addEventListener("click", function() {
// 	var nouvelIngredient = champNouvelIngredient.value;
//   var quantite=champQuantite.value;
//   var unite=champUnite.value;
// 	if (nouvelIngredient) {
// 		var nouvelElementListe = document.createElement("li");
//     if (unite==""){
//       nouvelElementListe.innerText = quantite+unite+" "+ nouvelIngredient+"  ";
//     }
//     else{
//       nouvelElementListe.innerText = quantite+unite+" de "+ nouvelIngredient+"  ";
//     }
// 		//nouvelElementListe.innerText = quantite+unite+" de "+ nouvelIngredient;
// 		listeIngredients.appendChild(nouvelElementListe);
// 		champNouvelIngredient.value = "";
//     champUnite.value="";
//     champQuantite.value="";

// 	}
//   //creation du bouton pour supprimer l'élément de la liste
//   var boutonSuppression=document.createElement("button");
//   var bouton_text= document.createTextNode("-");
//   boutonSuppression.appendChild(bouton_text);
//   listeIngredients.lastChild.appendChild(boutonSuppression);
//   //fonction pour faire fonctionner boutonSuppression
//   boutonSuppression.addEventListener("click", function(event) {
//     //event.preventDefault();  // sert a eviter que la page s'acctualise a chaque suppression
//     listeIngredients.removeChild(nouvelElementListe);
//   });
// });


//ingredient sous forme d'input
boutonAjouterIngredient.addEventListener("click", function() {
	var ingredient = champNouvelIngredient.value;
  var quantite=champQuantite.value;
  var unite=champUnite.value;
  
	if (ingredient) {
    var nouvelIngredient=document.createElement("input");
    nouvelIngredient.name="nouvelIngredient[]";
    nouvelIngredient.value=ingredient;


		var nouvelleQuantite = document.createElement("input");
    nouvelleQuantite.type="number";
    //nouvelleQuantite.id="quantite";
    nouvelleQuantite.name="nouvelleQuantite[]";
    nouvelleQuantite.value=quantite;

    var nouvelleUnite= document.createElement("select");
    //nouvelleUnite.id="unite";
    nouvelleUnite.name="nouvelleUnite[]";
    nouvelleUnite.value = unite;
    //nouvelleUnite.setAttribute("data-unite", unite);

    var sansUnite=document.createElement("option");
    sansUnite.value=" ";
    sansUnite.text=" ";

    var L=document.createElement("option");
    L.value="L";
    L.text="L";

    var mL=document.createElement("option");
    mL.value="mL";
    mL.text="mL";

    var cL=document.createElement("option");
    cL.value="cL";
    cL.text="cL";

    var g=document.createElement("option");
    g.value="g";
    g.text="g";

    var kg=document.createElement("option");
    kg.value="kg";
    kg.text="kg";

    var pincee=document.createElement("option");
    pincee.value="pincée";
    pincee.text="pincée";

    var cac=document.createElement("option");
    cac.value="c-à-c";
    cac.text="c-à-c";

    var cas=document.createElement("option");
    cas.value="c-à-s";
    cas.text="c-à-s";

    nouvelleUnite.appendChild(sansUnite);
    nouvelleUnite.appendChild(mL);
    nouvelleUnite.appendChild(L);
    nouvelleUnite.appendChild(cL);
    nouvelleUnite.appendChild(g);
    nouvelleUnite.appendChild(kg);
    nouvelleUnite.appendChild(pincee);
    nouvelleUnite.appendChild(cac);
    nouvelleUnite.appendChild(cas);



		listeIngredients.appendChild(nouvelleQuantite);
    listeIngredients.appendChild(nouvelleUnite);
    listeIngredients.appendChild(nouvelIngredient);
    
    
		champNouvelIngredient.value = "";
    champUnite.value="";
    champQuantite.value="";

  var boutonSuppression=document.createElement("button");
  var bouton_text= document.createTextNode("-");
  boutonSuppression.appendChild(bouton_text);
  listeIngredients.appendChild(boutonSuppression);
  var retourLigne=document.createElement("br");
  listeIngredients.appendChild(retourLigne);

	}
  //creation du bouton pour supprimer l'élément de la liste
  
  //fonction pour faire fonctionner boutonSuppression
  boutonSuppression.addEventListener("click", function(event) {
    event.preventDefault();  // sert a eviter que la page s'acctualise a chaque suppression
    listeIngredients.removeChild(nouvelIngredient);
    listeIngredients.removeChild(nouvelleUnite);
    listeIngredients.removeChild(nouvelleQuantite);
    listeIngredients.removeChild(boutonSuppression);
    listeIngredients.removeChild(retourLigne);
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
	var etape = champNouvelleEtape.value;
	if (etape) {
		var nouvelleEtape = document.createElement("input");
    nouvelleEtape.name="nouvelleEtape[]";
    nouvelleEtape.value=etape;

		var retourLigne=document.createElement("br");
		listeEtapes.appendChild(nouvelleEtape);
    var boutonSuppression=document.createElement("button");
    var bouton_text= document.createTextNode("-");
    boutonSuppression.appendChild(bouton_text);
    listeEtapes.appendChild(boutonSuppression);
    listeEtapes.appendChild(retourLigne);
		champNouvelleEtape.value = "";
	}

  
  //fonction pour faire fonctionner boutonSuppression
  boutonSuppression.addEventListener("click", function(event) {
    event.preventDefault();  // sert a eviter que la page s'acctualise a chaque suppression
    listeEtapes.removeChild(nouvelleEtape);
    listeEtapes.removeChild(boutonSuppression);
    listeEtapes.removeChild(retourLigne);
  });
});

// let boutonSupprimerEtape = document.getElementById("supprimer_derniere_etape");
// boutonSupprimerEtape.addEventListener("click", function(event) {
//     event.preventDefault();
//     // sert a eviter que la page s'acctualise a chaque suppression
//     var DerniereEtape = listeEtapes.lastElementChild;
//     if (DerniereEtape) {
//       listeEtapes.removeChild(DerniereEtape);
//     }
//   });

// boutonAjouterEtape.addEventListener("click", function() {
// 	var nouvelleEtape = champNouvelleEtape.value;
// 	if (nouvelleEtape) {
// 		var nouvelElementListe = document.createElement("li");
// 		nouvelElementListe.innerText = nouvelleEtape;
// 		listeEtapes.appendChild(nouvelElementListe);
// 		champNouvelleEtape.value = "";
// 	}

//   var boutonSuppression=document.createElement("button");
//   var bouton_text= document.createTextNode("-");
//   boutonSuppression.appendChild(bouton_text);
//   listeEtapes.lastChild.appendChild(boutonSuppression);
//   //fonction pour faire fonctionner boutonSuppression
//   boutonSuppression.addEventListener("click", function(event) {
//     //event.preventDefault();  // sert a eviter que la page s'acctualise a chaque suppression
//     listeEtapes.removeChild(nouvelElementListe);
//   });
// });

// let boutonSupprimerEtape = document.getElementById("supprimer_derniere_etape");
// boutonSupprimerEtape.addEventListener("click", function(event) {
//     event.preventDefault();
//     // sert a eviter que la page s'acctualise a chaque suppression
//     var DerniereEtape = listeEtapes.lastElementChild;
//     if (DerniereEtape) {
//       listeEtapes.removeChild(DerniereEtape);
//     }
//   });