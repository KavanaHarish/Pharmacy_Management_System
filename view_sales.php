<?php
include 'db.php';

// Fetch sales data along with prescription, customer and medicine details
$sql = "
    SELECT 
        sales.SaleID,
        customers.Name AS CustomerName,
        medicines.Name AS MedicineName,
        sales.QuantitySold,
        sales.SaleDate,
        sales.TotalPrice
    FROM sales
    JOIN prescriptions ON sales.PrescriptionID = prescriptions.PrescriptionID
    JOIN customers ON prescriptions.CustomerID = customers.CustomerID
    JOIN medicines ON prescriptions.MedicineID = medicines.MedicineID
";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Sales</title>
    <style>
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
        }

        th, td {
            border: 1px solid #aaa;
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #eee;
        }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Sales Records</h2>

    <table>
        <tr>
            <th>Sale ID</th>
            <th>Customer</th>
            <th>Medicine</th>
            <th>Quantity Sold</th>
            <th>Sale Date</th>
            <th>Total Price</th>
        </tr>

        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['SaleID'] ?></td>
                    <td><?= $row['CustomerName'] ?></td>
                    <td><?= $row['MedicineName'] ?></td>
                    <td><?= $row['QuantitySold'] ?></td>
                    <td><?= $row['SaleDate'] ?></td>
                    <td><?= number_format($row['TotalPrice'], 2) ?></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="6">No sales found.</td></tr>
        <?php endif; ?>
    </table>
</body>
</html>