document
  .getElementById("persoButtons")
  .addEventListener("click", function () {
    document.getElementById("infPerso").classList.remove("hidden");
    document.getElementById("infGene").classList.add("hidden");
    document.getElementById("persoButtons").classList.add("hidden");
    document.getElementById("geneButtons").classList.remove("hidden");

  });

document
  .getElementById("geneButtons")
  .addEventListener("click", function () {
    document.getElementById("infGene").classList.remove("hidden");
    document.getElementById("infPerso").classList.add("hidden");
    document.getElementById("geneButtons").classList.add("hidden");
    document.getElementById("persoButtons").classList.remove("hidden");
  });
