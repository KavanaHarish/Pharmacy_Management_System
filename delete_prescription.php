<?php
include('db.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete the prescription
    $sql = "DELETE FROM Prescription WHERE PrescriptionID = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Prescription deleted successfully.";
        header('Location: prescriptions.php');
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "No prescription ID provided.";
}

$conn->close();
?>
