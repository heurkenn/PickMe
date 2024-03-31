<?php
// Démarrer la session
session_start();

// Détruire la session
session_destroy();

// Rediriger vers une page après la déconnexion
header("Location: InsCon.php");
exit(); // Assure que le script s'arrête ici
