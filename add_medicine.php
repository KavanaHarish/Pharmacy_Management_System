<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $manufacturer = $_POST['manufacturer'];
    $expiry = $_POST['expiry'];
    $stock = $_POST['stock'];
    $price = $_POST['price'];
    $dosage = $_POST['dosage'];
    $desc = $_POST['desc'];

    $sql = "INSERT INTO medicines (Name, Manufacturer, ExpiryDate, StockQuantity, UnitPrice, Dosage, Description)
            VALUES ('$name', '$manufacturer', '$expiry', '$stock', '$price', '$dosage', '$desc')";

    if (mysqli_query($conn, $sql)) {
        echo "Medicine added successfully.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<h2>Add Medicine</h2>
<form method="post">
    Name: <input type="text" name="name" required><br><br>
    Manufacturer: <input type="text" name="manufacturer" required><br><br>
    Expiry Date: <input type="date" name="expiry" required><br><br>
    Stock Quantity: <input type="number" name="stock" required><br><br>
    Unit Price: <input type="text" name="price" required><br><br>
    Dosage: <input type="text" name="dosage"><br><br>
    Description: <input type="text" name="desc"><br><br>
    <input type="submit" value="Add Medicine">
</form>