<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['delete_report'])) {
        $report_id = $_POST['delete_report'];

        $servername = "localhost";
        $username = "ProjetR";
        $password = "Paulympe742@";
        $dbname = "InfoUser";
        $conn = mysqli_connect($servername, $username, $password, $dbname);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "DELETE FROM Report WHERE IdSignal = $report_id OR IdProbleme = $report_id";

        if (mysqli_query($conn, $sql)) {
            echo "Le rapport a été supprimé avec succès.";
        } else {
            echo "Erreur lors de la suppression du rapport: " . mysqli_error($conn);
        }

        mysqli_close($conn);
    } else {
        echo "Paramètre 'delete_report' non trouvé dans la requête POST.";
    }
} else {
    echo "Ce fichier ne peut être accédé que par une requête POST.";
}
