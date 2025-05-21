<?php
include('db.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete the sale
    $sql = "DELETE FROM Sales WHERE SaleID = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Sale deleted successfully.";
        header('Location: sales.php');
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "No sale ID provided.";
}

$conn->close();
?>
