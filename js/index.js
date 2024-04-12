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

function likeProfile(profileId, action) {
  var formData = new FormData();
  formData.append("profileId", profileId);
  formData.append("action", action);

  var xhr = new XMLHttpRequest();

  xhr.open("POST", "updateLikes.php", true);

  xhr.onload = function () {
    if (xhr.status === 200) {
      console.log(xhr.responseText);
      if (xhr.responseText.trim() === "Limite atteinte") {
        limitAlert();
      } else {
        document.getElementById("prof-" + profileId).classList.add("hidden");
        if (xhr.responseText.trim() === "Match") {
          showMatchAlert();
        } else {
          console.error("La requête a échoué.");
        }
      }
    }
  };

  xhr.send(formData);

  var modalBackground = document.getElementById("modal-background");
  modalBackground.style.display = "none";
  var modalInfo = document.getElementById("modal-info");
  modalInfo.innerHTML = "";
}

function showMatchAlert() {
  var matchAlert = document.getElementById("match-alert");
  matchAlert.style.display = "block";

  setTimeout(function () {
    matchAlert.style.display = "none";
  }, 3000);
}

function limitAlert() {
  var limitAlert = document.getElementById("limit-reached-message");
  limitAlert.style.display = "block";

  setTimeout(function () {
    limitAlert.style.display = "none";
  }, 3000);
}

function dislikeProfile(profileId, action) {
  var formData = new FormData();
  formData.append("profileId", profileId);
  formData.append("action", action);

  var xhr = new XMLHttpRequest();

  xhr.open("POST", "updateLikes.php", true);

  xhr.onload = function () {
    if (xhr.status === 200) {
      console.log(xhr.responseText);

      document.getElementById("prof-" + profileId).classList.add("hidden");
    }
  };

  xhr.send(formData);

  var modalBackground = document.getElementById("modal-background");
  modalBackground.style.display = "none";
  var modalInfo = document.getElementById("modal-info");
  modalInfo.innerHTML = "";
}
