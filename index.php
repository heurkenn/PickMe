<?php
session_start();

$servername = "localhost";
$username = "ProjetR";
$password = "Paulympe742@";
$dbname = "InfoUser";

// Connexion à la base de données
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (!isset($_SESSION['user_id'])) {
    header("Location: InsCon.php");
    exit();
}

// Définissez le nombre de profils à afficher
$nombreProfils = 5;

// Récupérer un nombre spécifié d'utilisateurs de manière aléatoire avec leur biographie et goûts
$sqlUtilisateurs = "SELECT DISTINCT Utilisateurs.*, Gouts.*
                    FROM Utilisateurs
                    JOIN Gouts ON Utilisateurs.id = Gouts.UtilisateurId
                    WHERE Utilisateurs.id <> {$_SESSION['user_id']}
                      AND Utilisateurs.id NOT IN (SELECT IdRecoi FROM LikeList WHERE IdEnvoi = {$_SESSION['user_id']})
                      AND Utilisateurs.id NOT IN (SELECT IdEnvoi FROM LikeList WHERE IdRecoi = {$_SESSION['user_id']} AND Etat = 'non')
                    ORDER BY RAND() LIMIT $nombreProfils";


$resultUtilisateurs = mysqli_query($conn, $sqlUtilisateurs);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PICK ME !</title>
    <link rel="stylesheet" href="stylesheet.css">
</head>

<body>
    <header>
        <h1>PICK ME !</h1>
        <nav>
            <ul>
                <li><a href="#">À propos</a></li>
                <li><a href="#">Abonnement</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
    </header>

    <div class="main">
        <div class="account-button-container">
            <a href="profil.php" class="account-button">Mon compte</a>
            <a href="deconnexion.php" class="account-button">Déconnexion</a>
        </div>

        <!-- Affichage des profils -->
        <?php while ($row = mysqli_fetch_assoc($resultUtilisateurs)): ?>
            <div id="prof" class='profile-card'>
                <h2>
                    <?= htmlspecialchars($row['Pseudonyme'], ENT_QUOTES, 'UTF-8') ?>
                </h2>
                <p>
                    <img src=<?php echo htmlspecialchars($row['ProfilPicture'], ENT_QUOTES, 'UTF-8'); ?> class="img-profil">
                </p>
                <button onclick='showAdditionalInfo(<?= $row['id'] ?>)'>Plus d'infos</button>
            </div>

            <!-- Informations additionnelles cachées pour la bulle modale -->
            <div id='additional-info-<?= $row['id'] ?>' class='additional-info hidden'>
                <h3>
                    <?= htmlspecialchars($row['Pseudonyme'], ENT_QUOTES, 'UTF-8') ?>
                </h3>
                <p>
                    <img src=<?php echo htmlspecialchars($row['ProfilPicture'], ENT_QUOTES, 'UTF-8'); ?> class="img-profil">
                </p>
                <p>Pays:
                    <?= htmlspecialchars($row['Pays'], ENT_QUOTES, 'UTF-8') ?>
                </p>
                <p>Langue:
                    <?= htmlspecialchars($row['Langue'], ENT_QUOTES, 'UTF-8') ?>
                </p>
                <p>Genre de jeux:
                    <?= htmlspecialchars($row['GenreJeux'], ENT_QUOTES, 'UTF-8') ?>
                </p>
                <p>Style de gameplay:
                    <?= htmlspecialchars($row['StyleGameplay'], ENT_QUOTES, 'UTF-8') ?>
                </p>
                <p>Recherche:
                    <?= htmlspecialchars($row['TypeRecherche'], ENT_QUOTES, 'UTF-8') ?>
                </p>
                <p>Biographie:
                    <?= htmlspecialchars($row['Biographie'], ENT_QUOTES, 'UTF-8') ?>
                </p>
                <!-- Continuez selon le même modèle pour les autres champs si nécessaire -->
                <section>
                    <button onclick='likeProfile(<?php echo $row['id']; ?>, "non")'><img src="img/non.png"></button>
                    <button onclick='likeProfile(<?php echo $row['id']; ?>, "oui")'><img src="img/oui.png"></button>

                </section>
            </div>
        <?php endwhile; ?>
    </div>

    <div id="modal-background" class="modal-background">
        <div class="modal-content">
            <span class="close-btn" onclick="hideAdditionalInfo()">&times;</span>
            <div id="modal-info"></div>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Mon Site Web. Tous droits réservés.</p>
    </footer>
    <script src="index.js"></script>
</body>

</html>