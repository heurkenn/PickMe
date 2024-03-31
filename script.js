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

function filterCountries() {
  const countries = [
    "Afghanistan",
    "Afrique du Sud",
    "Albanie",
    "Algérie",
    "Allemagne",
    "Andorre",
    "Angola",
    "Anguilla",
    "Antarctique",
    "Antigua-et-Barbuda",
    "Arabie saoudite",
    "Argentine",
    "Arménie",
    "Aruba",
    "Australie",
    "Autriche",
    "Azerbaïdjan",
    "Bahamas",
    "Bahreïn",
    "Bangladesh",
    "Barbade",
    "Bélarus",
    "Belgique",
    "Belize",
    "Bénin",
    "Bermudes",
    "Bhoutan",
    "Bolivie",
    "Bosnie-Herzégovine",
    "Botswana",
    "Brésil",
    "Brunei Darussalam",
    "Bulgarie",
    "Burkina Faso",
    "Burundi",
    "Cambodge",
    "Cameroun",
    "Canada",
    "Cap-Vert",
    "Chili",
    "Chine",
    "Chypre",
    "Colombie",
    "Comores",
    "Congo",
    "Corée du Nord",
    "Corée du Sud",
    "Costa Rica",
    "Côte d'Ivoire",
    "Croatie",
    "Cuba",
    "Danemark",
    "Djibouti",
    "Dominique",
    "Égypte",
    "Émirats arabes unis",
    "Équateur",
    "Érythrée",
    "Espagne",
    "Estonie",
    "État de la Cité du Vatican",
    "États fédérés de Micronésie",
    "États-Unis",
    "Éthiopie",
    "Fidji",
    "Finlande",
    "France",
    "Gabon",
    "Gambie",
    "Géorgie",
    "Ghana",
    "Gibraltar",
    "Grèce",
    "Grenade",
    "Groenland",
    "Guadeloupe",
    "Guam",
    "Guatemala",
    "Guernesey",
    "Guinée",
    "Guinée équatoriale",
    "Guinée-Bissau",
    "Guyana",
    "Guyane française",
    "Haïti",
    "Honduras",
    "Hongrie",
    "Île Bouvet",
    "Île Christmas",
    "Île de Man",
    "Île Norfolk",
    "Îles Caïmans",
    "Îles Cocos",
    "Îles Cook",
    "Îles Féroé",
    "Îles Malouines",
    "Îles Mariannes du Nord",
    "Îles Marshall",
    "Îles mineures éloignées des États-Unis",
    "Îles Pitcairn",
    "Îles Salomon",
    "Îles Turks et Caïques",
    "Îles Vierges britanniques",
    "Îles Vierges des États-Unis",
    "Inde",
    "Indonésie",
    "Irak",
    "Iran",
    "Irlande",
    "Islande",
    "Israël",
    "Italie",
    "Jamaïque",
    "Japon",
    "Jersey",
    "Jordanie",
    "Kazakhstan",
    "Kenya",
    "Kirghizistan",
    "Kiribati",
    "Koweït",
    "Laos",
    "Lesotho",
    "Lettonie",
    "Liban",
    "Libéria",
    "Libye",
    "Liechtenstein",
    "Lituanie",
    "Luxembourg",
    "Macédoine du Nord",
    "Madagascar",
    "Malaisie",
    "Malawi",
    "Maldives",
    "Mali",
    "Malte",
    "Maroc",
    "Martinique",
    "Maurice",
    "Mauritanie",
    "Mayotte",
    "Mexique",
    "Moldavie",
    "Monaco",
    "Mongolie",
    "Monténégro",
    "Montserrat",
    "Mozambique",
    "Myanmar",
    "Namibie",
    "Nauru",
    "Népal",
    "Nicaragua",
    "Niger",
    "Nigeria",
    "Niue",
    "Norvège",
    "Nouvelle-Calédonie",
    "Nouvelle-Zélande",
    "Oman",
    "Ouganda",
    "Ouzbékistan",
    "Pakistan",
    "Palaos",
    "Palestine",
    "Panama",
    "Papouasie-Nouvelle-Guinée",
    "Paraguay",
    "Pays-Bas",
    "Pérou",
    "Philippines",
    "Pitcairn",
    "Pologne",
    "Polynésie française",
    "Porto Rico",
    "Portugal",
    "Qatar",
    "R.A.S. chinoise de Hong Kong",
    "R.A.S. chinoise de Macao",
    "Roumanie",
    "Royaume-Uni",
    "Russie",
    "Rwanda",
    "Sahara occidental",
    "Saint-Barthélemy",
    "Saint-Kitts-et-Nevis",
    "Saint-Marin",
    "Saint-Martin (partie française)",
    "Saint-Martin (partie néerlandaise)",
    "Saint-Pierre-et-Miquelon",
    "Saint-Vincent-et-les Grenadines",
    "Sainte-Hélène",
    "Sainte-Lucie",
    "Salvador",
    "Samoa",
    "Samoa américaines",
    "Sao Tomé-et-Principe",
    "Sénégal",
    "Serbie",
    "Seychelles",
    "Sierra Leone",
    "Singapour",
    "Slovaquie",
    "Slovénie",
    "Somalie",
    "Soudan",
    "Soudan du Sud",
    "Sri Lanka",
    "Suède",
    "Suisse",
    "Suriname",
    "Svalbard et Jan Mayen",
    "Syrie",
    "Tadjikistan",
    "Tanzanie",
    "Taïwan",
    "Tchad",
    "Tchéquie",
    "Terres australes françaises",
    "Territoire britannique de l'océan Indien",
    "Territoires palestiniens",
    "Thaïlande",
    "Timor oriental",
    "Togo",
    "Tokelau",
    "Tonga",
    "Trinité-et-Tobago",
    "Tunisie",
    "Turkménistan",
    "Turquie",
    "Tuvalu",
    "Ukraine",
    "Uruguay",
    "Vanuatu",
    "Vatican",
    "Venezuela",
    "Viêt Nam",
    "Wallis-et-Futuna",
    "Yémen",
    "Zambie",
    "Zimbabwe"

    // Ajoutez d'autres pays selon vos besoins
  ];
  const searchInput = document.getElementById("paysSearch").value.toLowerCase();
  const select = document.getElementById("pays");
  select.innerHTML = ""; // Efface toutes les options actuelles
  let count = 0; // Compteur pour limiter à 10 options
  countries.forEach((country) => {
    if (country.toLowerCase().includes(searchInput) && count < 10) {
      const option = document.createElement("option");
      option.value = country;
      option.textContent = country;
      select.appendChild(option);
      count++;
    }
  });
}

window.onload = filterCountries;

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

function toggleSelection(button, question) {
  var maxSelection = 3;
  var hiddenInput = document.getElementById(question);
  // Récupérer les boutons sélectionnés
  var selectedButtons = document.querySelectorAll(
    "." + question + '-btn[data-selected="true"]'
  );
  var selectedGenres = [];
  selectedButtons.forEach(function (btn) {
    selectedGenres.push(btn.innerText);
  });

  // Vérifier si le bouton est déjà sélectionné
  if (button.getAttribute("data-selected") === "true") {
    button.setAttribute("data-selected", "false");
    button.classList.remove("selected");
  } else if (selectedGenres.length < maxSelection) {
    // Vérifier si le nombre maximum de sélections n'est pas atteint
    button.setAttribute("data-selected", "true");
    button.classList.add("selected");
    selectedGenres.push(button.innerText); // Ajouter les informations du bouton sélectionné au tableau
  }

  // Mettre à jour la valeur du champ caché avec les genres sélectionnés
  hiddenInput.value = selectedGenres.join(",");
}

function validateForm() {
    // Récupérer tous les boutons des genres de jeux
    var genreButtons = document.getElementsByClassName('genres-btn');
    var langueButtons = document.getElementsByClassName('langue-btn');
    var selectedGenre = false;
    var selectedLangue = false;
    
    // Vérifier si au moins un bouton est sélectionné
    for (var i = 0; i < genreButtons.length; i++) {
        if (genreButtons[i].getAttribute('data-selected') === 'true') {
            selectedGenre = true;
            break;
        }
    }
    
    // Si aucun genre n'est sélectionné, afficher un message d'erreur et empêcher le formulaire de se soumettre
    if (!selectedGenre) {
        alert('Veuillez sélectionner au moins un genre de jeu.');
        return false;
    }

    for (var i = 0; i < langueButtons.length; i++) {
        if (langueButtons[i].getAttribute('data-selected') === 'true') {
            selectedLangue = true;
            break;
        }
    }
    
    // Si aucun genre n'est sélectionné, afficher un message d'erreur et empêcher le formulaire de se soumettre
    if (!selectedLangue) {
        alert('Veuillez sélectionner au moins une langue.');
        return false;
    }
    
    // Si au moins un genre est sélectionné, autoriser le formulaire à se soumettre
    return true;
}