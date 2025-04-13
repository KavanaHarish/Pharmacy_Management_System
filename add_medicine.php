<?php include 'db.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Medicine</title>
</head>
<body>
    <h2>Add New Medicine</h2>
    <form method="POST">
        Name: <input type="text" name="name" required><br><br>
        Price: <input type="number" step="0.01" name="price" required><br><br>
        Quantity: <input type="number" name="quantity" required><br><br>
        Expiry Date: <input type="date" name="expiry_date" required><br><br>
        <input type="submit" name="submit" value="Add Medicine">
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $expiry_date = $_POST['expiry_date'];

        $sql = "INSERT INTO medicines (Name, UnitPrice, StockQuantity, ExpiryDate) 
                VALUES ('$name', '$price', '$quantity', '$expiry_date')";

        if ($conn->query($sql) === TRUE) {
            echo "Medicine added successfully!";
        } else {
            echo "Error: " . $conn->error;
        }
    }
    ?>
</body>
</html>