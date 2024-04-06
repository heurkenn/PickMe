function showAdditionalInfo(userId) {
  var modalBackground = document.getElementById("modal-background");
  var modalInfo = document.getElementById("modal-info");

  // Récupération des informations cachées et leur affichage dans la bulle modale
  var additionalInfo = document.getElementById(
    "additional-info-" + userId
  ).innerHTML;
  modalInfo.innerHTML = additionalInfo;

  modalBackground.style.display = "block"; // Affichage de la bulle modale
}

function hideAdditionalInfo() {
  var modalBackground = document.getElementById("modal-background");
  modalBackground.style.display = "none"; // Masquage de la bulle modale
  var modalInfo = document.getElementById("modal-info");
  modalInfo.innerHTML = ""; // Nettoyage de la bulle modale
}


function likeProfile(profileId, action) {
    // Créer un objet FormData pour envoyer les données
    var formData = new FormData();
    formData.append('profileId', profileId);
    formData.append('action', action);

    // Créer une requête AJAX
    var xhr = new XMLHttpRequest();

    // Spécifier la méthode HTTP et l'URL de la requête
    xhr.open('POST', 'updateLikes.php', true);

    // Définir le callback pour la réponse de la requête
    xhr.onload = function() {
        if (xhr.status === 200) {
            // La requête s'est terminée avec succès, vous pouvez effectuer des actions supplémentaires si nécessaire
            console.log(xhr.responseText);
        } else {
            // Gérer les erreurs si la requête a échoué
            console.error('La requête a échoué.');
        }
    };

    // Envoyer la requête avec les données FormData
    xhr.send(formData);
}