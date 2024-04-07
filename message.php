<?php
session_start();

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: InsCon.php");
    exit();
}

// Récupérez la liste des correspondances de l'utilisateur connecté depuis la base de données
$userId = $_SESSION['user_id'];
$servername = "localhost";
$username = "ProjetR";
$password = "Paulympe742@";
$dbname = "InfoUser";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$query = "SELECT DISTINCT Utilisateurs.id, Gouts.ProfilPicture, Utilisateurs.Pseudonyme 
          FROM Utilisateurs 
          JOIN LikeList ON Utilisateurs.id = LikeList.IdEnvoi OR Utilisateurs.id = LikeList.IdRecoi
          JOIN Gouts ON Utilisateurs.id= Gouts.UtilisateurId
          WHERE (LikeList.IdEnvoi = $userId OR LikeList.IdRecoi = $userId) AND LikeList.Etat = 'oui' AND Utilisateurs.id <> {$_SESSION['user_id']}";
$result = mysqli_query($conn, $query);
$matches = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messagerie</title>
    <link rel="stylesheet" href="stylesheet.css">
</head>

<body>
    <header>
        <h1><a href="index.php" class="custom-link">PICK ME !</a></h1>
        <nav>
            <ul>
                <li><a href="#">À propos</a></li>
                <li><a href="#">Abonnement</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="message.php">Tes matchs</a></li>
            </ul>
        </nav>
    </header>
    <div class="main">
        <div class="account-button-container">
            <a href="deconnexion.php" class="account-button">Déconnexion</a>
        </div>

        <!-- Zone de sélection des correspondants -->
        <div id="match-list">
            <h2>Tes matchs</h2>
            <ul>
                <?php foreach ($matches as $match): ?>
                    <li><a href="#" class="match-link" data-receiver-id="<?= $match['id'] ?>">
                            <img src=<?php echo htmlspecialchars($match['ProfilPicture'], ENT_QUOTES, 'UTF-8'); ?>
                                class="img-profil2">
                            <?= htmlspecialchars($match['Pseudonyme'], ENT_QUOTES, 'UTF-8') ?>
                        </a></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <!-- Zone de messagerie -->
        <div id=test>
            <div id="gestion-container" class="hidden">
                <button id="delete-match-btn" class="gestion-btn">Supprimer le match</button>
                <button id="report-btn" class="gestion-btn">Report</button>
                <div id="report-div" style="display: none;">
                    <textarea id="report-message" placeholder="Raison du report"></textarea>
                    <button id="send-report-btn">Envoyer</button>
                </div>
            </div>
            <div id="message-container" class="hidden">
                <span id="selected-profile-name" style="font-weight:bolder; test-align:center;"></span>
                <button id="close-message-btn" class="close-btn-msg">X</button>
                <button id="gestion-btn" class="close-btn-msg">...</button>
                <div id="message-history" class="message-history">
                    <!-- L'historique des messages sera affiché ici -->
                </div>
                <div id="message-input">
                    <form id="send-message-form" method="post">
                        <input type="hidden" id="receiver-id" name="receiver_id" value="">
                        <textarea id="message" class="msg-input" name="message" placeholder="Écrivez votre message ici"
                            required></textarea>
                        <button type="submit"><img src="img/send.png"></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <p>&copy; 2024 Mon Site Web. Tous droits réservés.</p>
    </footer>
    <script src="messages.js"></script>
</body>

</html>