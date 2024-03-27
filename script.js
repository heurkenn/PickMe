document.getElementById("inscriptionButton").addEventListener("click", function() {
    document.getElementById("inscriptionForm").classList.remove("hidden");
    document.getElementById("connexionForm").classList.add("hidden");
    document.getElementById("inscriptionButton").classList.add("hidden");
    document.getElementById("connexionButton").classList.remove("hidden");
    document.getElementById("imgs1").classList.add("hidden");
    document.getElementById("imgs2").classList.add("hidden");
});

document.getElementById("connexionButton").addEventListener("click", function() {
    document.getElementById("connexionForm").classList.remove("hidden");
    document.getElementById("inscriptionForm").classList.add("hidden");
    document.getElementById("connexionButton").classList.add("hidden");
    document.getElementById("inscriptionButton").classList.remove("hidden");
    document.getElementById("imgs1").classList.add("hidden");
    document.getElementById("imgs2").classList.add("hidden");
});
