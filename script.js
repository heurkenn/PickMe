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

function redirigeIC(){
    window.location.href = "InsCon.html";
}
