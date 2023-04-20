const suggestionList = document.querySelector('.suggestion-list');
const suggestionIcon = document.querySelector('.suggestion-icon');
const suggestionBadge = suggestionIcon.querySelector('.badge');

// Afficher la liste de suggestions
function showSuggestions(suggestions) {
  suggestionList.innerHTML = '';
  suggestions.forEach(function(suggestion) {
    const suggestionItem = document.createElement('li');
    const suggestionLink = document.createElement('a');
    const suggestionImage = document.createElement('img');
    const suggestionText = document.createElement('span');
    
    suggestionImage.src = suggestion.image;
    suggestionText.innerText = suggestion.title;
    suggestionLink.href = suggestion.link;
    
    suggestionLink.appendChild(suggestionImage);
    suggestionLink.appendChild(suggestionText);
    suggestionItem.appendChild(suggestionLink);
    suggestionList.appendChild(suggestionItem);
  });
}

// Réinitialiser la liste de suggestions toutes les semaines
function resetSuggestion() {
  // Récupérer les suggestions depuis la base de données en utilisant AJAX
  const xhr = new XMLHttpRequest();
  xhr.open('GET', 'get_suggestion.php', true);
  xhr.onload = function() {
    if(this.status === 200) {
      const suggestions = JSON.parse(this.responseText);
      showSuggestions(suggestions);
    }
  }
  xhr.send();
}

// Rafraîchir la liste de suggestions toutes les semaines
setInterval(resetSuggestion, 604800000);

// Cacher la liste de suggestions
suggestionList.style.display = 'none';

// Afficher la liste de suggestions au survol de l'icône
suggestionIcon.addEventListener('mouseenter', function() {
  suggestionList.style.display = 'block';
  suggestionBadge.style.display = 'none';
});

// Cacher la liste de suggestions lorsque le curseur quitte l'icône
suggestionIcon.addEventListener('mouseleave', function() {
  suggestionList.style.display = 'none';
});

// Augmenter le compteur de notifications
function increaseNotificationCount() {
  const currentCount = parseInt(suggestionBadge.innerText);
  suggestionBadge.innerText = currentCount + 1;
  suggestionBadge.style.display = 'inline-block';
}

// Simuler une nouvelle suggestion toutes les 10 secondes pour tester
setInterval(increaseNotificationCount, 10000);
