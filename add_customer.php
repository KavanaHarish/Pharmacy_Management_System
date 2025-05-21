<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Customer</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <style>
        
        input[type="text"], input[type="number"], input[type="email"], textarea {
            width: 100%;
            padding: 12px 15px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 12px;
            font-size: 14px;
            transition: border-color 0.3s ease;
        }
        input[type="text"]:focus, input[type="number"]:focus, input[type="email"]:focus, textarea:focus {
            border-color: #6a5acd;
            outline: none;
        }
    </style>
</head>
<body class="form-page">
    <?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $sql = "INSERT INTO Customer (Name, Address, PhoneNumber, Email) VALUES ('$name', '$address', '$phone', '$email')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Customer added successfully!');</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}
?>
    <div class="container">
        <a href="customers.php" class="back-arrow"><button>←</button></a>


        <h2>Add Customer</h2>
        <form method="post" action="add_customer.php">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" required>

            <label for="address">Address:</label>
            <input type="text" name="address" id="address" required>

            <label for="phone">Phone Number:</label>
            <input type="number" name="phone" id="phone" required>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>

            <button type="submit" class="submit-btn">Add</button>
        </form>
    </div>
</body>
</html>