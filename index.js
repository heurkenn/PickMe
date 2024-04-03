
function showAdditionalInfo(userId) {
    var modalBackground = document.getElementById('modal-background');
    var modalInfo = document.getElementById('modal-info');
    
    // Récupération des informations cachées et leur affichage dans la bulle modale
    var additionalInfo = document.getElementById('additional-info-' + userId).innerHTML;
    modalInfo.innerHTML = additionalInfo;
    
    modalBackground.style.display = 'block'; // Affichage de la bulle modale
}

function hideAdditionalInfo() {
    var modalBackground = document.getElementById('modal-background');
    modalBackground.style.display = 'none'; // Masquage de la bulle modale
    var modalInfo = document.getElementById('modal-info');
    modalInfo.innerHTML = ''; // Nettoyage de la bulle modale
}