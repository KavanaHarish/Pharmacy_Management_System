<?php
include 'db.php';

// Fetch all prescriptions
$prescriptions = $conn->query("
    SELECT prescriptions.PrescriptionID, customers.Name AS CustomerName, medicines.Name AS MedicineName
    FROM prescriptions
    JOIN customers ON prescriptions.CustomerID = customers.CustomerID
    JOIN medicines ON prescriptions.MedicineID = medicines.MedicineID
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Sale</title>
</head>
<body>
    <h2>Add New Sale</h2>
    <form method="POST">
        Prescription:
        <select name="prescription_id" required>
            <option value="">Select</option>
            <?php while ($row = $prescriptions->fetch_assoc()): ?>
                <option value="<?= $row['PrescriptionID'] ?>">
                    <?= "ID: " . $row['PrescriptionID'] . " - " . $row['CustomerName'] . " (Medicine: " . $row['MedicineName'] . ")" ?>
                </option>
            <?php endwhile; ?>
        </select><br><br>

        Quantity Sold: <input type="number" name="quantity_sold" required><br><br>
        Sale Date: <input type="date" name="sale_date" required><br><br>

        <input type="submit" name="submit" value="Add Sale">
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $prescription_id = $_POST['prescription_id'];
        $quantity_sold = $_POST['quantity_sold'];
        $sale_date = $_POST['sale_date'];

        // Fetch UnitPrice from medicines table based on prescription
        $query = "
            SELECT medicines.UnitPrice 
            FROM prescriptions 
            JOIN medicines ON prescriptions.MedicineID = medicines.MedicineID 
            WHERE prescriptions.PrescriptionID = '$prescription_id'
        ";
        $result = $conn->query($query);
        $data = $result->fetch_assoc();
        $unit_price = $data['UnitPrice'];

        $total_price = $unit_price * $quantity_sold;

        // Insert into sales table
        $sql = "INSERT INTO sales (PrescriptionID, SaleDate, QuantitySold, TotalPrice)
                VALUES ('$prescription_id', '$sale_date', '$quantity_sold', '$total_price')";

        if ($conn->query($sql) === TRUE) {
            echo "Sale recorded successfully!";
        } else {
            echo "Error: " . $conn->error;
        }
    }
    ?>
</body>
</html>