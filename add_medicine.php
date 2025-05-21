<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Medicine</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <style>
        input[type="text"], input[type="number"], input[type="date"], textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
        }
    </style>
</head>
<body class="form-page">
       <?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['NAME']);
    $manufacturer = mysqli_real_escape_string($conn, $_POST['Manufacturer']);
    $expiry_date = mysqli_real_escape_string($conn, $_POST['ExpiryDate']);
    $stock_quantity = mysqli_real_escape_string($conn, $_POST['StockQuantity']);
    $unit_price = mysqli_real_escape_string($conn, $_POST['UnitPrice']);
    $dosage = mysqli_real_escape_string($conn, $_POST['Dosage']);
    $description = mysqli_real_escape_string($conn, $_POST['Description']);

    $sql = "INSERT INTO medicines (NAME, Manufacturer,ExpiryDate, StockQuantity, UnitPrice, Dosage, Description) VALUES ('$name', '$manufacturer', '$expiry_date', '$stock_quantity','$unit_price','$dosage','$description')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Medicine added successfully!');</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}
?>
    <div class="container">
        <a href="medicines.php" class="back-arrow"><button>←</button></a>
        <h2>Add Medicine</h2>
        <form action="add_medicine.php" method="post">
            <label for="name">Name:</label>
            <input type="text" name="NAME" id="name" required>

            <label for="manufacturer">Manufacturer:</label>
            <input type="text" name="Manufacturer" id="manufacturer">

            <label for="expiry_date">Expiry Date:</label>
            <input type="date" name="ExpiryDate" id="expiry_date">

            <label for="stock_quantity">Stock Quantity:</label>
            <input type="number" name="StockQuantity" id="stock_quantity">

            <label for="unit_price">Unit Price:</label>
            <input type="number" step="0.01" name="UnitPrice" id="unit_price">

            <label for="dosage">Dosage:</label>
            <input type="text" name="Dosage" id="dosage">

            <label for="description">Description:</label>
            <textarea name="Description" id="description" rows="3"></textarea>

            <button type="submit" class="submit-btn">Add</button>
        </form>
    </div>
</body>
</html>
