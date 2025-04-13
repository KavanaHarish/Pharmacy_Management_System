<?php include 'db.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>View Customers</title>
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
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Customer List</h2>
    
    <table>
        <tr>
            <th>CustomerID</th>
            <th>Name</th>
            <th>Address</th>
            <th>Phone Number</th>
            <th>Email</th>
        </tr>

        <?php
        $sql = "SELECT * FROM customers";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['CustomerID']}</td>
                    <td>{$row['Name']}</td>
                    <td>{$row['Address']}</td>
                    <td>{$row['PhoneNumber']}</td>
                    <td>{$row['Email']}</td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No customers found.</td></tr>";
        }
        ?>
    </table>
</body>
</html>