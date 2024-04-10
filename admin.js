function showModifier(profileId) {
  document
    .getElementById("modif-container-" + profileId)
    .classList.remove("hidden");
  document
    .getElementById("modif-container-" + profileId)
    .classList.add("info2");
}

function pseudoMofifier(profileId) {
 
      document.getElementById("pseudoDiv-" + profileId).classList.remove("hidden");
      document.getElementById("biographieDiv-" + profileId).classList.add("hidden");
      
    
}
