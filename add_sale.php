<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $prescription_id = $_POST['prescription_id'];
    $quantity_sold = $_POST['quantity_sold'];
    $sale_date = date('Y-m-d');

    // Fetch Unit Price of medicine from prescription
    $price_query = "
        SELECT m.UnitPrice 
        FROM prescriptions p 
        JOIN medicines m ON p.MedicineID = m.MedicineID 
        WHERE p.PrescriptionID = '$prescription_id'";

    $result = mysqli_query($conn, $price_query);
    $unit_price = 0;

    if ($row = mysqli_fetch_assoc($result)) {
        $unit_price = $row['UnitPrice'];
    }

    $total_price = $unit_price * $quantity_sold;

    $insert = "INSERT INTO sales (PrescriptionID, SaleDate, QuantitySold, TotalPrice)
               VALUES ('$prescription_id', '$sale_date', '$quantity_sold', '$total_price')";

    if (mysqli_query($conn, $insert)) {
        echo "Sale recorded successfully.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Fetch prescription list for dropdown
$prescriptions = mysqli_query($conn, "
    SELECT p.PrescriptionID, c.Name AS CustomerName, m.Name AS MedicineName
    FROM prescriptions p
    JOIN customers c ON p.CustomerID = c.CustomerID
    JOIN medicines m ON p.MedicineID = m.MedicineID");
?>

<h2>Add Sale</h2>
<form method="post">
    <label>Prescription:</label><br>
    <select name="prescription_id" required></select>