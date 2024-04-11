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

// Vérifier si l'utilisateur a le forfait "admin"
$query = "SELECT Forfait FROM Utilisateurs WHERE id = {$_SESSION['user_id']}";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) == 0) {
    header("Location: InsCon.php");
    exit();
}
$row = mysqli_fetch_assoc($result);
$forfait = $row['Forfait'];

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
    <?php include ('header/header.php'); ?>

    <div class="main">
        <div class="account-button-container">
            <a href="profil.php" class="account-button">Mon compte</a>
            <a href="deconnexion.php" class="account-button">Déconnexion</a>
        </div>
        <div class="admin-button-container">
            <?php if ($forfait === 'admin'): ?>
                <a href="admin.php" class="account-button">Admin</a>
            <?php endif; ?>
        </div>
        <div id="match-alert" class="match-alert hidden">C'est un match!</div>
        <div id="limit-reached-message" class="match-alert hidden">Limite atteinte</div>

        <section class='choixprofil'>
            <!-- Affichage des profils -->
            <?php while ($row = mysqli_fetch_assoc($resultUtilisateurs)): ?>
                <div id='prof-<?= $row['id'] ?>' class='profile-card'>
                    <h2>
                        <?= htmlspecialchars($row['Pseudonyme'], ENT_QUOTES, 'UTF-8') ?>
                    </h2>
                    <p>
                        <img src=<?php echo htmlspecialchars($row['ProfilPicture'], ENT_QUOTES, 'UTF-8'); ?>
                            class="img-profil">
                    </p>
                    <button onclick="showAdditionalInfo('<?= $row['id'] ?>')">Plus d'infos</button>

                </div>

                <!-- Informations additionnelles cachées pour la bulle modale -->
                <div id='additional-info-<?= $row['id'] ?>' class='additional-info hidden'>
                    <h3>
                        <?= htmlspecialchars($row['Pseudonyme'], ENT_QUOTES, 'UTF-8') ?>
                    </h3>
                    <p>
                        <img src=<?php echo htmlspecialchars($row['ProfilPicture'], ENT_QUOTES, 'UTF-8'); ?>
                            class="img-profil">
                    </p>
                    <p>Pays :
                        <?= htmlspecialchars($row['Pays'], ENT_QUOTES, 'UTF-8') ?>
                    </p>
                    <p>Langue :
                        <?= htmlspecialchars($row['Langue'], ENT_QUOTES, 'UTF-8') ?>
                    </p>
                    <p>Genre de jeux :
                        <?= htmlspecialchars($row['GenreJeux'], ENT_QUOTES, 'UTF-8') ?>
                    </p>
                    <p>Style de gameplay :
                        <?= htmlspecialchars($row['StyleGameplay'], ENT_QUOTES, 'UTF-8') ?>
                    </p>
                    <p>Recherche :
                        <?= htmlspecialchars($row['TypeRecherche'], ENT_QUOTES, 'UTF-8') ?>
                    </p>
                    <p>Biographie :
                        <?= htmlspecialchars($row['Biographie'], ENT_QUOTES, 'UTF-8') ?>
                    </p>
                    <!-- Continuez selon le même modèle pour les autres champs si nécessaire -->
                    <section>
                        <button onclick="dislikeProfile('<?= $row['id'] ?>', 'non')"><img class="smash"
                                src="img/non.png"></button>
                        <button onclick="likeProfile('<?= $row['id'] ?>', 'oui')"><img class="smash"
                                src="img/oui.png"></button>

                    </section>-
                </div>
            <?php endwhile; ?>
        </section>


        <div id="modal-background" class="modal-background">
            <div class="modal-content">
                <span class="close-btn" onclick="hideAdditionalInfo()">&times;</span>
                <div id="modal-info"></div>
            </div>
        </div>
    </div>
    <?php include ('footer/footer.php'); ?>
    <script src="js/index.js"></script>
</body>

</html>