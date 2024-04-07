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

$query = "SELECT DISTINCT Utilisateurs.id, Utilisateurs.Pseudonyme 
          FROM Utilisateurs 
          JOIN LikeList ON Utilisateurs.id = LikeList.IdEnvoi OR Utilisateurs.id = LikeList.IdRecoi
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
            </ul>
        </nav>
    </header>
    <div class="main">
        <h1>Messagerie Instantanée</h1>

        <!-- Zone de sélection des correspondants -->
        <div id="match-list">
            <h2>Correspondants</h2>
            <ul>
                <?php foreach ($matches as $match): ?>
                    <li><a href="#" class="match-link" data-receiver-id="<?= $match['id'] ?>">
                            <?= htmlspecialchars($match['Pseudonyme'], ENT_QUOTES, 'UTF-8') ?>
                        </a></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <!-- Zone de messagerie -->
        <div id="message-container" class="hidden">
            <h2>Conversation</h2>
            <div id="message-history" class="message-history">
                <!-- L'historique des messages sera affiché ici -->
            </div>
            <div id="message-input">
                <form id="send-message-form" method="post">
                    <input type="hidden" id="receiver-id" name="receiver_id" value="">
                    <textarea id="message" name="message" placeholder="Écrivez votre message ici" required></textarea>
                    <button type="submit">Envoyer</button>
                </form>
            </div>
        </div>
    </div>
    <footer>
        <p>&copy; 2024 Mon Site Web. Tous droits réservés.</p>
    </footer>
    <script src="messages.js"></script>
</body>

</html>