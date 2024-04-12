document.addEventListener("DOMContentLoaded", function () {
  var messageBubbles = document.querySelectorAll(".message-bubble");

  messageBubbles.forEach(function (bubble) {
    bubble.addEventListener("mouseover", function () {
      var messageId = bubble.getAttribute("data-message-id");
      deleteMessage(messageId);
    });
  });

  var matchList = document.getElementById("match-list");
  var messageContainer = document.getElementById("message-container");
  var messageHistory = document.getElementById("message-history");
  var sendMessageForm = document.getElementById("send-message-form");
  var receiverIdInput = document.getElementById("receiver-id");

  matchList.addEventListener("click", function (event) {
    event.preventDefault();
    if (event.target.classList.contains("match-link")) {
      var receiverId = event.target.getAttribute("data-receiver-id");
      receiverIdInput.value = receiverId;
      messageContainer.style.display = "block";
      messageContainer.classList.add("message-container");
      document.getElementById("test").classList.remove("hidden");
      loadMessageHistory(receiverId);
      matchList.style.display = "none";
      var selectedProfileName = event.target.textContent.trim();
      document.getElementById("selected-profile-name").textContent =
        selectedProfileName;
      document.getElementById("close-message-btn").classList.remove("hidden");
    }
  });

  sendMessageForm.addEventListener("submit", function (event) {
    event.preventDefault();
    var message = document.getElementById("message").value;
    var receiverId = receiverIdInput.value;
    sendMessage(receiverId, message);
    clearMessageInput();
    scrollMessageHistory();
  });

  function deleteMessage(messageId) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "deleteMessage.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = function () {
        if (xhr.status === 200) {
            console.log("Le message a été supprimé avec succès.");
        } else {
            console.error("Erreur lors de la suppression du message.");
        }
    };
    xhr.send("message_id=" + messageId);
  }

  function loadMessageHistory(receiverId) {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "fetchMessages.php?receiver_id=" + receiverId, true);
    xhr.onload = function () {
      if (xhr.status === 200) {
        var messages = JSON.parse(xhr.responseText);
        messageHistory.innerHTML = "";
        messages.forEach(function (message) {
          var messageBubble = document.createElement("div");
          messageBubble.classList.add("message-bubble");
          messageBubble.onclick = function() {
            var id=message.id_msg;
            deleteMessage(id);
            loadMessageHistory(receiverId);
        };
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
        scrollMessageHistory();
      } else {
        console.error(
          "Erreur lors du chargement de l'historique des messages."
        );
      }
    };
    xhr.send();
  }

  function sendMessage(receiverId, message) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "sendMessage.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = function () {
      if (xhr.status === 200) {
        loadMessageHistory(receiverId);
      } else {
        console.error("Erreur lors de l'envoi du message.");
      }
    };
    xhr.send(
      "receiver_id=" + receiverId + "&message=" + encodeURIComponent(message)
    );
  }

  function scrollMessageHistory() {
    messageHistory.scrollTop = messageHistory.scrollHeight;
  }

  function clearMessageInput() {
    document.getElementById("message").value = "";
  }

  document
    .getElementById("message")
    .addEventListener("keypress", function (event) {
      if (event.key === "Enter" && !event.shiftKey) {
        event.preventDefault();
        var message = document.getElementById("message").value;
        var receiverId = receiverIdInput.value;
        sendMessage(receiverId, message);
        clearMessageInput();
        scrollMessageHistory();
      }
    });

  document
    .getElementById("close-message-btn")
    .addEventListener("click", function () {
      messageContainer.classList.remove("message-container");
      messageContainer.classList.add("hidden");
      document.getElementById("test").classList.add("hidden");
      messageHistory.innerHTML = "";
      document.getElementById("match-list").style.display = "block";
      this.classList.add("hidden");
    });

  matchList.addEventListener("click", function (event) {
    event.preventDefault();
    if (event.target.tagName === "IMG") {
      var link = event.target.closest(".match-link");
      var receiverId = link.getAttribute("data-receiver-id");
      receiverIdInput.value = receiverId;
      messageContainer.style.display = "block";
      messageContainer.classList.add("message-container");
      document.getElementById("test").classList.remove("hidden");
      loadMessageHistory(receiverId);
      matchList.style.display = "none";
      var selectedProfileName = link.textContent.trim();
      document.getElementById("selected-profile-name").textContent =
        selectedProfileName;
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
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "deleteMatch.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = function () {
      if (xhr.status === 200) {
        location.reload();
      } else {
        console.error("Erreur lors de la suppression du match.");
      }
    };
    xhr.send("receiver_id=" + receiverId);
  }

  var blockMatchBtn = document.getElementById("block-match-btn");
  blockMatchBtn.addEventListener("click", function () {
    var receiverId = receiverIdInput.value;
    blockMatch(receiverId);
  });

  function blockMatch(receiverId) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "blockMatch.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = function () {
      if (xhr.status === 200) {
        location.reload();
      } else {
        console.error("Erreur lors du blocage du match.");
      }
    };
    xhr.send("receiver_id=" + receiverId);
  }

  function reportUser(receiverId, reportMessage) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "reportUser.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = function () {
      if (xhr.status === 200) {
        alert("Report envoyé avec succès.");
        gestionContainer.classList.add("hidden");
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
    document.getElementById("gestion-container").classList.remove("hidden");
    document
      .getElementById("gestion-container")
      .classList.add("gestion-container");
  });

  var gestionContainer = document.getElementById("gestion-container");
  var reportDiv = document.getElementById("report-div");
  var gestionBtn = document.getElementById("gestion-btn");

  gestionBtn.addEventListener("click", function(event) {
      gestionContainer.classList.remove("hidden");
  });

  document.addEventListener("click", function(event) {
      if (!gestionContainer.contains(event.target) && !reportDiv.contains(event.target) && event.target !== gestionBtn) {
          gestionContainer.classList.add("hidden");
          reportDiv.style.display = "none";
      }
  });
});
