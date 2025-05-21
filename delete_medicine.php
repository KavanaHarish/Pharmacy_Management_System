<?php
include('db.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete the medicine
    $sql = "DELETE FROM Medicines WHERE MedicineID = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Medicine deleted successfully.";
        header('Location: medicines.php');
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "No medicine ID provided.";
}

$conn->close();
?>
