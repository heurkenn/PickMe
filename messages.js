document.addEventListener("DOMContentLoaded", function () {
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
        loadMessageHistory(receiverId);
        // Masquer la zone de correspondants
        matchList.style.display = "none";
      }
    });
  
    // Gestion de l'envoi du formulaire de message
    sendMessageForm.addEventListener("submit", function (event) {
      event.preventDefault(); // Empêche le comportement par défaut du formulaire
      var message = document.getElementById("message").value;
      var receiverId = receiverIdInput.value;
      sendMessage(receiverId, message);
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
            console.log("Sender ID:", message.sender_id);
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
  });
  