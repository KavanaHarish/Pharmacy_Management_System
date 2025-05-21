<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicines - Pharmacy Management System</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
    <a href="index.php" class="back-arrow"><button>←</button></a>
   <h2>Sales List</h2>
<a href="add_sale.php" class="add-button">Add Sale</a><br><br>

<table class="medicines-table">
    <thead>
    <tr>
        <th>Sale ID</th>
        <th>Prescription ID</th>
        <th>Sale Date</th>
        <th>Quantity Sold</th>
        <th>Total Price</th>
        
        <th>Actions</th>
    </tr>
    </thead>
    <?php
    include('db.php');
    
    // Fetch Sales data
    $sql = "SELECT Sales.SaleID, Prescription.PrescriptionID AS 'PrescriptionID', Sales.SaleDate , Sales.QuantitySold, Sales.TotalPrice
            FROM Sales
            JOIN Prescription ON Sales.Prescription_ID = Prescription.PrescriptionID";
    
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['SaleID']}</td>
                    <td>{$row['PrescriptionID']}</td>
                    <td>{$row['SaleDate']}</td>
                    <td>{$row['QuantitySold']}</td>
                    <td>{$row['TotalPrice']}</td>
                    
                    <td>
                        <a href='update_sale.php?id={$row['SaleID']}'class='edit-btn'>Update</a> |
                        <a href='delete_sale.php?id={$row['SaleID']}'class='delete-btn'>Delete</a>
                    </td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='7'>No sales found</td></tr>";
    }
    ?>
</table> 
</body>
</html>