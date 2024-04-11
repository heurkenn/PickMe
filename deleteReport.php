<?php
// Vérifie si la requête est une requête POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifie si le paramètre 'delete_report' est défini dans la requête
    if (isset($_POST['delete_report'])) {
        // Récupère l'ID du rapport à supprimer depuis la requête
        $report_id = $_POST['delete_report'];

        // Connexion à la base de données
        $servername = "localhost";
        $username = "ProjetR";
        $password = "Paulympe742@";
        $dbname = "InfoUser";
        $conn = mysqli_connect($servername, $username, $password, $dbname);

        // Vérifie la connexion à la base de données
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Prépare la requête SQL pour supprimer le rapport
        $sql = "DELETE FROM Report WHERE IdSignal = $report_id OR IdProbleme = $report_id";

        // Exécute la requête SQL
        if (mysqli_query($conn, $sql)) {
            // Succès de la suppression
            echo "Le rapport a été supprimé avec succès.";
        } else {
            // Erreur lors de la suppression
            echo "Erreur lors de la suppression du rapport: " . mysqli_error($conn);
        }

        // Ferme la connexion à la base de données
        mysqli_close($conn);
    } else {
        // Le paramètre 'delete_report' n'est pas défini dans la requête
        echo "Paramètre 'delete_report' non trouvé dans la requête POST.";
    }
} else {
    // La requête n'est pas une requête POST
    echo "Ce fichier ne peut être accédé que par une requête POST.";
}
