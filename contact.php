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

$user_id = $_SESSION['user_id'];
$query = "SELECT Forfait FROM Utilisateurs WHERE id = $user_id";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) == 0) {
    // Redirige si l'utilisateur n'existe pas dans la base de données
    header("Location: InsCon.php");
    exit();
}

$row = mysqli_fetch_assoc($result);
$forfait = $row['Forfait'];

// Traitement du formulaire de contact
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Enregistre le message dans la base de données
    $sql = "INSERT INTO Contact (IdContact, Sujet, Horaire, MessageContact) VALUES ('$user_id', '$subject', NOW(), '$message')";
    mysqli_query($conn, $sql);
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - PICK ME !</title>
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

        <section class="forms">
            <h2>Formulaire de Contact</h2>
            <div id="contactForm">
                <form action="" method="post">
                    <label for="subject">Sujet :</label><br><br>
                    <select id="subject" name="subject" required>
                        <option value="Question">Question</option>
                        <option value="Problème technique">Problème technique</option>
                        <option value="Suggestions">Suggestions</option>
                        <!-- Ajoutez d'autres options ici -->
                    </select><br><br>

                    <label for="message">Message :</label><br><br>
                    <textarea id="message" name="message" required></textarea><br><br>

                    <input type="submit" value="Envoyer">
                </form>
        </section>

        <section id="direct-contact">
            <h3>Contact Direct</h3>
            <p>Email : contact@pickme.com</p>
            <p>Téléphone : 01 23 45 67 89</p>

        </section>

    </div>

    <?php include ('footer/footer.php'); ?>
</body>

</html>