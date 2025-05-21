<?php
include('db.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete the customer
    $sql = "DELETE FROM Customer WHERE CustomerID = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Customer deleted successfully.";
        header('Location: customers.php');
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "No customer ID provided.";
}

$conn->close();
?>
