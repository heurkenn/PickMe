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

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// Récupère le forfait de l'utilisateur depuis la base de données
$user_id = $_SESSION['user_id'];
$query = "SELECT Forfait FROM Utilisateurs WHERE id = $user_id";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) == 0) {
    // Redirige si l'utilisateur n'existe pas dans la base de données
    header("Location: index.php");
    exit();
}

$row = mysqli_fetch_assoc($result);
$forfait = $row['Forfait'];

// Traitement de l'abonnement
if (isset($_POST['subscribe'])) {
    // Met à jour le forfait de l'utilisateur
    $sql = "UPDATE Utilisateurs SET Forfait = 'premium' WHERE id = $user_id";
    mysqli_query($conn, $sql);
    // Redirige vers la page d'abonnement après l'abonnement
    header("Location: abonnement.php");
    exit();
}

// Traitement de la demande d'administration
if (isset($_POST['admin'])) {
    // Vérifie si le mot de passe est correct
    $password = $_POST['password'];
    if ($password === 'root') {
        // Met à jour le forfait de l'utilisateur en administrateur
        $sql = "UPDATE Utilisateurs SET Forfait = 'admin' WHERE id = $user_id";
        mysqli_query($conn, $sql);
        // Redirige vers la page d'abonnement après la mise à jour en administrateur
        header("Location: abonnement.php");
        exit();
    }
}
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
        <h1><a href="index.php" class="custom-link">PICK ME !</h1>
        <nav>
            <ul>
                <li><a href="apropos.php">À propos</a></li>
                <li><a href="abonnement.php">Abonnement</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="message.php">Tes matchs</a></li>
            </ul>
        </nav>
    </header>

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


        <div class="container">
            <div class="premium-box">
                <h2>Premium</h2>
                <p>Avantages du compte Premium :</p>
                <ul>
                    <li>Avantage 1: t'es content</li>
                    <li>Avantage 2: je suis content</li>
                    <li>Avantage 3: nous sommes content</li>
                    <!-- Ajoutez d'autres avantages ici -->
                </ul>
                <?php if ($forfait === 'free'): ?>
                    <form action="" method="post">
                        <button type="submit" name="subscribe">S'abonner</button>
                    </form>
                <?php else: ?>
                    <p>Vous êtes déjà abonné(e).</p>
                <?php endif; ?>
            </div>
            <div class="admin-box">
                <h2>Admin</h2>
                <?php if ($forfait === 'admin'): ?>
                    <p>Vous êtes déjà administrateur.</p>
                <?php else: ?>
                    <form action="" method="post">
                        <input type="password" name="password" placeholder="Mot de passe">
                        <button type="submit" name="admin">Admin</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>

    </div>
    <?php include ('footer/footer.php'); ?>
</body>

</html>