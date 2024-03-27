<?php
// Connexion à la base de données (à remplacer avec vos propres informations)
$servername = "localhost";
$username = "ProjetR";
$password = "Paulympe742@";
$dbname = "maBaseDeDonnees";

// Connexion à la base de données
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connexion établie" . "<br>";

// Informations statiques à insérer
$jeuxVideo = $_POST['jeux_video'];
$sports = $_POST['sports'];
$hobbies = $_POST['hobbies'];
$musiquePreferee = $_POST['musique_preferee'];
$filmsPrefers = $_POST['films_prefers'];
$livresPrefers = $_POST['livres_prefers'];
$regimeAlimentaire = $_POST['regime_alimentaire'];
$habitudesDeVie = $_POST['habitudes_de_vie'];
$domainesInteret = $_POST['domaines_interet'];
$valeursPersonnelles = $_POST['valeurs_personnelles'];
$opinionsPolitiques = $_POST['opinions_politiques'];
$activitesSociales = $_POST['activites_sociales'];
$objectifsAspirations = $_POST['objectifs_aspirations'];

// Requête SQL pour insérer les données dans la table Gouts
$query = "INSERT INTO Gouts (JeuxVideo, Sports, Hobbies, MusiquePreferee, FilmsPrefers, LivresPrefers, RegimeAlimentaire, HabitudesDeVie, DomainesInteret, ValeursPersonnelles, OpinionsPolitiques, ActivitesSociales, ObjectifsAspirations)
        VALUES ('$jeuxVideo', '$sports', '$hobbies', '$musiquePreferee', '$filmsPrefers', '$livresPrefers', '$regimeAlimentaire', '$habitudesDeVie', '$domainesInteret', '$valeursPersonnelles', '$opinionsPolitiques', '$activitesSociales', '$objectifsAspirations')";
echo "Requête SQL: " . $query . "<br>";

$result = mysqli_query($conn, $query);
if (!$result) {
    printf("Erreur: %s\n", mysqli_error($conn));
} else {
    echo 'Données insérées avec succès. <br>';
    // Ajouter le bouton de redirection
    echo '<a href="accueil.php"><button>Retour à l\'accueil</button></a>';
}

// Fermeture de la connexion
mysqli_close($conn);
?>
