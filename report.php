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

// Récupérer tous les messages de rapport
$sql = "SELECT * FROM Report";
$result = mysqli_query($conn, $sql);

$reports = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $reports[] = $row;
    }
}

// Traitement de la suppression d'un rapport
if (isset($_POST['delete_report'])) {
    $report_id = $_POST['delete_report'];
    $sql_delete = "DELETE FROM Report WHERE IdReport = $report_id";
    $result_delete = mysqli_query($conn, $sql_delete);
    if ($result_delete) {
        // Suppression réussie, actualiser la page
        header("Location: report.php");
        exit();
    } else {
        echo "Erreur lors de la suppression du rapport.";
    }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de Rapports</title>
    <link rel="stylesheet" href="stylesheet.css">
</head>

<body>
<?php include('header/headerAdmin.php'); ?>
    <div class="main">
        <div class="account-button-container">
            <a href="profil.php" class="account-button">Mon compte</a>
            <a href="deconnexion.php" class="account-button">Déconnexion</a>
        </div>
        <div class="main">
            <h2>Liste des rapports :</h2><br>
            <table>
                <tr>
                    <th>ID Rapport</th>
                    <th>ID Signal</th>
                    <th>ID Problème</th>
                    <th>Horaire</th>
                    <th>Message de Rapport</th>
                    <th>Action</th>
                </tr>
                <?php foreach ($reports as $report): ?>
                    <tr>
                        <td><?php echo $report['IdReport']; ?></td>
                        <td><?php echo $report['IdSignal']; ?></td>
                        <td><?php echo $report['IdProbleme']; ?></td>
                        <td><?php echo $report['Horaire']; ?></td>
                        <td><?php echo $report['MessageReport']; ?></td>
                        <td>
                            <form method="post" action="">
                                <input type="hidden" name="delete_report" value="<?php echo $report['IdReport']; ?>">
                                <button type="submit">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <?php include ('footer/footer.php'); ?>
</body>

</html>
