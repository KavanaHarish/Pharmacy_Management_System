<?php include 'db.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>View Prescriptions</title>
    <style>
        table {
            border-collapse: collapse;
            width: 90%;
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
    <h2 style="text-align: center;">Prescription Records</h2>

    <table>
        <tr>
            <th>Prescription ID</th>
            <th>Customer Name</th>
            <th>Medicine Name</th>
            <th>Dosage</th>
            <th>Duration</th>
            <th>Prescription Date</th>
        </tr>

        <?php
        $sql = "SELECT p.PrescriptionID, c.Name AS CustomerName, m.Name AS MedicineName,
                       p.Dosage, p.Duration, p.PrescriptionDate
                FROM prescriptions p
                JOIN customers c ON p.CustomerID = c.CustomerID
                JOIN medicines m ON p.MedicineID = m.MedicineID";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['PrescriptionID']}</td>
                    <td>{$row['CustomerName']}</td>
                    <td>{$row['MedicineName']}</td>
                    <td>{$row['Dosage']}</td>
                    <td>{$row['Duration']}</td>
                    <td>{$row['PrescriptionDate']}</td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No prescriptions found.</td></tr>";
        }
        ?>
    </table>
</body>
</html>