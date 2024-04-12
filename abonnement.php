<?php
session_start();

$servername = "localhost";
$username = "ProjetR";
$password = "Paulympe742@";
$dbname = "InfoUser";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$query = "SELECT Forfait FROM Utilisateurs WHERE id = $user_id";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) == 0) {
    header("Location: index.php");
    exit();
}

$row = mysqli_fetch_assoc($result);
$forfait = $row['Forfait'];

if (isset($_POST['subscribe'])) {
    $sql = "UPDATE Utilisateurs SET Forfait = 'premium' WHERE id = $user_id";
    mysqli_query($conn, $sql);
    header("Location: abonnement.php");
    exit();
}

if (isset($_POST['admin'])) {
    $password = $_POST['password'];
    if ($password === 'root') {
        $sql = "UPDATE Utilisateurs SET Forfait = 'admin' WHERE id = $user_id";
        mysqli_query($conn, $sql);
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

        <div class="container">
            <div class="premium-box">
                <h2>Premium</h2>
                <p>Avantages du compte Premium :</p>
                <ul>
                    <li>Avantage 1: t'es content</li>
                    <li>Avantage 2: je suis content</li>
                    <li>Avantage 3: nous sommes content</li>
                </ul>
                <?php if ($forfait === 'free'): ?>
                    <form action="" method="post">
                        <button type="submit" name="subscribe">S'abonner</button>
                    </form>
                <?php else: ?>
                    <p style="font-weight : bolder;">Vous êtes déjà abonné(e).</p>
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
