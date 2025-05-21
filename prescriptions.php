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
<a href="index.php" class="back-arrow">
  <button>←</button>
</a>

<h2>Prescriptions List</h2>
<a href="add_prescription.php" class="add-button">Add Prescription</a><br><br>
<table class="medicines-table">
    <tr>
        <th>Prescription ID</th>
        <th>Customer ID</th>
        <th>Medicine ID</th>
        <th>Prescription Date</th>
        <th>Dosage</th>
        <th>Duration</th>
        <th>Actions</th>
    </tr>

    <?php
    include('db.php');
    
    $sql = "SELECT p.PrescriptionID, c.CustomerID, m.MedicineID, p.PrescriptionDate, p.Dosage, p.Duration 
        FROM Prescription p
        JOIN Customer c ON p.Customer_ID = c.CustomerID
        JOIN Medicines m ON p.Medicine_ID = m.MedicineID";

    
    $result = $conn->query($sql);

    if ($result->num_rows >0)
    {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
            <td>{$row['PrescriptionID']}</td>
                    <td>{$row['CustomerID']}</td>
                    <td>{$row['MedicineID']}</td>
                    <td>{$row['PrescriptionDate']}</td>
                    <td>{$row['Dosage']}</td>
                    <td>{$row['Duration']}</td>
                    <td>
                        <a href='update_prescription.php?id={$row['PrescriptionID']}'class='edit-btn'>Update</a> |
                        <a href='delete_prescription.php?id={$row['PrescriptionID']}'class='delete-btn'>Delete</a>
                    </td>
                  </tr>";
        }
    }
    else {
        echo "<tr><td colspan='6'>No prescriptions found</td></tr>";
    }

    
    ?>
</table>