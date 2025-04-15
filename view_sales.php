<?php
include 'db_connect.php';

$sql = "SELECT s.SaleID, s.SaleDate, s.QuantitySold, s.TotalPrice,
               c.Name AS CustomerName, m.Name AS MedicineName
        FROM sales s
        JOIN prescriptions p ON s.PrescriptionID = p.PrescriptionID
        JOIN customers c ON p.CustomerID = c.CustomerID
        JOIN medicines m ON p.MedicineID = m.MedicineID";

$result = mysqli_query($conn, $sql);
?>

<h2>Sales Records</h2>
<table border="1" cellpadding="10">
    <tr>
        <th>Sale ID</th>
        <th>Sale Date</th>
        <th>Customer</th>
        <th>Medicine</th>
        <th>Quantity Sold</th>
        <th>Total Price</th>
    </tr>

    <?php
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>{$row['SaleID']}</td>";
            echo "<td>{$row['SaleDate']}</td>";
            echo "<td>{$row['CustomerName']}</td>";
            echo "<td>{$row['MedicineName']}</td>";
            echo "<td>{$row['QuantitySold']}</td>";
            echo "<td>₹{$row['TotalPrice']}</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='6'>No sales found.</td></tr>";
    }
    ?>
</table>