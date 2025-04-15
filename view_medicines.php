<?php
include 'db_connect.php';

$sql = "SELECT * FROM medicines";
$result = mysqli_query($conn, $sql);
?>

<h2>Medicine Records</h2>

<table border="1" cellpadding="10">
    <tr>
        <th>Medicine ID</th>
        <th>Name</th>
        <th>Manufacturer</th>
        <th>Expiry Date</th>
        <th>Stock Quantity</th>
        <th>Unit Price</th>
        <th>Dosage</th>
        <th>Description</th>
    </tr>

    <?php
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['MedicineID'] . "</td>";
            echo "<td>" . $row['Name'] . "</td>";
            echo "<td>" . $row['Manufacturer'] . "</td>";
            echo "<td>" . $row['ExpiryDate'] . "</td>";
            echo "<td>" . $row['StockQuantity'] . "</td>";
            echo "<td>" . $row['UnitPrice'] . "</td>";
            echo "<td>" . $row['Dosage'] . "</td>";
            echo "<td>" . $row['Description'] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='8'>No medicines found.</td></tr>";
    }
    ?>
</table>