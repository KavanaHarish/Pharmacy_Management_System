<?php include 'db.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>View Medicines</title>
    <style>
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid #aaa;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #eee;
        }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Medicine Inventory</h2>
    
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Manufacturer</th>
            <th>Expiry Date</th>
            <th>Stock Quantity</th>
            <th>Unit Price</th>
            <th>Dosage</th>
            <th>Description</th>
        </tr>

        <?php
        $sql = "SELECT * FROM medicines";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['MedicineID']}</td>
                    <td>{$row['Name']}</td>
                    <td>{$row['Manufacturer']}</td>
                    <td>{$row['ExpiryDate']}</td>
                    <td>{$row['StockQuantity']}</td>
                    <td>{$row['UnitPrice']}</td>
                    <td>{$row['Dosage']}</td>
                    <td>{$row['Description']}</td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='8'>No medicines found.</td></tr>";
        }
        ?>
    </table>
</body>
</html>