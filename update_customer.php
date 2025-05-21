<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Medicine</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <style>
        input[type="text"], input[type="text"], input[type="number"],input[type="email"], textarea {
            width: 80%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
        }
        .error-message {
            color: #d9534f;
            font-weight: 500;
            margin-bottom: 15px;
            text-align: center;
        }
        .success-message {
            color: #5cb85c;
            font-weight: 500;
            margin-bottom: 15px;
            text-align: center;
        }
    </style>
</head>
<body class="form-page">
    <div class="container">
        <a href="customers.php" class="back-arrow"><button>←</button></a>
        <h2>Update Customer</h2>
        <?php
include('db.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch current customer details
    $sql = "SELECT * FROM Customer WHERE CustomerID = $id";
    $result = $conn->query($sql);
    $customer = $result->fetch_assoc();
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $address = $_POST['address'];
        $phone_number = $_POST['phone_number'];
        $email = $_POST['email'];

        // Update customer details
        $update_sql = "UPDATE Customer 
                       SET Name = '$name', Address = '$address', PhoneNumber = '$phone_number', Email = '$email'
                       WHERE CustomerID = $id";

        if ($conn->query($update_sql) === TRUE) {
            echo "Customer updated successfully.";
            header('Location: customers.php');
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
} else {
    echo "No customer ID provided.";
}

$conn->close();
?>
<form method="POST" action="">
    <label for="name">Name:</label>
    <input type="text" name="name" id="name" value="<?= htmlspecialchars($customer['Name']) ?>" required>

    <label for="address">Address:</label>
    <input type="text" name="address" value="<?php echo $customer['Address']; ?>" required>

    <label for="phone_number">Phone Number:</label>
    <input type="number" name="phone_number" value="<?php echo $customer['PhoneNumber']; ?>" required>

    <label for="email">Email:</label>
    <input type="email" name="email" value="<?php echo $customer['Email']; ?>" required>
    
    <button type="submit" class="submit-btn">Update Customer</button>
</form>
    </div>
    </body>
    </html>