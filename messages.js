document.addEventListener("DOMContentLoaded", function () {
  var messageBubbles = document.querySelectorAll(".message-bubble");

  messageBubbles.forEach(function (bubble) {
    bubble.addEventListener("mouseover", function () {
      var messageTime = bubble.nextElementSibling;
      messageTime.classList.remove("hidden");
    });

    bubble.addEventListener("mouseout", function () {
      var messageTime = bubble.nextElementSibling;
      messageTime.classList.add("hidden");
    });
  });

  // Récupération des éléments DOM
  var matchList = document.getElementById("match-list");
  var messageContainer = document.getElementById("message-container");
  var messageHistory = document.getElementById("message-history");
  var sendMessageForm = document.getElementById("send-message-form");
  var receiverIdInput = document.getElementById("receiver-id");

  // Gestion des événements au clic sur un correspondant
  matchList.addEventListener("click", function (event) {
    event.preventDefault(); // Empêche le comportement par défaut du lien
    if (event.target.classList.contains("match-link")) {
      var receiverId = event.target.getAttribute("data-receiver-id");
      receiverIdInput.value = receiverId;
      messageContainer.style.display = "block";
      messageContainer.classList.add("message-container");
      document.getElementById("test").classList.remove("hidden");
      loadMessageHistory(receiverId);
      // Masquer la zone de correspondants
      matchList.style.display = "none";

      // Afficher le pseudonyme du profil choisi dans la conversation
      var selectedProfileName = event.target.textContent.trim();
      document.getElementById("selected-profile-name").textContent =
        selectedProfileName;

      // Afficher le bouton de fermeture
      document.getElementById("close-message-btn").classList.remove("hidden");
    }
  });

  // Gestion de l'envoi du formulaire de message
  sendMessageForm.addEventListener("submit", function (event) {
    event.preventDefault(); // Empêche le comportement par défaut du formulaire
    var message = document.getElementById("message").value;
    var receiverId = receiverIdInput.value;
    sendMessage(receiverId, message);
    clearMessageInput(); // Vide la zone de texte après l'envoi du message
    scrollMessageHistory(); // Fait défiler automatiquement vers le bas après l'envoi
  });

  // Fonction pour charger l'historique des messages
  function loadMessageHistory(receiverId) {
    // Effectuer une requête AJAX pour récupérer l'historique des messages avec le correspondant
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "fetchMessages.php?receiver_id=" + receiverId, true);
    xhr.onload = function () {
      if (xhr.status === 200) {
        var messages = JSON.parse(xhr.responseText);
        messageHistory.innerHTML = ""; // Efface le contenu précédent
        messages.forEach(function (message) {
          var messageBubble = document.createElement("div");
          messageBubble.classList.add("message-bubble");
          if (message.sender_id == receiverId) {
            messageBubble.classList.add("receiver-message");
          } else {
            messageBubble.classList.add("sender-message");
            messageBubble.classList.add("user-message");
          }
          messageBubble.textContent = message.message_content;

          var messageTime = document.createElement("div");
          messageTime.classList.add("message-time");
          messageTime.textContent = message.time_stamp;
          messageHistory.appendChild(messageBubble);
          messageHistory.appendChild(messageTime);
        });
        scrollMessageHistory(); // Fait défiler automatiquement vers le bas après le chargement de l'historique
      } else {
        console.error(
          "Erreur lors du chargement de l'historique des messages."
        );
      }
    };
    xhr.send();
  }

  // Fonction pour envoyer un message
  function sendMessage(receiverId, message) {
    // Effectuer une requête AJAX pour envoyer le message
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "sendMessage.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = function () {
      if (xhr.status === 200) {
        // Actualiser l'historique des messages après l'envoi
        loadMessageHistory(receiverId);
      } else {
        console.error("Erreur lors de l'envoi du message.");
      }
    };
    xhr.send(
      "receiver_id=" + receiverId + "&message=" + encodeURIComponent(message)
    );
  }

  // Fonction pour faire défiler automatiquement l'historique de la conversation vers le bas
  function scrollMessageHistory() {
    messageHistory.scrollTop = messageHistory.scrollHeight;
  }

  // Fonction pour vider la zone de texte après l'envoi d'un message
  function clearMessageInput() {
    document.getElementById("message").value = "";
  }

  // Permettre l'envoi du message en appuyant sur la touche "Entrée" dans la zone de texte
  document
    .getElementById("message")
    .addEventListener("keypress", function (event) {
      if (event.key === "Enter" && !event.shiftKey) {
        // Vérifier si la touche "Entrée" est pressée sans la touche "Maj"
        event.preventDefault(); // Empêcher le comportement par défaut (saut de ligne)
        var message = document.getElementById("message").value;
        var receiverId = receiverIdInput.value;
        sendMessage(receiverId, message);
        clearMessageInput(); // Vide la zone de texte après l'envoi du message
        scrollMessageHistory(); // Soumettre le formulaire
      }
    });

  // Ajout d'un gestionnaire d'événements pour le clic sur le bouton de fermeture
  document
    .getElementById("close-message-btn")
    .addEventListener("click", function () {
      // Cacher la zone de messagerie
      messageContainer.classList.remove("message-container");
      messageContainer.classList.add("hidden");
      document.getElementById("test").classList.add("hidden");

      // Réinitialiser le contenu de l'historique des messages
      messageHistory.innerHTML = "";

      // Réafficher la liste des profils
      document.getElementById("match-list").style.display = "block";

      // Cacher le bouton de fermeture
      this.classList.add("hidden");
    });
  matchList.addEventListener("click", function (event) {
    event.preventDefault(); // Empêche le comportement par défaut du lien
    if (event.target.tagName === "IMG") {
      // Vérifie si l'élément cliqué est une image
      var link = event.target.closest(".match-link"); // Trouve l'élément parent contenant la classe .match-link
      var receiverId = link.getAttribute("data-receiver-id");
      receiverIdInput.value = receiverId;
      messageContainer.style.display = "block";
      messageContainer.classList.add("message-container");
      document.getElementById("test").classList.remove("hidden");
      loadMessageHistory(receiverId);
      // Masquer la zone de correspondants
      matchList.style.display = "none";

      // Afficher le pseudonyme du profil choisi dans la conversation
      var selectedProfileName = link.textContent.trim();
      document.getElementById("selected-profile-name").textContent =
        selectedProfileName;

      // Afficher le bouton de fermeture
      document.getElementById("close-message-btn").classList.remove("hidden");
    }
  });

  var deleteMatchBtn = document.getElementById("delete-match-btn");
  var reportBtn = document.getElementById("report-btn");
  var reportDiv = document.getElementById("report-div");
  var sendReportBtn = document.getElementById("send-report-btn");
  var receiverIdInput = document.getElementById("receiver-id");

  deleteMatchBtn.addEventListener("click", function () {
    var receiverId = receiverIdInput.value;
    deleteMatch(receiverId);
  });

  reportBtn.addEventListener("click", function () {
    reportDiv.style.display = "block";
  });

  sendReportBtn.addEventListener("click", function () {
    var receiverId = receiverIdInput.value;
    var reportMessage = document.getElementById("report-message").value;
    reportUser(receiverId, reportMessage);
  });

  function deleteMatch(receiverId) {
    // Effectuer une requête AJAX pour supprimer le match de la liste des matches
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "deleteMatch.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = function () {
      if (xhr.status === 200) {
        // Actualiser la liste des matches après la suppression
        location.reload();
      } else {
        console.error("Erreur lors de la suppression du match.");
      }
    };
    xhr.send("receiver_id=" + receiverId);
  }

  function reportUser(receiverId, reportMessage) {
    // Effectuer une requête AJAX pour envoyer le report
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "reportUser.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = function () {
      if (xhr.status === 200) {
        // Afficher un message de confirmation ou effectuer une action supplémentaire si nécessaire
        alert("Report envoyé avec succès.");
      } else {
        console.error("Erreur lors de l'envoi du report.");
      }
    };
    xhr.send(
      "receiver_id=" +
        receiverId +
        "&report_message=" +
        encodeURIComponent(reportMessage)
    );
  }
  document.getElementById("gestion-btn").addEventListener("click", function () {
    // Cacher la zone de messagerie
  
    document.getElementById("gestion-container").classList.remove("hidden");
    document
      .getElementById("gestion-container")
      .classList.add("gestion-container");
  });
  
  var gestionContainer = document.getElementById("gestion-container");
  var reportDiv = document.getElementById("report-div");
  var gestionBtn = document.getElementById("gestion-btn");

  // Afficher la div gestion-container lors du clic sur le bouton "..."
  gestionBtn.addEventListener("click", function(event) {
      gestionContainer.classList.remove("hidden");
  });

  // Masquer la div gestion-container lors du clic en dehors de celle-ci
  document.addEventListener("click", function(event) {
      if (!gestionContainer.contains(event.target) && !reportDiv.contains(event.target) && event.target !== gestionBtn) {
          gestionContainer.classList.add("hidden");
          reportDiv.style.display = "none";
      }
  });
});

