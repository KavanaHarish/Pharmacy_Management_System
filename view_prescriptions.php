<?php
include 'db_connect.php';

$sql = "SELECT p.PrescriptionID, c.Name AS CustomerName, m.Name AS MedicineName, 
               p.Dosage, p.Instructions
        FROM prescriptions p
        JOIN customers c ON p.CustomerID = c.CustomerID
        JOIN medicines m ON p.MedicineID = m.MedicineID";

$result = mysqli_query($conn, $sql);
?>

<h2>Prescription Records</h2>

<table border="1" cellpadding="10">
    <tr>
        <th>Prescription ID</th>
        <th>Customer Name</th>
        <th>Medicine Name</th>
        <th>Dosage</th>
        <th>Instructions</th>
    </tr>

    <?php
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['PrescriptionID'] . "</td>";
            echo "<td>" . $row['CustomerName'] . "</td>";
            echo "<td>" . $row['MedicineName'] . "</td>";
            echo "<td>" . $row['Dosage'] . "</td>";
            echo "<td>" . $row['Instructions'] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No prescriptions found.</td></tr>";
    }
    ?>
</table>