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

// Vérifie si l'utilisateur est connecté et a un forfait "admin"
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$query = "SELECT Forfait FROM Utilisateurs WHERE id = {$_SESSION['user_id']}";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) == 0) {
    header("Location: index.php");
    exit();
}

// Initialisation des variables de recherche
$search_query = "";
$search_results = [];

// Traitement de la recherche
if (isset($_GET['search'])) {
    // Récupération de la valeur de recherche
    $search_query = trim($_GET['search_query']);

    // Requête pour trouver les profils correspondants à la recherche
    $sql = "SELECT * 
            FROM Utilisateurs 
            JOIN Gouts ON Utilisateurs.id = Gouts.UtilisateurId
            WHERE nom LIKE '%$search_query%' OR prenom LIKE '%$search_query%' OR pseudonyme LIKE '%$search_query%'";
    $result = mysqli_query($conn, $sql);

    // Vérification s'il y a des résultats
    if (mysqli_num_rows($result) > 0) {
        // Récupération des résultats dans un tableau
        while ($row = mysqli_fetch_assoc($result)) {
            $search_results[] = $row;
        }
    } else {
        // Aucun résultat trouvé
        $search_results = [];
    }
}

// Traitement des actions sur les profils
if (isset($_POST['action']) && isset($_POST['profile_id'])) {
    $action = $_POST['action'];
    $profile_id = $_POST['profile_id'];

    if ($action === 'delete') {
        // Suppression du profil de la base de données
        $sql_key0 = "SET FOREIGN_KEY_CHECKS = 0";
        $result_key0 = mysqli_query($conn, $sql_key0);
        $sql_delete_user = "DELETE FROM Utilisateurs WHERE id = $profile_id";
        $result1 = mysqli_query($conn, $sql_delete_user);
        $sql_delete_gout = "DELETE FROM Gouts WHERE UtilisateurId = $profile_id";
        $result2 = mysqli_query($conn, $sql_delete_gout);
        $sql_delete_like = "DELETE FROM LikeList WHERE IdEnvoi = $profile_id OR IdRecoi = $profile_id";
        $result3 = mysqli_query($conn, $sql_delete_like);
        $sql_delete_msg = "DELETE FROM Messages WHERE UtilisateurId = $profile_id OR UtilisateurIdBis = $profile_id";
        $result4 = mysqli_query($conn, $sql_delete_msg);
        $sql_delete_rpt = "DELETE FROM Report WHERE IdSignal = $profile_id OR IdProbleme = $profile_id";
        $result5 = mysqli_query($conn, $sql_delete_msg);
        $sql_key1 = "SET FOREIGN_KEY_CHECKS = 1";
        $result_key1 = mysqli_query($conn, $sql_key1);
        header("Location: admin.php");
        exit();

    } elseif ($action === 'edit') {
        // Redirection vers la page de modification du profil avec l'ID du profil
        header("Location: modifier_profil.php?id=$profile_id");
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pick Me !</title>
    <link rel="stylesheet" href="stylesheet.css">
</head>

<body>
    <header>
        <h1><a href="index.php" class="custom-link">Pick Me !</a></h1>
        <nav>
            <ul>
                <li><a href="apropos.php">À propos</a></li>
                <li><a href="#">Abonnement</a></li>
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

        <div class="search-container">
            <form action="" method="GET">
                <input type="text" name="search_query" id="search_query"
                    placeholder="Rechercher par nom, prénom ou pseudonyme" class="search-input" value="">
                <button type="submit" onclick="searchProfiles()" name="search" class="gestion-btn">Rechercher</button>
            </form>
        </div>
        <div class="pos">
            <div class="profile-list">
                <?php if (!empty($search_results)): ?>
                    <?php foreach ($search_results as $profile): ?>
                        <div class="profile">
                            <h2>
                                <?php echo htmlspecialchars($profile['Prenom'] . ' ' . $profile['Nom'] . ' (' . $profile['Pseudonyme'] . ')'); ?>
                                </br>
                                <img src="<?php echo htmlspecialchars($profile['ProfilPicture']); ?>" class="img-profil">
                            </h2>
                            <form action="" method="POST">
                                <input type="hidden" name="profile_id" value="<?php echo $profile['id']; ?>">
                                <button type="submit" name="action" value="delete">Supprimer</button>
                                <button type="submit" name="action" value="edit">Modifier</button>
                            </form>
                        </div>
                    <?php endforeach; ?>
                <?php elseif (isset($_GET['search'])): ?>
                    <p>Aucun résultat trouvé pour "
                        <?php echo htmlspecialchars($search_query); ?>"
                    </p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <footer>
        <p>&copy; 2024 Mon Site Web. Tous droits réservés.</p>
    </footer>
    <script src="admin.js"></script>
</body>

</html>