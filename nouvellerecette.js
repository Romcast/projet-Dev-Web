let boutonAjouterIngredient = document.getElementById("ajouter_ingredient");
let champNouvelIngredient = document.getElementById("nouvel_ingredient");
let champQuantite = document.getElementById("quantite");
let champUnite = document.getElementById("unite");
let listeIngredients = document.getElementById("ingredients");


//ingredient sous forme d'input
boutonAjouterIngredient.addEventListener("click", function() {
	var ingredient = champNouvelIngredient.value;
  var quantite=champQuantite.value;
  var unite=champUnite.value;

	if (ingredient && quantite) {
    var nouvelIngredient=document.createElement("input");
    nouvelIngredient.name="nouvelIngredient[]";
    nouvelIngredient.value=ingredient;

		var nouvelleQuantite = document.createElement("input");
    nouvelleQuantite.type="number";
    nouvelleQuantite.name="nouvelleQuantite[]";
    nouvelleQuantite.value=quantite;
    nouvelleQuantite.min=1;

    var nouvelleUnite= document.createElement("select");
    nouvelleUnite.name="nouvelleUnite[]";
    nouvelleUnite.value = "unite";
    
    var uniteChoisie=document.createElement("option");
    uniteChoisie.value=unite;
    uniteChoisie.text=unite;

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

    nouvelleUnite.appendChild(uniteChoisie);
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

    //creation du bouton pour supprimer l'élément de la liste
    var boutonSuppression=document.createElement("button");
    var bouton_text= document.createTextNode("-");
    boutonSuppression.appendChild(bouton_text);
    listeIngredients.appendChild(boutonSuppression);
    var retourLigne=document.createElement("br");
    listeIngredients.appendChild(retourLigne);

	}
  
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

  
  //fonction pour faire fonctionner boutonSuppression de l'etape
  boutonSuppression.addEventListener("click", function(event) {
    event.preventDefault();  // sert a eviter que la page s'acctualise a chaque suppression
    listeEtapes.removeChild(nouvelleEtape);
    listeEtapes.removeChild(boutonSuppression);
    listeEtapes.removeChild(retourLigne);
  });
});


function nonVide(){
  var caseIngredient=document.getElementById("ingredients").innerHTML;
  var caseEtape=document.getElementById("etapes").innerHTML;
  if (caseIngredient.trim() &&  caseEtape.trim() ){
  
  }
  else{
    alert("Au moins une étape et un ingrédients sont requis");
    return false;
   
  }
}
