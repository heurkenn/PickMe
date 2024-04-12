document.getElementById("persoButtons").addEventListener("click", function () {
  document.getElementById("infPerso").classList.remove("hidden");
  document.getElementById("infPerso").classList.remove("info");
  document.getElementById("infGene").classList.add("hidden");
  document.getElementById("infPerso").classList.add("info");
  document.getElementById("persoButtons").classList.add("hidden");
  document.getElementById("geneButtons").classList.remove("hidden");
});

document.getElementById("geneButtons").addEventListener("click", function () {
  document.getElementById("infGene").classList.remove("hidden");
  document.getElementById("infPerso").classList.remove("info");
  document.getElementById("infPerso").classList.add("hidden");
  document.getElementById("infGene").classList.add("info");
  document.getElementById("geneButtons").classList.add("hidden");
  document.getElementById("persoButtons").classList.remove("hidden");
});

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
    var hiddenInput = document.getElementById("profilPicture");
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

document.getElementById("paysButtons").addEventListener("click", function () {
  document.getElementById("paysDiv").classList.remove("hidden");
  document.getElementById("langueDiv").classList.add("hidden");
  document.getElementById("genreJeuxDiv").classList.add("hidden");
  document.getElementById("styleJeuxDiv").classList.add("hidden");
  document.getElementById("rechercheDiv").classList.add("hidden");
  document.getElementById("biographieDiv").classList.add("hidden");
  document.getElementById("profilPictureDiv").classList.add("hidden");
  document.getElementById("enr").classList.remove("hidden");
});
document.getElementById("langueButtons").addEventListener("click", function () {
  document.getElementById("paysDiv").classList.add("hidden");
  document.getElementById("langueDiv").classList.remove("hidden");
  document.getElementById("genreJeuxDiv").classList.add("hidden");
  document.getElementById("styleJeuxDiv").classList.add("hidden");
  document.getElementById("rechercheDiv").classList.add("hidden");
  document.getElementById("biographieDiv").classList.add("hidden");
  document.getElementById("profilPictureDiv").classList.add("hidden");
  document.getElementById("enr").classList.remove("hidden");
});
document.getElementById("genreButtons").addEventListener("click", function () {
  document.getElementById("paysDiv").classList.add("hidden");
  document.getElementById("langueDiv").classList.add("hidden");
  document.getElementById("genreJeuxDiv").classList.remove("hidden");
  document.getElementById("styleJeuxDiv").classList.add("hidden");
  document.getElementById("rechercheDiv").classList.add("hidden");
  document.getElementById("biographieDiv").classList.add("hidden");
  document.getElementById("profilPictureDiv").classList.add("hidden");
  document.getElementById("enr").classList.remove("hidden");
});
document.getElementById("styleButtons").addEventListener("click", function () {
  document.getElementById("paysDiv").classList.add("hidden");
  document.getElementById("langueDiv").classList.add("hidden");
  document.getElementById("genreJeuxDiv").classList.add("hidden");
  document.getElementById("styleJeuxDiv").classList.remove("hidden");
  document.getElementById("rechercheDiv").classList.add("hidden");
  document.getElementById("biographieDiv").classList.add("hidden");
  document.getElementById("profilPictureDiv").classList.add("hidden");
  document.getElementById("enr").classList.remove("hidden");
});
document
  .getElementById("rechercheButtons")
  .addEventListener("click", function () {
    document.getElementById("paysDiv").classList.add("hidden");
    document.getElementById("langueDiv").classList.add("hidden");
    document.getElementById("genreJeuxDiv").classList.add("hidden");
    document.getElementById("styleJeuxDiv").classList.add("hidden");
    document.getElementById("rechercheDiv").classList.remove("hidden");
    document.getElementById("biographieDiv").classList.add("hidden");
    document.getElementById("profilPictureDiv").classList.add("hidden");
    document.getElementById("enr").classList.remove("hidden");
  });
document
  .getElementById("biographieButtons")
  .addEventListener("click", function () {
    document.getElementById("paysDiv").classList.add("hidden");
    document.getElementById("langueDiv").classList.add("hidden");
    document.getElementById("genreJeuxDiv").classList.add("hidden");
    document.getElementById("styleJeuxDiv").classList.add("hidden");
    document.getElementById("rechercheDiv").classList.add("hidden");
    document.getElementById("biographieDiv").classList.remove("hidden");
    document.getElementById("profilPictureDiv").classList.add("hidden");
    document.getElementById("enr").classList.remove("hidden");
  });
document
  .getElementById("pictureButtons")
  .addEventListener("click", function () {
    document.getElementById("paysDiv").classList.add("hidden");
    document.getElementById("langueDiv").classList.add("hidden");
    document.getElementById("genreJeuxDiv").classList.add("hidden");
    document.getElementById("styleJeuxDiv").classList.add("hidden");
    document.getElementById("rechercheDiv").classList.add("hidden");
    document.getElementById("biographieDiv").classList.add("hidden");
    document.getElementById("profilPictureDiv").classList.remove("hidden");
    document.getElementById("enr").classList.remove("hidden");
  });

  document.getElementById("mdpButton").addEventListener("click", function() {
    document.getElementById("changePasswordDiv").classList.remove("hidden");
});