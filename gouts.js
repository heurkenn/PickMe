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

async function filterCountries() {
  const searchInput = document.getElementById("paysSearch").value.toLowerCase();
  const select = document.getElementById("pays");
  select.innerHTML = "";

  try {
    const response = await fetch("pays.txt");
    const data = await response.text();
    const countries = data.split("\n");

    let count = 0;
    countries.forEach((country) => {
      if (country.toLowerCase().includes(searchInput) && count < 10) {
        const option = document.createElement("option");
        option.value = country;
        option.textContent = country;
        select.appendChild(option);
        count++;
      }
    });
  } catch (error) {
    console.error(
      "Une erreur est survenue lors du chargement du fichier :",
      error
    );
  }
}

window.onload = filterCountries;

function toggleSelection(button, question) {
  if (question === "profil") {
    var maxSelection = 1;
    var hiddenInput = document.getElementById("profilPicture"); // Correction ici
    var selectedButtons = document.querySelectorAll(
      "." + question + '-btn[data-selected="true"]'
    );
    var selectedPic = [];
    selectedButtons.forEach(function (btn) {
      selectedPic.push(btn.innerText);
    });
    if (button.getAttribute("data-selected") === "true") {
      button.setAttribute("data-selected", "false");
      button.classList.remove("selected");
    } else if (selectedPic.length <= maxSelection) {
      selectedButtons.forEach(function (btn) {
        btn.setAttribute("data-selected", "false");
        btn.classList.remove("selected");
      });
      button.setAttribute("data-selected", "true");
      button.classList.add("selected");
    }
    var imageUrl = button.querySelector("img").getAttribute("src");
    hiddenInput.value = imageUrl;
  } else {
    var maxSelection = 3;
    var hiddenInput = document.getElementById(question);
    var selectedButtons = document.querySelectorAll(
      "." + question + '-btn[data-selected="true"]'
    );
    var selectedGenres = [];
    selectedButtons.forEach(function (btn) {
      selectedGenres.push(btn.innerText);
    });

    if (button.getAttribute("data-selected") === "true") {
      button.setAttribute("data-selected", "false");
      button.classList.remove("selected");
    } else if (selectedGenres.length < maxSelection) {
      button.setAttribute("data-selected", "true");
      button.classList.add("selected");
      selectedGenres.push(button.innerText);
    }

    hiddenInput.value = selectedGenres.join(",");
  }
}

function validateForm() {
  var genreButtons = document.getElementsByClassName("genres-btn");
  var langueButtons = document.getElementsByClassName("langue-btn");
  var selectedGenre = false;
  var selectedLangue = false;

  for (var i = 0; i < genreButtons.length; i++) {
    if (genreButtons[i].getAttribute("data-selected") === "true") {
      selectedGenre = true;
      break;
    }
  }

  if (!selectedGenre) {
    alert("Veuillez sélectionner au moins un genre de jeu.");
    return false;
  }

  for (var i = 0; i < langueButtons.length; i++) {
    if (langueButtons[i].getAttribute("data-selected") === "true") {
      selectedLangue = true;
      break;
    }
  }

  if (!selectedLangue) {
    alert("Veuillez sélectionner au moins une langue.");
    return false;
  }

  return true;
}
