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

// Vérifier si l'utilisateur a le forfait "admin"
$query = "SELECT Forfait FROM Utilisateurs WHERE id = {$_SESSION['user_id']}";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) == 0) {
    header("Location: InsCon.php");
    exit();
}
$row = mysqli_fetch_assoc($result);
$forfait = $row['Forfait'];

$query = "SELECT DISTINCT Utilisateurs.id, Gouts.ProfilPicture, Utilisateurs.Pseudonyme 
          FROM Utilisateurs 
          JOIN LikeList AS SenderLikes ON Utilisateurs.id = SenderLikes.IdRecoi
          JOIN LikeList AS ReceiverLikes ON Utilisateurs.id = ReceiverLikes.IdEnvoi
          JOIN Gouts ON Utilisateurs.id = Gouts.UtilisateurId
          WHERE SenderLikes.IdEnvoi = $userId
          AND ReceiverLikes.IdRecoi = $userId
          AND SenderLikes.Etat = 'oui'
          AND ReceiverLikes.Etat = 'oui'";
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
<?php include('header/header.php'); ?>
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

            <div id="message-container" class="hidden">
                <span id="selected-profile-name" style="font-weight:bolder; test-align:center;"></span>
                <button id="close-message-btn" class="close-btn-msg">X</button>
                <button id="gestion-btn" class="close-btn-msg">...</button>
                <div id="message-history" class="message-history">
                    <!-- L'historique des messages sera affiché ici -->
                </div>
                <div id="gestion-container" class="hidden">
                    <button id="delete-match-btn" class="gestion-btn">Supprimer le match</button>
                    <button id="block-match-btn" class="gestion-btn">Bloquer le match</button>
                    <button id="report-btn" class="gestion-btn">Report</button>
                    <div id="report-div" style="display: none;">
                        <textarea id="report-message" placeholder="Raison du report" class="report-input"></textarea>
                        <button id="send-report-btn" class="gestion-btn">Envoyer</button>
                    </div>
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
    <?php include('footer/footer.php'); ?>
    <script src="js/messages.js"></script>
</body>

</html>