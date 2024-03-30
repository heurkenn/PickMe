<?php
// Connexion à la base de données (à remplacer avec vos propres informations)
$servername = "localhost";
$username = "ProjetR";
$password = "Paulympe742@";
$dbname = "InfoUser";

// Connexion à la base de données
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


// Informations statiques à insérer
$nom = $_POST['Nom'];
$prenom = $_POST['Prenom'];
$dateNaissance = $_POST['DateNaissance'];
$pseudonyme = $_POST['Pseudonyme'];
$email = $_POST['Email'];
$motDePasse = $_POST['MotDePasse'];

// Hachage du mot de passe
$motDePasseHache = password_hash($motDePasse, PASSWORD_DEFAULT);


// Requête SQL pour insérer les données statiques dans la table appropriée
$query = "INSERT INTO Utilisateurs (Nom, Prenom, DateNaissance, Pseudonyme, Email, MotDePasse)
        VALUES ('$nom', '$prenom', '$dateNaissance', '$pseudonyme', '$email', '$motDePasseHache')";

$result = mysqli_query($conn, $query);

if ($result) {
    // Redirection vers gout.php si l'insertion réussie
    header("Location: gouts.php");
    exit();
} else {
    // Affichage du message d'erreur si l'insertion a échoué
    echo "Une erreur est survenue. Veuillez réessayer.";
    // Redirection vers InsCon.php après un délai de 3 secondes
    echo '<script>setTimeout(function() { window.location.href = "InsCon.php"; }, 3000);</script>';
}


// Fermeture de la connexion
mysqli_close($conn); 
