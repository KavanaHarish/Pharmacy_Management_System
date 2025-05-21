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
<h2>Customers List</h2>
<a href="add_customer.php" class="add-button">Add Customer</a><br><br>
<table class="medicines-table">
    <thead>
    <tr>
        <th>Name</th>
        <th>Address</th>
        <th>Phone Number</th>
        <th>Email</th>
        <th>Actions</th>
    </tr>
    </thead>
    <?php
    include('db.php');
    
    $sql = "SELECT * FROM Customer";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['Name']}</td>
                    <td>{$row['Address']}</td>
                    <td>{$row['PhoneNumber']}</td>
                    <td>{$row['Email']}</td>
                    <td>
                        <a href='update_customer.php?id={$row['CustomerID']}'class='edit-btn'>Update</a> |
                        <a href='delete_customer.php?id={$row['CustomerID']}'class='delete-btn'>Delete</a>
                    </td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No customers found</td></tr>";
    }

    
    ?>
</table>
</body>
</html>