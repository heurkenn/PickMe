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

function bioMofifier(profileId) {
  document.getElementById("pseudoDiv-" + profileId).classList.add("hidden");
  document
    .getElementById("biographieDiv-" + profileId)
    .classList.remove("hidden");
}

function showAdditionalInfo(userId) {
  var modalBackground = document.getElementById("modal-background");
  var modalInfo = document.getElementById("modal-info");

  var additionalInfo = document.getElementById(
    "additional-info-" + userId
  ).innerHTML;
  modalInfo.innerHTML = additionalInfo;

  modalBackground.style.display = "block";

  modalInfo.classList.add("open");
}

function hideAdditionalInfo() {
  var modalBackground = document.getElementById("modal-background");
  var modalInfo = document.getElementById("modal-info");

  modalInfo.classList.add("close");
  modalBackground.classList.add("close");

  setTimeout(function () {
    modalBackground.style.display = "none";
    modalInfo.innerHTML = "";
    modalInfo.classList.remove("close");
    modalBackground.classList.remove("close");
  }, 300);
}

function showMessages(userId) {
  var modalBackground = document.getElementById("modal-background");
  var modalInfo = document.getElementById("modal-info");

  var xhr = new XMLHttpRequest();
  xhr.open("GET", "adminMessages.php?user_id=" + userId, true);
  xhr.onreadystatechange = function () {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      var messages = JSON.parse(xhr.responseText);

      var messageHtml = "<h3>Messages de l'utilisateur #" + userId + "</h3>";
      if (messages.length > 0) {
        messageHtml += "<ul>";
        messages.forEach(function (message) {
          messageHtml +=
            "<li>" +
            message.time_stamp +
            ": " +
            message.message_content +
            " to " +
            message.recoi +
            "</li>";
        });
        messageHtml += "</ul>";
      } else {
        messageHtml += "<p>Aucun message trouvé.</p>";
      }

      modalInfo.innerHTML = messageHtml;
      modalBackground.style.display = "block";
      modalBackground.style.zIndex = 9999;
    }
  };
  xhr.send();
}
