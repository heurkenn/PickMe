document
  .getElementById("inscriptionButton")
  .addEventListener("click", function () {
    document.getElementById("inscriptionForm").classList.remove("hidden");
    document.getElementById("connexionForm").classList.add("hidden");
    document.getElementById("inscriptionButton").classList.add("hidden");
    document.getElementById("connexionButton").classList.remove("hidden");
    document.getElementById("imgs1").classList.add("hidden");
    document.getElementById("imgs2").classList.add("hidden");
  });

document
  .getElementById("connexionButton")
  .addEventListener("click", function () {
    document.getElementById("connexionForm").classList.remove("hidden");
    document.getElementById("inscriptionForm").classList.add("hidden");
    document.getElementById("connexionButton").classList.add("hidden");
    document.getElementById("inscriptionButton").classList.remove("hidden");
    document.getElementById("imgs1").classList.add("hidden");
    document.getElementById("imgs2").classList.add("hidden");
  });

function etapeSuivante() {
  var formulaire = document
    .getElementById("monFormulaire")
    .getElementsByTagName("div");
  for (var i = 0; i < formulaire.length; i++) {
    if (formulaire[i].style.display !== "none") {
      formulaire[i].style.display = "none";
      formulaire[i + 1].style.display = "block";
      break;
    }
  }
}

function etapePrecedente() {
  var formulaire = document
    .getElementById("monFormulaire")
    .getElementsByTagName("div");
  for (var i = 0; i < formulaire.length; i++) {
    if (formulaire[i].style.display !== "none") {
      formulaire[i].style.display = "none";
      formulaire[i - 1].style.display = "block";
      break;
    }
  }
}

function toggleSelection(button) {
    var maxSelection = 3;
    var hiddenInput = document.getElementById('genres');

    // Récupérer les boutons sélectionnés
    var selectedButtons = document.querySelectorAll('.genre-btn[data-selected="true"]');
    var selectedGenres = [];
    selectedButtons.forEach(function(btn) {
        selectedGenres.push(btn.innerText);
    });

    // Vérifier si le bouton est déjà sélectionné
    if (button.getAttribute('data-selected') === 'true') {
        button.setAttribute('data-selected', 'false');
        button.classList.remove('selected');
    } else if (selectedGenres.length < maxSelection) { // Vérifier si le nombre maximum de sélections n'est pas atteint
        button.setAttribute('data-selected', 'true');
        button.classList.add('selected');
        selectedGenres.push(button.innerText); // Ajouter les informations du bouton sélectionné au tableau
    }

    // Mettre à jour la valeur du champ caché avec les genres sélectionnés
    hiddenInput.value = selectedGenres.join(",");
}


