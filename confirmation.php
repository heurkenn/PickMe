<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation</title>
    <link rel="stylesheet" href="stylesheet.css"> <!-- Vérifiez que ce chemin est correct -->
</head>
<body>
    <?php
    // Démarrage de la session
    session_start();

    // Vérifiez si l'utilisateur vient de la page d'inscription
    if (isset($_SESSION['user_created']) && $_SESSION['user_created'] === true) {
        // Réinitialisez cette variable pour éviter l'accès répété sans nouvelle inscription
        $_SESSION['user_created'] = false;
        ?>
        <div class="container">
            <header>
                <h1>Confirmation</h1>
            </header>
            <main>
                <p>Merci pour votre inscription. Votre compte a été créé avec succès !</p>
                <p><a href="index.php">Retour à la page d'accueil</a></p>
            </main>
        </div>
        <footer>
            <p>&copy; 2024 Mon Site Web. Tous droits réservés.</p>
        </footer>
        <?php
    } else {
        // Redirigez l'utilisateur vers la page d'inscription s'il n'y a pas eu de création de compte
        header("Location: index.php");
        exit;
    }
    ?>
</body>
</html>
